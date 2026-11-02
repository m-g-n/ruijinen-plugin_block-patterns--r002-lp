/**
 * ブロックパターンがエディターで編集できるかを確認する E2E テスト.
 *
 * 各パターンについて「登録済みパターンの内容」と「既存の固定ページの内容」をコピーした
 * 一時的な下書きを作り、以下を確認する（元の固定ページは変更しない）。
 * - ブロック検証エラー・未登録ブロック・未登録のブロックスタイルがないこと
 * - RichText に文字を入力して保存でき、再読み込み後も壊れないこと
 * - 画像の差し替え、メディアの左右入れ替えをして保存でき、再読み込み後も壊れないこと
 */
const fs = require("fs");
const path = require("path");
const { test, expect } = require("@wordpress/e2e-test-utils-playwright");

const ROOT = path.join(__dirname, "../../..");
const PATTERN_PREFIX = "RJE-pattern/RJE_R002LP_";
const TEST_IMAGE_NAME = "e2e-replaced-image";

// 過去のパターンに含まれていた未登録のブロックスタイル。
// CSS も無く表示・編集に影響しないため、既存ページに残っていても許容する。
const LEGACY_STYLES = ["RJE_R002LP_release_items"];

// パターン名は RegisterPatterns.php の登録内容から取得する（パターン追加時に自動で対象になる）
const PATTERNS = [
	...fs
		.readFileSync(path.join(ROOT, "App/Patterns/RegisterPatterns.php"), "utf8")
		.matchAll(/'name'\s*=>\s*'([a-z0-9_]+)'/g),
].map((m) => m[1]);

// パターン名と固定ページのスラッグが一致しないもの
const PAGE_SLUG_OVERRIDES = {
	hero_media_and_text__alignright: "rje_r002lp_hero_media_and_text2",
	message_normal__alignright: "rje_r002lp_message_normal2",
	voices: "rje_r002lp_voice",
};

const SOURCES = [
	...PATTERNS.map((name) => ({
		type: "pattern",
		name,
		label: `pattern:${name}`,
	})),
	...PATTERNS.map((name) => ({
		type: "page",
		name,
		slug: PAGE_SLUG_OVERRIDES[name] || `rje_r002lp_${name}`,
		label: `page:${name}`,
	})),
	// パターンに紐づかないブロックスタイル（セクション1）の確認用ページ
	{
		type: "page",
		name: "section1",
		slug: "rje_r002lp_section1",
		label: "page:section1",
	},
];

/**
 * テスト対象の内容（ブロックのマークアップ）を取得する.
 */
async function getSourceContent(requestUtils, source) {
	if (source.type === "pattern") {
		const patterns = await requestUtils.rest({
			path: "/wp/v2/block-patterns/patterns",
		});
		return (
			patterns.find((p) => p.name === PATTERN_PREFIX + source.name)?.content ??
			null
		);
	}
	const pages = await requestUtils.rest({
		path: "/wp/v2/pages",
		params: {
			slug: source.slug,
			context: "edit",
			status: "publish,draft,private",
		},
	});
	return pages[0]?.content.raw ?? null;
}

/**
 * エディターを開き、ブロックの読み込みが終わるまで待つ.
 */
async function openEditor(admin, page, postId) {
	await admin.editPost(postId);
	await page.waitForFunction(
		() => window.wp?.data?.select("core/block-editor").getBlocks().length > 0,
	);
}

/**
 * エディターのキャンバス（iframe の場合はその中）を返す.
 */
async function getCanvas(page) {
	const iframe = page.locator('iframe[name="editor-canvas"]');
	return (await iframe.count())
		? page.frameLocator('iframe[name="editor-canvas"]')
		: page;
}

/**
 * 全ブロックの検証結果を返す.
 */
function getBlockReport(page) {
	return page.evaluate((legacyStyles) => {
		const { select } = window.wp.data;
		const walk = (blocks, parent = []) =>
			blocks.flatMap((block, i) => {
				const at = [...parent, i];
				return [{ block, at: at.join(".") }, ...walk(block.innerBlocks, at)];
			});
		const all = walk(select("core/block-editor").getBlocks());

		// RJE のブロックスタイルが、そのブロックに登録されているか
		const unregisteredStyles = all.flatMap(({ block, at }) =>
			(block.attributes.className || "")
				.split(/\s+/)
				.filter((c) => c.startsWith("is-style-RJE_"))
				.map((c) => c.replace(/^is-style-/, ""))
				.filter((style) => !legacyStyles.includes(style))
				.filter(
					(style) =>
						!select("core/blocks")
							.getBlockStyles(block.name)
							.some((s) => s.name === style),
				)
				.map((style) => `${block.name} @${at}: ${style}`),
		);

		// 現在の save 関数の出力と、元のマークアップ（子ブロック部分を除く）を比較する
		const normalize = (html) =>
			html.replace(/>\s+</g, "><").replace(/\s+/g, " ").trim();
		const outdated = all
			.filter(
				({ block }) =>
					block.isValid &&
					typeof block.originalContent === "string" &&
					normalize(
						window.wp.blocks.getSaveContent(block.name, block.attributes),
					) !== normalize(block.originalContent),
			)
			.map(({ block }) => block.name);

		return {
			count: all.length,
			invalid: all
				.filter(({ block }) => !block.isValid)
				.map(({ block, at }) => `${block.name} @${at}`),
			missing: all
				.filter(({ block }) => block.name === "core/missing")
				.map(({ block, at }) => `${block.attributes.originalName} @${at}`),
			unregisteredStyles,
			// 旧形式のマークアップ（deprecation で読み込めているが、保存すると新形式に変わるブロック）
			outdated: [...new Set(outdated)],
		};
	}, LEGACY_STYLES);
}

/**
 * 保存し、成功したことを確認する.
 */
async function savePost(page) {
	const succeeded = await page.evaluate(async () => {
		await window.wp.data.dispatch("core/editor").savePost();
		return window.wp.data.select("core/editor").didPostSaveRequestSucceed();
	});
	expect(succeeded, "下書きの保存に成功すること").toBe(true);
}

/**
 * ブロックの検証結果を確認する（問題があればテスト失敗）.
 */
function expectValidBlocks(report, when) {
	expect(
		report.count,
		`${when}: ブロックが読み込まれていること`,
	).toBeGreaterThan(0);
	expect(report.invalid, `${when}: ブロック検証エラーがないこと`).toEqual([]);
	expect(report.missing, `${when}: 未登録ブロックがないこと`).toEqual([]);
	expect(
		report.unregisteredStyles,
		`${when}: ブロックスタイルが登録されていること`,
	).toEqual([]);
}

test.describe("ブロックパターンの編集チェック", () => {
	let testImage;

	test.beforeAll(async ({ requestUtils }) => {
		// 差し替え用の画像を、識別しやすいファイル名でアップロードする
		const tmpDir = path.join(ROOT, "artifacts/tmp");
		fs.mkdirSync(tmpDir, { recursive: true });
		const file = path.join(tmpDir, `${TEST_IMAGE_NAME}.jpg`);
		fs.copyFileSync(path.join(ROOT, "src/img/photo-fruits.jpg"), file);
		testImage = await requestUtils.uploadMedia(file);
	});

	test.afterAll(async ({ requestUtils }) => {
		if (testImage) {
			await requestUtils.deleteMedia(testImage.id);
		}
	});

	for (const source of SOURCES) {
		test.describe(source.label, () => {
			let postId;
			const pageErrors = [];

			test.beforeEach(async ({ requestUtils, page }) => {
				const content = await getSourceContent(requestUtils, source);
				test.skip(
					content === null,
					`${source.label} が見つからないためスキップ`,
				);

				const post = await requestUtils.rest({
					method: "POST",
					path: "/wp/v2/pages",
					data: { title: `[E2E] ${source.label}`, content, status: "draft" },
				});
				postId = post.id;

				pageErrors.length = 0;
				page.on("pageerror", (error) => pageErrors.push(error.message));
			});

			test.afterEach(async ({ requestUtils }) => {
				if (postId) {
					await requestUtils.rest({
						method: "DELETE",
						path: `/wp/v2/pages/${postId}`,
						params: { force: true },
					});
					postId = undefined;
				}
			});

			test("テキストを編集して保存できる", async ({
				admin,
				page,
				requestUtils,
			}) => {
				await openEditor(admin, page, postId);
				const before = await getBlockReport(page);
				expectValidBlocks(before, "読み込み時");
				if (before.outdated.length) {
					test.info().annotations.push({
						type: "warning",
						description: `旧形式のマークアップ（保存時に新形式へ変換される）: ${before.outdated.join(", ")}`,
					});
				}

				const canvas = await getCanvas(page);
				const clientIds = await page.evaluate(() =>
					window.wp.data
						.select("core/block-editor")
						.getClientIdsWithDescendants(),
				);

				const typed = [];
				const notEditable = [];
				const hidden = [];
				for (const clientId of clientIds) {
					// ブロックを選択状態にする（選択時のみ表示される入力欄を表示させるため）
					await page.evaluate(
						(id) =>
							window.wp.data.dispatch("core/block-editor").selectBlock(id),
						clientId,
					);
					const blockName = await page.evaluate(
						(id) => window.wp.data.select("core/block-editor").getBlockName(id),
						clientId,
					);
					const block = canvas.locator(`[data-block="${clientId}"]`);
					if (!(await block.count())) {
						continue;
					}
					// 選択時のスタイル（is-selected）が反映されるまで待つ
					await expect(block).toHaveClass(/\bis-selected\b/);
					// そのブロック直下の RichText（子ブロックのものは除く）
					const ownIndexes = await block.evaluate((el, id) => {
						const nodes = [
							el,
							...el.querySelectorAll('[contenteditable="true"]'),
						].filter((node) => node.getAttribute("contenteditable") === "true");
						return nodes
							.map((node, i) =>
								node.closest("[data-block]")?.dataset.block === id ? i : -1,
							)
							.filter((i) => i >= 0);
					}, clientId);

					for (const index of ownIndexes) {
						const marker = `E2E${String(typed.length + notEditable.length + 1).padStart(3, "0")}`;
						const target = block.evaluateHandle(
							(el, i) =>
								[el, ...el.querySelectorAll('[contenteditable="true"]')].filter(
									(node) => node.getAttribute("contenteditable") === "true",
								)[i],
							index,
						);
						const element = (await target).asElement();
						if (!element || !(await element.isVisible())) {
							hidden.push(`${blockName} (#${index})`);
							continue;
						}
						try {
							await element.click({ timeout: 5_000 });
							await page.keyboard.press("End");
							await page.keyboard.type(marker);
							typed.push({ marker, blockName });
						} catch (error) {
							notEditable.push(
								`${blockName} (#${index}): ${error.message.split("\n")[0]}`,
							);
						}
					}
				}

				test.info().annotations.push({
					type: "info",
					description: `入力したテキスト: ${typed.length} 箇所 / 入力できなかった箇所: ${notEditable.length} / 非表示のため未入力: ${hidden.length}${hidden.length ? ` (${hidden.join(", ")})` : ""}`,
				});
				expect(
					notEditable,
					"表示されている RichText にはすべて入力できること（デザイン上非表示の欄は対象外）",
				).toEqual([]);
				expect(
					typed.length,
					"編集できるテキストが1つ以上あること",
				).toBeGreaterThan(0);

				await savePost(page);

				// 再読み込みして壊れていないか確認
				await openEditor(admin, page, postId);
				expectValidBlocks(await getBlockReport(page), "保存・再読み込み後");

				const saved = await requestUtils.rest({
					path: `/wp/v2/pages/${postId}`,
					params: { context: "edit" },
				});
				const lostInSave = typed.filter(
					({ marker }) => !saved.content.raw.includes(marker),
				);
				expect(
					lostInSave,
					"入力したテキストがすべて保存されていること",
				).toEqual([]);

				await page.goto(`/?page_id=${postId}&preview=true`);
				const html = await page.content();
				const notRendered = typed.filter(
					({ marker }) => !html.includes(marker),
				);
				expect
					.soft(notRendered, "入力したテキストがフロントに表示されること")
					.toEqual([]);

				expect(pageErrors, "JavaScript エラーが発生しないこと").toEqual([]);
			});

			test("画像の差し替え・左右の入れ替えをして保存できる", async ({
				admin,
				page,
				requestUtils,
			}) => {
				await openEditor(admin, page, postId);
				expectValidBlocks(await getBlockReport(page), "読み込み時");

				// ブロックの属性定義から「画像ID と URL の組」と「左右の位置」を探して変更する
				const changes = await page.evaluate(
					(media) => {
						const { select, dispatch } = window.wp.data;
						const result = [];
						const suffixes = { id: "url", Id: "Url", ID: "URL" };
						for (const clientId of select(
							"core/block-editor",
						).getClientIdsWithDescendants()) {
							const block = select("core/block-editor").getBlock(clientId);
							const attrs =
								window.wp.blocks.getBlockType(block.name)?.attributes ?? {};
							const updates = {};
							for (const key of Object.keys(attrs)) {
								const m = key.match(/^(.*?)(id|Id|ID)$/);
								const urlKey = m && m[1] + suffixes[m[2]];
								// 画像が設定されている枠だけを差し替える
								if (urlKey && urlKey in attrs && block.attributes[urlKey]) {
									updates[key] = media.id;
									updates[urlKey] = media.url;
								}
							}
							for (const key of ["mediaPosition", "imagePosition"]) {
								const value = block.attributes[key];
								if (key in attrs && (value === "left" || value === "right")) {
									updates[key] = value === "left" ? "right" : "left";
								}
							}
							if (Object.keys(updates).length) {
								dispatch("core/block-editor").updateBlockAttributes(
									clientId,
									updates,
								);
								result.push({ clientId, name: block.name, updates });
							}
						}
						return result;
					},
					{ id: testImage.id, url: testImage.source_url },
				);

				const imageChanges = changes.filter((c) =>
					Object.values(c.updates).includes(testImage.id),
				);
				const positionChanges = changes.filter(
					(c) => "mediaPosition" in c.updates || "imagePosition" in c.updates,
				);
				test.info().annotations.push({
					type: "info",
					description: `画像の差し替え: ${imageChanges.length} 箇所 / 左右の入れ替え: ${positionChanges.length} 箇所`,
				});
				test.skip(
					changes.length === 0,
					"画像・左右の入れ替え対象がないパターン",
				);

				// 変更直後もブロックが壊れていないこと
				expectValidBlocks(await getBlockReport(page), "変更直後");
				await savePost(page);

				// 再読み込み後、変更した属性が保持されていること
				await openEditor(admin, page, postId);
				expectValidBlocks(await getBlockReport(page), "保存・再読み込み後");
				const notKept = await page.evaluate((expected) => {
					const { select } = window.wp.data;
					// 保存後は clientId が変わるため、ブロックの出現順で比較する
					const all = select("core/block-editor")
						.getClientIdsWithDescendants()
						.map((id) => select("core/block-editor").getBlock(id));
					const used = new Set();
					return expected
						.filter(({ name, updates }) => {
							const found = all.find(
								(block, i) =>
									!used.has(i) &&
									block.name === name &&
									Object.entries(updates).every(
										([k, v]) => block.attributes[k] === v,
									) &&
									used.add(i),
							);
							return !found;
						})
						.map(({ name, updates }) => `${name}: ${JSON.stringify(updates)}`);
				}, changes);
				expect(notKept, "変更した画像・位置が保存されていること").toEqual([]);

				if (imageChanges.length) {
					await page.goto(`/?page_id=${postId}&preview=true`);
					expect
						.soft(
							await page.content(),
							"差し替えた画像がフロントに表示されること",
						)
						.toContain(TEST_IMAGE_NAME);
				}

				expect(pageErrors, "JavaScript エラーが発生しないこと").toEqual([]);
			});
		});
	}
});

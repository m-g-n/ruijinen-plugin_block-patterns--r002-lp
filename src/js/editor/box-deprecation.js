/**
 * Snow Monkey Blocks の box ブロックに、旧形式マークアップ用の deprecation を追加する.
 *
 * 旧形式（.smb-box__background にインラインの border-color / border-width / opacity を持つ形式）は
 * borderWidth の初期値が 1 だったため、コメント属性に borderWidth が保存されていない。
 * Snow Monkey Blocks 側の該当 deprecation は borderWidth に初期値が無いため一致せず、
 * 「無効なコンテンツ」と判定される。ここでは初期値を 1 にした同じ定義を追加する。
 * save は Snow Monkey Blocks の src/blocks/box/deprecated.js（2番目の定義）と同じ内容。
 */
((wp) => {
	const { addFilter } = wp.hooks;
	const { createElement: el } = wp.element;
	const { useBlockProps, useInnerBlocksProps } = wp.blockEditor;

	// hex-to-rgba パッケージと同じ書式で返す
	const hexToRgba = (hex, alpha) => {
		let value = hex.replace("#", "");
		if (3 === value.length) {
			value = value.replace(/(.)/g, "$1$1");
		}
		const [r, g, b] = [0, 2, 4].map((i) => parseInt(value.slice(i, i + 2), 16));
		return `rgba(${r}, ${g}, ${b}, ${alpha})`;
	};

	const legacyDeprecation = (settings) => ({
		attributes: {
			...settings.attributes,
			borderRadius: {
				type: "number",
			},
			borderWidth: {
				type: "number",
				default: 1,
			},
			contentPadding: {
				type: "string",
				default: "",
			},
		},

		supports: {
			...settings.supports,
		},

		save({ attributes, className }) {
			const {
				backgroundColor,
				backgroundGradientColor,
				borderColor,
				textColor,
				borderWidth,
				borderRadius,
				opacity,
				contentPadding,
				boxShadow,
			} = attributes;

			const boxStyles = {
				color: textColor || undefined,
				borderRadius: 0 <= borderRadius ? `${borderRadius}px` : undefined,
				boxShadow: boxShadow?.color
					? `${boxShadow.horizontal}px ${boxShadow.vertical}px ${
							boxShadow.blur
						}px ${boxShadow.spread}px ${hexToRgba(
							boxShadow.color,
							boxShadow.opacity,
						)}`
					: undefined,
			};

			const backgroundStyles = {
				backgroundColor: backgroundColor || undefined,
				backgroundImage: backgroundGradientColor || undefined,
				borderColor: borderColor || undefined,
				borderWidth: borderWidth || undefined,
				borderRadius: 0 <= borderRadius ? `${borderRadius}px` : undefined,
				opacity,
			};

			const classes = [
				"smb-box",
				className,
				contentPadding ? `smb-box--p-${contentPadding}` : "",
			]
				.filter(Boolean)
				.join(" ");

			return el(
				"div",
				useBlockProps.save({ className: classes, style: boxStyles }),
				el("div", {
					className: "smb-box__background",
					style: backgroundStyles,
				}),
				el("div", useInnerBlocksProps.save({ className: "smb-box__body" })),
			);
		},
	});

	addFilter(
		"blocks.registerBlockType",
		"ruijinen-r002-lp/box-legacy-deprecation",
		(settings, name) => {
			if ("snow-monkey-blocks/box" !== name) {
				return settings;
			}
			return {
				...settings,
				deprecated: [
					...(settings.deprecated || []),
					legacyDeprecation(settings),
				],
			};
		},
	);
})(window.wp);

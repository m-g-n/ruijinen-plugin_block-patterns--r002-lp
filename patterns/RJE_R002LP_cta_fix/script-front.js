window.addEventListener(
	"load",
	() => {
		const cta = document.getElementsByClassName(
			"is-style-RJE_R002LP_cta_fix",
		)[0];
		const close_html =
			'<button type="button" aria-label="閉じる" class="close-btn">×</button>';
		const pageTop = document.getElementById("page-top");
		if (cta) {
			const cta_item = cta.getElementsByClassName("smb-items__item")[0];
			if (!cta_item) {
				return;
			}
			//閉じるボタンの付与、ボタンクリック時に非表示classを付与
			cta_item.insertAdjacentHTML("beforeend", close_html);
			const cta_close = cta_item.getElementsByClassName("close-btn")[0];
			cta_close.addEventListener("click", () => {
				cta_item.classList.add("is-hidden");
			});
			//ページトップボタンが表示された場合は表示位置をコントロールするclassを付与
			if (!pageTop) {
				return;
			}
			const handleScroll = throttle(() => {
				cta.classList.toggle("is-visible_page_top", 500 <= window.scrollY);
			}, 150);
			window.addEventListener("scroll", handleScroll, { passive: true });
		}
	},
	false,
);

//ヘルパー関数 - Snow Monkeyから流用
function throttle(callback, delay) {
	let time = Date.now();
	return (...args) => {
		if (time + delay - Date.now() < 0) {
			callback(...args);
			time = Date.now();
		}
	};
}

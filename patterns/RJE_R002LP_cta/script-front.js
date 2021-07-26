/**
* CTA固定パターンに閉じるボタンを付与し、ボタンクリック時に非表示classを付与
*/

window.onload = function() {
	let cta = document.getElementsByClassName('is-style-RJE_R002LP_cta_fix');
	let cta_close = '';
	let close_html = '<button aria-label="閉じる" class="close-btn">×</button>';
	if ( cta ) {
		cta = cta[0].getElementsByClassName('smb-items__item')[0];
		cta.insertAdjacentHTML('beforeend', close_html);
		cta_close = cta.getElementsByClassName('close-btn');
		cta_close[0].onclick = function changeContent() {
			cta.classList.add('is-hidden');
		}
	}
};
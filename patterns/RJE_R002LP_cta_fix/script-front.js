window.addEventListener(
	'load',
	() => {
		
		let cta = document.getElementsByClassName('is-style-RJE_R002LP_cta_fix')[0];
		let cta_close = '';
		const close_html = '<button aria-label="閉じる" class="close-btn">×</button>';
		const pageTop = document.getElementById('page-top');
		if ( cta ) {
			//閉じるボタンの付与、ボタンクリック時に非表示classを付与
			let cta_item = cta.getElementsByClassName('smb-items__item')[0];
			cta_item.insertAdjacentHTML('beforeend', close_html);
			cta_close = cta_item.getElementsByClassName('close-btn')[0];
			cta_close.onclick = function changeContent() {
				cta_item.classList.add('is-hidden');
			}
			//ページトップボタンが表示された場合は表示位置をコントロールするclassを付与
			if (! pageTop) {
				return;
			}
			const handleScroll = throttle(
				() => {
					if (500 <= window.pageYOffset) {
						cta.classList.add('is-visible_page_top');
					} else {
						cta.classList.remove('is-visible_page_top');
					}
				},
				150
			);
			window.addEventListener('scroll', handleScroll, isPassiveSupported() ? { passive: true } : false);
		}
	},
	false
);

//ヘルパー関数 - Snow Monkeyから流用
function throttle(callback, delay) {
  let time = Date.now();
  return () => {
    if ((time + delay - Date.now()) < 0) {
      callback.apply(this, arguments);
      time = Date.now();
    }
  };
}

function isPassiveSupported() {
  let passiveSupported = false;

  try {
    const options = Object.defineProperty(
      {},
      'passive',
      {
        get: () => {
          passiveSupported = true;
        }
      }
    );

    window.addEventListener('test', options, options);
    window.removeEventListener('test', options, options);
  } catch(err) {
    passiveSupported = false;
  }

  return passiveSupported;
}
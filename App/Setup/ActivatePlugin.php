<?php
/**
 * @package ruijinen-r002-lp
 * @author mgn
 * @license GPL-2.0+
 */

namespace Ruijinen\Pattern\R002LP\App\Setup;

class ActivatePlugin {
	/**
	 * 類人猿パターンプラグイン本体が有効でない場合のメッセージ.
	 */
	public function alert_notice_petterns_master() {
		?>
	<div class="error">
		<p>[類人猿ブロックパターン]LP向けパターン集を利用するには、類人猿ブロックパターンプラグインが必要です</p>
	</div>
		<?php
	}
}
<?php
/**
 * Plugin name: 類人猿ブロックパターン：LP向けパターン集
 * Description: 類人猿ブロックパターン LP向けパターンアドオンです
 * Version: 0.0.1.9
 * Tested up to: 5.9-RC3
 * Requires at least: 5.9-RC3
 * Author: mgn Inc.,
 * Author URI: https://rui-jin-en.com/
 * License: GPL-2.0+
 *
 * @package ruijinen-block-patterns
 */

namespace Ruijinen\Pattern\R002LP;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 定数・グローバル変数
 */
define( 'RJE_R002LP_KEY', 'RJE_R002LP' ); // どの類人猿プロダクトなのかを示すキー
define( 'RJE_R002LP_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) . '/' ); // このプラグインのURL
define( 'RJE_R002LP_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/' ); // このプラグインのパス
define( 'RJE_R002LP_BASENAME', plugin_basename( __FILE__ ) ); // このプラグインのベースネーム.
define( 'RJE_R002LP_TEXTDOMAIN', 'ruijinen-r002-lp' ); //テキストドメイン名.

/**
 * include files.
 */
require_once(RJE_R002LP_PATH . 'vendor/autoload.php'); //アップデート用composer.

//各処理用のクラスを読み込む
foreach (glob(RJE_R002LP_PATH.'App/**/*.php') as $filename) {
	require_once $filename;
}

/**
 * 初期設定.
 */
class Bootstrap {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'bootstrap' ] );
		add_action( 'init', [ $this, 'load_textdomain' ] );
	}

	/**
	 * Bootstrap.
	 */
	public function bootstrap() {
		new App\Setup\AutoUpdate(); //自動更新チェック

		//アクティベートチェックを行い問題がある場合はメッセージを出し離脱する.
		$activate_check = new App\Setup\ActivateCheck();
		if ( !empty( $activate_check->messages ) ) {
			add_action('admin_notices', array( $activate_check,'make_alert_message'));
			return;
		}

		// LPパターン用の汎用CSS・JS読み込み・テンプレートの読み込み
		new App\Setup\Assets();
		$this->register_patterns();
	}

	/**
	 * Load Textdomain.
	 */
	public function load_textdomain() {
		new App\Setup\TextDomain();
	}

	/**
	 * Register Block Patterns.
	 */
	public function register_patterns() {
		global $rje_r002lp_patterns;
		$rje_r002lp_patterns = new App\Patterns\RegisterPatterns();
		new App\Patterns\RegisterCategory();
	}
}

new Bootstrap();
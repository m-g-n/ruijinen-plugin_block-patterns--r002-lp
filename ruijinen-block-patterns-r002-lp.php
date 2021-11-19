<?php
/**
 * Plugin name: 類人猿ブロックパターン：LP向けパターン集
 * Description: 類人猿ブロックパターン LP向けパターンアドオンです
 * Version: 0.0.1.5
 * Tested up to: 5.8.1
 * Requires at least: 5.8.1
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
		add_action( 'plugins_loaded', [ $this, 'register_patterns' ] );
	}

	/**
	 * Bootstrap.
	 */
	public function bootstrap() {
		//クラスオブジェクト作成
		new App\Setup\ActivatePlugin();
		new App\Setup\AutoUpdate();
		new App\Setup\TextDomain();
		new App\Setup\Assets();
	}

	/**
	 * Register Block Patterns.
	 */
	public function register_patterns() {
		if ( class_exists('\Ruijinen\Pattern\RegisterBlockPatterns') ) { //本体のパターン生成のクラスが存在するか
			//TODO：グローバル変数ではなく、静的メソッドとして呼び出したい
			global $rje_r002lp_patterns;
			$rje_r002lp_patterns = new App\Patterns\RegisterPatterns();
			new App\Patterns\RegisterCategory();
		} else {
			add_action( 'admin_notices', array ( new App\Setup\ActivatePlugin(), 'alert_notice_petterns_master' ) );
			return false;
		}
	}
}

new Bootstrap();
<?php
/**
 * Plugin name: 類人猿ブロックパターン：LP向けパターン集
 * Description: 類人猿ブロックパターン LP向けパターンアドオンです
 * Version: 0.0.0.14
 * Tested up to: 5.8
 * Requires at least: 5.8
 * Author: mgn Inc.,
 * Author URI: https://rui-jin-en.com/
 * License: GPL-2.0+
 *
 * @package ruijinen-block-patterns
 */

/**
 * 定数・グローバル変数
 */
define( 'RJE_R002LP_KEY', 'RJE_R002LP' ); // どの類人猿プロダクトなのかを示すキー
define( 'RJE_R002LP_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) . '/' ); // このプラグインのURL
define( 'RJE_R002LP_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/' ); // このプラグインのパス
define( 'RJE_R002LP_BASENAME', plugin_basename( __FILE__ ) ); // このプラグインのベースネーム.


/**
 * テキストドメインを宣言
 */
add_action(
	'plugins_loaded',
	function () {
		load_plugin_textdomain( 'ruijinen-block-patterns-r002-lp', false, dirname( RJE_R002LP_BASENAME ) . '/languages/' );
	}
);


/**
* 各ファイルの読み込み
*/
require_once RJE_R002LP_PATH . 'inc/activate.php'; // 類人猿ブロックパターン本体 が有効化されていない場合の処理.
require_once RJE_R002LP_PATH . 'inc/auto-update.php'; // 自動アップデート.
require_once RJE_R002LP_PATH . 'vendor/autoload.php'; // 自動アップデート処理用のcomposer読み込み.

/**
* LPブロックパターン共通のスタイル・スクリプトの読み込み
*/
add_action(
	'wp_enqueue_scripts',
	function () {
		$path = 'dist/css/common.css';
		wp_enqueue_style( RJE_R002LP_KEY . 'common', RJE_R002LP_URL . $path, [ \Framework\Helper::get_main_style_handle() ], filemtime( RJE_R002LP_PATH . $path ) );
	},
	10
);
add_action(
	'enqueue_block_editor_assets',
	function () {
		$path = 'dist/css/common.css';
		wp_enqueue_style( RJE_R002LP_KEY . 'common', RJE_R002LP_URL . $path, [ \Framework\Helper::get_main_style_handle() ], filemtime( RJE_R002LP_PATH . $path ) );
	},
	10
);


/**
* LPブロックパターン用のカテゴリを登録
*/
add_action(
	'init',
	function () {
		register_block_pattern_category( RJE_R002LP_KEY, array( 'label' => '[類人猿] LPサイト' ) );
	},
	10
);


/**
* フィルターフックにてブロックパターン登録内容を追加
*
* @param array $args すでに設定されている各パターン登録内容。
*/
add_action( 'plugins_loaded', 'rje_r002lp_register_patterns' );
function rje_r002lp_register_patterns() {
	// 登録するパターンをhookに追加
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_hero_media_and_text', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_hero_media_and_text__alignright', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_hero_one_column', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_message_normal', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_message_normal__alignright', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_message_accent', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_message_accent2', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_flow', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_merit', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_voices', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_faq', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_gallery', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_variation', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_media_list', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_corp_list', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_spec', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_news', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_prices', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_cta', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_cta_fix', 10 );
}
function rje_r002lp_hero_media_and_text( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_hero_media_and_text',
		'title'          => 'Heroイメージ（メディアと文章)',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_hero_media_and_text', RJE_R002LP_KEY . '_spacer_top', RJE_R002LP_KEY . '_spacer_bottom' ), //汎用スペーサースタイルもここで読み込む
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_hero_media_and_text__alignright( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_hero_media_and_text__alignright',
		'title'          => 'Heroイメージ（メディアと文章) - 右寄せ',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_hero_media_and_text' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_hero_one_column( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_hero_one_column',
		'title'          => 'Heroイメージ（1カラム)',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_hero_one_column' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_message_normal( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_message_normal',
		'title'          => '伝えたいこと（ノーマル)',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_message_normal' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_message_normal__alignright( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_message_normal__alignright',
		'title'          => '伝えたいこと（ノーマル) - 右寄せ',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_message_normal' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_message_accent( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_message_accent',
		'title'          => '伝えたいこと（アクセント)',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_message_accent' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_message_accent2( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_message_accent2',
		'title'          => '伝えたいこと（アクセント2)',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_message_accent2' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_flow( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_flow',
		'title'          => '流れ・手順',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_flow_panels' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_merit( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_merit',
		'title'          => 'メリット・ポイント',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_merit_panels' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_voices( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_voices',
		'title'          => 'お客様の声',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_voices_items' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_faq( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_faq',
		'title'          => 'よくある質問',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_faq_items' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_gallery( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_gallery',
		'title'          => 'ギャラリー',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_gallery_items' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_variation( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_variation',
		'title'          => 'バリエーション',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_variation_items' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_media_list( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_media_list',
		'title'          => 'メディア掲載一覧',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_media_list_items' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_corp_list( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_corp_list',
		'title'          => '採用企業一覧',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_corp_list_items' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_spec( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_spec',
		'title'          => 'サービス・製品仕様',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_spec_content' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_news( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_news',
		'title'          => 'お知らせ一覧',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_news_list' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_prices( $args ) {
	$args[] = array(
		'key'            => RJE_R002LP_KEY . '_prices',
		'title'          => '料金表',
		'cat'            => array( RJE_R002LP_KEY ),
		'specific-style' => false,
		'specific-script' => false,
		'block-style'    => array( RJE_R002LP_KEY . '_section1', RJE_R002LP_KEY . '_price_list' ),
		'path'           => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_cta( $args ) {
	$args[] = array(
		'key'             => RJE_R002LP_KEY . '_cta',
		'title'           => 'CTA',
		'cat'             => array( RJE_R002LP_KEY ),
		'specific-style'  => false,
		'specific-script' => false,
		'block-style'     => array( RJE_R002LP_KEY . '_cta' ),
		'path'            => RJE_R002LP_PATH,
	);
	return $args;
}
function rje_r002lp_cta_fix( $args ) {
	$args[] = array(
		'key'             => RJE_R002LP_KEY . '_cta_fix',
		'title'           => 'CTA（固定表示）',
		'cat'             => array( RJE_R002LP_KEY ),
		'specific-style'  => false,
		'specific-script' => true,
		'block-style'     => array( RJE_R002LP_KEY . '_cta_fix' ),
		'path'            => RJE_R002LP_PATH,
	);
	return $args;
}
<?php
/**
 * Plugin name: 類人猿ブロックパターン：LP向けパターン集
 * Description: 類人猿ブロックパターン LP向けパターンアドオンです
 * Version: 0.0.1
 * Author: mgn Inc.,
 * Author URI: https://rui-jin-en.com/
 * License: GPL-2.0+
 *
 * @package ruijinen-block-patterns
 */


define( 'RJE_R002LP_KEY', 'RJE_R002LP' ); // どの類人猿プロダクトなのかを示すキー
define( 'RJE_R002LP_PATH', plugin_dir_path( __FILE__ ) ); // このプラグインのパス

//TODO：アクティベート制御・更新チェック


/**
* LPブロックパターン用のカテゴリを登録
*/
add_action(
	'init',
	function () {
		register_block_pattern_category( RJE_P002LP_KEY, array( 'label' => '[類人猿] LPサイト' ) );
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
	//登録するパターンをhookに追加
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_hero_media_and_text', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_hero_media_and_text__alignright', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_hero_one_column', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_message_normal', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_message_normal__alignright', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_message_accent', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_message_accent2', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_flow', 10 );
	add_filter( 'rje_register_patterns_args', 'rje_r002lp_merit', 10 );
}
function rje_r002lp_hero_media_and_text ( $args ) {
	$args[] = array(
		'key'   => RJE_P002LP_KEY . '_hero_media_and_text',
		'title' => 'Heroイメージ（メディアと文章)',
		'cat'   => array( RJE_P002LP_KEY ),
		'style' => array( RJE_P002LP_KEY . '_hero_media_and_text' ),
		'path'  => RJE_P002LP_PATH
	);
	return $args;
}
function rje_r002lp_hero_media_and_text__alignright ( $args ) {
	$args[] = array(
		'key'   => RJE_P002LP_KEY . '_hero_media_and_text__alignright',
		'title' => 'Heroイメージ（メディアと文章) - 右寄せ',
		'cat'   => array( RJE_P002LP_KEY ),
		'style' => array( RJE_P002LP_KEY.'_hero_media_and_text' ),
		'path'  => RJE_P002LP_PATH
	);
	return $args;
}
function rje_r002lp_hero_one_column ( $args ) {
	$args[] = array(
		'key'   => RJE_P002LP_KEY . '_hero_one_column',
		'title' => 'Heroイメージ（1カラム)',
		'cat'   => array( RJE_P002LP_KEY ),
		'style' => array( RJE_P002LP_KEY.'_hero_one_column' ),
		'path'  => RJE_P002LP_PATH
	);
	return $args;
}
function rje_r002lp_message_normal ( $args ) {
	$args[] = array(
		'key'   => RJE_P002LP_KEY . '_message_normal',
		'title' => '伝えたいこと（ノーマル)',
		'cat'   => array( RJE_P002LP_KEY ),
		'style' => array( RJE_P002LP_KEY.'_message_normal' ),
		'path'  => RJE_P002LP_PATH
	);
	return $args;
}
function rje_r002lp_message_normal__alignright ( $args ) {
	$args[] = array(
		'key'   => RJE_P002LP_KEY . '_message_normal__alignright',
		'title' => '伝えたいこと（ノーマル) - 右寄せ',
		'cat'   => array( RJE_P002LP_KEY ),
		'style' => array( RJE_P002LP_KEY.'_message_normal' ),
		'path'  => RJE_P002LP_PATH
	);
	return $args;
}
function rje_r002lp_message_accent ( $args ) {
	$args[] = array(
		'key'   => RJE_P002LP_KEY . '_message_accent',
		'title' => '伝えたいこと（アクセント)',
		'cat'   => array( RJE_P002LP_KEY ),
		'style' => array( RJE_P002LP_KEY.'_message_accent' ),
		'path'  => RJE_P002LP_PATH
	);
	return $args;
}
function rje_r002lp_message_accent2 ( $args ) {
	$args[] = array(
		'key'   => RJE_P002LP_KEY . '_message_accent2',
		'title' => '伝えたいこと（アクセント2)',
		'cat'   => array( RJE_P002LP_KEY ),
		'style' => array( RJE_P002LP_KEY.'_message_accent2' ),
		'path'  => RJE_P002LP_PATH
	);
	return $args;
}
function rje_r002lp_flow ( $args ) {
	$args[] = array(
		'key'   => RJE_P002LP_KEY . '_flow',
		'title' => '流れ・手順',
		'cat'   => array( RJE_P002LP_KEY ),
		'style' => array( RJE_P002LP_KEY.'_flow' ),
		'path'  => RJE_P002LP_PATH
	);
	return $args;
}
function rje_r002lp_merit ( $args ) {
	$args[] = array(
		'key'   => RJE_P002LP_KEY . '_merit',
		'title' => 'メリット・ポイント',
		'cat'   => array( RJE_P002LP_KEY ),
		'style' => array( RJE_P002LP_KEY.'_merit' ),
		'path'  => RJE_P002LP_PATH
	);
	return $args;
}
function rje_r002lp_voice ( $args ) {
	$args[] = array(
		'key'   => RJE_P002LP_KEY . '_voice',
		'title' => 'お客様の声',
		'cat'   => array( RJE_P002LP_KEY ),
		'style' => array( RJE_P002LP_KEY.'_voice' ),
		'path'  => RJE_P002LP_PATH
	);
	return $args;
}
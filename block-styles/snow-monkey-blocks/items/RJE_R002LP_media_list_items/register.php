<?php
/**
 * @package ruijinen-block-patterns
 * @author mgn
 * @license GPL-2.0+
 */

$override_block_name = 'snow-monkey-blocks/items';
$block_style_label   = '類人猿P002_LP メディア掲載一覧';
$basename = basename( __DIR__ );
$front_filename  = 'dist/css/block-styles/' . $override_block_name . '/' . $basename . '/style-front.css';
$editor_filename = 'dist/css/block-styles/' . $override_block_name . '/' . $basename . '/style-editor.css';

//ファイルパス（プラグインのルートから相対）
register_block_style(
	$override_block_name,
	array(
		'name'  => $basename,
		'label' => $block_style_label,
	)
);

//フロント・エディター用のCSSファイルを登録
wp_register_style( 'is-style-' . $basename . '-front', RJE_R002LP_URL . $front_filename, $this->style_front_deps, filemtime( RJE_R002LP_PATH . $front_filename ) );
wp_register_style( 'is-style-' . $basename . '-editor', RJE_R002LP_URL . $editor_filename, $this->style_editor_deps, filemtime( RJE_R002LP_PATH . $editor_filename ) );
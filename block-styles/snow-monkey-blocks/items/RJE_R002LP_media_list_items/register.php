<?php
/**
 * @package ruijinen-block-patterns
 * @author mgn
 * @license GPL-2.0+
 */

$override_block_name = 'snow-monkey-blocks/items';
$block_style_label   = '類人猿R002_LP メディア掲載一覧';

//各ファイルパスなどを設定.
$basename = basename( __DIR__ );
$dist_dir_path = 'dist/css/block-styles/' . $override_block_name . '/' . $basename . '/';
$front_filename  = $dist_dir_path . 'style-front.css';
$editor_filename = $dist_dir_path . 'style-editor.css';

$front_filetime = ( file_exists( RJE_R002LP_PATH . $front_filename ) ) ? filemtime( RJE_R002LP_PATH . $front_filename ) : NULL;
$editor_filetime = ( file_exists( RJE_R002LP_PATH . $editor_filename ) ) ? filemtime( RJE_R002LP_PATH . $editor_filename ) : NULL;

//ファイルパス（プラグインのルートから相対）
register_block_style(
	$override_block_name,
	array(
		'name'  => $basename,
		'label' => $block_style_label,
	)
);

//フロント用のCSSファイルを登録
wp_register_style( 'is-style-' . $basename . '-front', RJE_R002LP_URL . $front_filename, $this->sm_style_handles, $front_filetime );

//エディター用のCSSファイルを登録
add_editor_style('../../plugins/'.RJE_R002LP_DIRNAME.'/'.$front_filename);
wp_register_style( 'is-style-' . $basename . '-editor', RJE_R002LP_URL . $editor_filename, $this->sm_style_handles, $editor_filetime );

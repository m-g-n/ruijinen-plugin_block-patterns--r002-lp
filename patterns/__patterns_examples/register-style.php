<?php
/**
 * お客様の声固有のスタイルを登録
 * 
 * @package ruijinen-block-patterns
 * @author mgn
 * @license GPL-2.0+
 */

//ファイルパス（プラグインのルートから相対）
$basename = basename( __DIR__ );
$front_filename = 'dist/css/patterns/' . $basename . '/style-front.css';
$editor_filename = 'dist/css/patterns/' . $basename . '/style-editor.css';

//フロント・エディター用のCSSファイルを登録
wp_register_style( $basename . '-front', RJE_R002LP_URL . $front_filename, $this->sm_style_handles, filemtime( RJE_R002LP_PATH . $front_filename ) );
wp_register_style( $basename . '-editor', RJE_R002LP_URL . $editor_filename, $this->sm_style_handles, filemtime( RJE_R002LP_PATH . $editor_filename ) );
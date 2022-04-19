<?php
/**
 * CTAブロックパターン固有のスクリプトを登録
 * 
 * @package ruijinen-block-patterns
 * @author mgn
 * @license GPL-2.0+
 */

//ファイルパス（プラグインのルートから相対）
$basename = basename( __DIR__ );
$front_filename = 'dist/js/patterns/' . $basename . '/script-front.js';
$front_filetime = ( file_exists( RJE_R002LP_PATH . $front_filename ) ) ? filemtime( RJE_R002LP_PATH . $front_filename ) : NULL;


//フロント・エディター用のCSSファイルを登録
wp_register_script( $basename . '-script-front', RJE_R002LP_URL . $front_filename, '', $front_filetime, true );
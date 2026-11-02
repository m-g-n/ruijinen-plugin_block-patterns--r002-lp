<?php
/**
 * @package ruijinen-skin-r002-lp
 * @author mgn
 * @license GPL-2.0+
 */

namespace Ruijinen\Pattern\R002LP\App\Setup;

class Assets {
	/**
	 * Propaties.
	 */
	public $sm_style_handles  = ''; //Snow Monkey のメインスタイルのハンドルを格納.

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'get_sm_style_handles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_assets' ] );
	}

	/**
	 * get Snow Monkey Style Hadles.
	 */
	public function get_sm_style_handles () {
		//Snow Monkeyテーマからメインスタイルのハンドルを取得
		if ( method_exists('\Framework\Helper', 'get_main_style_handle') ) {
			$this->sm_style_handles = \Framework\Helper::get_main_style_handle();
		}
	}

	/**
	 * 共通CSSの依存ハンドル（Snow Monkey以外のテーマでは依存なし）.
	 *
	 * @return array
	 */
	private function get_style_deps() {
		return $this->sm_style_handles ? array( $this->sm_style_handles ) : array();
	}

	/**
	 * Enqueue front assets
	 */
	public function wp_enqueue_scripts() {
		$path = 'dist/css/common.css';
		wp_enqueue_style( RJE_R002LP_KEY . '_common', RJE_R002LP_URL . $path, $this->get_style_deps(), filemtime( RJE_R002LP_PATH . $path ) );
	}

	/**
	 * Enqueue Block Editor Assets
	 */
	public function enqueue_block_editor_assets() {
		$path = 'dist/css/common.css';
		wp_enqueue_style( RJE_R002LP_KEY . '_common', RJE_R002LP_URL . $path, $this->get_style_deps(), filemtime( RJE_R002LP_PATH . $path ) );

		//旧形式の box ブロックを読み込めるようにする（ブロック登録前に読み込むため head で出力）
		$path = 'dist/js/editor/box-deprecation.js';
		wp_enqueue_script(
			RJE_R002LP_KEY . '_box_deprecation',
			RJE_R002LP_URL . $path,
			array( 'wp-hooks', 'wp-element', 'wp-block-editor' ),
			filemtime( RJE_R002LP_PATH . $path ),
			false
		);
	}
}

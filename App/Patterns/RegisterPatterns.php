<?php
/**
 * @package ruijinen-r002-lp
 * @author mgn
 * @license GPL-2.0+
 */

namespace Ruijinen\Pattern\R002LP\App\Patterns;

class RegisterPatterns {
	/**
	 * Constructor.
	 */
	public function __construct( $variable_name ) {
		//フィルターに登録したいメソッドの情報
		$methods = array(
			array(
				'name' => 'hero_media_and_text',
				'label' => 'Heroイメージ（メディアと文章',
				'priority' => 1
			),
			array(
				'name' => 'hero_media_and_text__alignright',
				'label' => 'Heroイメージ（メディアと文章) - 右寄せ',
				'priority' => 2
			),
			array(
				'name' => 'hero_one_column',
				'label' => 'Heroイメージ（1カラム)',
				'priority' => 3
			),
			array(
				'name' => 'message_normal',
				'label' => '伝えたいこと（ノーマル)',
				'priority' => 4
			),
			array(
				'name' => 'message_normal__alignright',
				'label' => '伝えたいこと（ノーマル) - 右寄せ',
				'priority' => 5
			),
			array(
				'name' => 'message_accent',
				'label' => '伝えたいこと（アクセント)',
				'priority' => 6
			),
			array(
				'name' => 'message_accent2',
				'label' => '伝えたいこと（アクセント2)',
				'priority' => 7
			),
			array(
				'name' => 'flow',
				'label' => '流れ・手順',
				'priority' => 8
			),
			array(
				'name' => 'merit',
				'label' => 'メリット・ポイント',
				'priority' => 9
			),
			array(
				'name' => 'voices',
				'label' => 'お客様の声',
				'priority' => 10
			),
			array(
				'name' => 'faq',
				'label' => 'よくある質問',
				'priority' => 11
			),
			array(
				'name' => 'gallery',
				'label' => 'ギャラリー',
				'priority' => 12
			),
			array(
				'name' => 'variation',
				'label' => 'バリエーション',
				'priority' => 13
			),
			array(
				'name' => 'media_list',
				'label' => 'メディア掲載一覧',
				'priority' => 14
			),
			array(
				'name' => 'corp_list',
				'label' => '採用企業一覧',
				'priority' => 15
			),
			array(
				'name' => 'spec',
				'label' => 'サービス・製品仕様',
				'priority' => 16
			),
			array(
				'name' => 'prices',
				'label' => '料金表',
				'priority' => 18
			),
			array(
				'name' => 'cta',
				'label' => 'CTA',
				'priority' => 19
			),
			array(
				'name' => 'cta_fix',
				'label' => 'CTA（固定表示）',
				'priority' => 20
			)
		);

		//Snow Monkey専用のパターン情報を追加
		if ( 'snow-monkey' === RJE_ACTIVATE_THEME ) {
			$sm_patterns = array(
				array(
					'name' => 'news',
					'label' => 'お知らせ一覧',
					'priority' => 17
				)
			);
			$methods = array_merge($methods, $sm_patterns);
		}

		//無効化のオプションページに情報を登録
		add_filter(
			'rje_option_unregister_args',
			function ( $args ) use ( $variable_name, $methods ) {
				$lp = array(
					'section_id'   => $variable_name,
					'section_name' => 'LP向けパターン集',
					'fields' => $methods
				);
				array_push( $args, $lp );
				return $args;
			}
		);

		//パターンの情報をフィルターに登録
		foreach ( $methods as $method ) {
			add_filter( 'rje_register_patterns_args', array( $this, $method['name'] ), $method['priority'] );
		}
	}

	public function hero_media_and_text( $args ) {
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
	public function hero_media_and_text__alignright( $args ) {
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
	public function hero_one_column( $args ) {
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
	public function message_normal( $args ) {
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
	public function message_normal__alignright( $args ) {
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
	public function message_accent( $args ) {
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
	public function message_accent2( $args ) {
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
	public function flow( $args ) {
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
	public function merit( $args ) {
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
	public function voices( $args ) {
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
	public function faq( $args ) {
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
	public function gallery( $args ) {
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
	public function variation( $args ) {
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
	public function media_list( $args ) {
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
	public function corp_list( $args ) {
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
	public function spec( $args ) {
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
	public function news( $args ) {
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
	public function prices( $args ) {
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
	public function cta( $args ) {
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
	public function cta_fix( $args ) {
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
}

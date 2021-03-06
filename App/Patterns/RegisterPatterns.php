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
	public function __construct() {
		// 登録するパターンをhookに追加
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_hero_media_and_text' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_hero_media_and_text__alignright' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_hero_one_column' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_message_normal' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_message_normal__alignright' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_message_accent' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_message_accent2' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_flow' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_merit' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_voices' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_faq' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_gallery' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_variation' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_media_list' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_corp_list' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_spec' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_news' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_prices' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_cta' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r002lp_cta_fix' ), 10 );
	}

	public function rje_r002lp_hero_media_and_text( $args ) {
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
	public function rje_r002lp_hero_media_and_text__alignright( $args ) {
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
	public function rje_r002lp_hero_one_column( $args ) {
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
	public function rje_r002lp_message_normal( $args ) {
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
	public function rje_r002lp_message_normal__alignright( $args ) {
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
	public function rje_r002lp_message_accent( $args ) {
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
	public function rje_r002lp_message_accent2( $args ) {
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
	public function rje_r002lp_flow( $args ) {
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
	public function rje_r002lp_merit( $args ) {
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
	public function rje_r002lp_voices( $args ) {
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
	public function rje_r002lp_faq( $args ) {
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
	public function rje_r002lp_gallery( $args ) {
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
	public function rje_r002lp_variation( $args ) {
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
	public function rje_r002lp_media_list( $args ) {
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
	public function rje_r002lp_corp_list( $args ) {
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
	public function rje_r002lp_spec( $args ) {
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
	public function rje_r002lp_news( $args ) {
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
	public function rje_r002lp_prices( $args ) {
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
	public function rje_r002lp_cta( $args ) {
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
	public function rje_r002lp_cta_fix( $args ) {
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
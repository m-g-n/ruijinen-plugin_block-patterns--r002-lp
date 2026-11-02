<?php
/**
 * @package ruijinen-r002-lp
 * @author mgn
 * @license GPL-2.0+
 */

namespace Ruijinen\Pattern\R002LP\App\Setup;

class InPluginUpdateMessage {

	//通知JSONのキャッシュ用トランジェント名
	const TRANSIENT_KEY = RJE_R002LP_KEY . '_update_notice';

	//初期処理
	public function __construct() {
		add_action( 'in_plugin_update_message-' . RJE_R002LP_BASENAME, array( $this, 'in_plugin_update_message' ), 10, 2 );
	}

	//更新画面のアラートボックスにメッセージを追加
	public function in_plugin_update_message( $data, $response ) {
		if ( empty( $data['new_version'] ) ) {
			return;
		}
		$messages = $this->get_the_notice_json( $data['new_version'] );
		if ( empty( $messages['message'] ) ) {
			return;
		}
		$message = '<br>' . wp_kses_post( $messages['message'] );
		if ( ! empty( $messages['url'] ) ) {
			$message .= '<a href="' . esc_url( $messages['url'] ) . '" target="_blank" rel="noopener"> &#62;&#62;詳細を見る</a>';
		}
		echo $message; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- 上記でエスケープ済み.
	}

	//JSONからデータを取得して必要なメッセージを返す
	private function get_the_notice_json( $version = null ) {
		$notices = get_transient( self::TRANSIENT_KEY );
		if ( false === $notices ) {
			$notices = $this->fetch_notices();
			//取得失敗時も短時間キャッシュし、プラグイン画面の表示のたびに通信しないようにする
			set_transient( self::TRANSIENT_KEY, $notices, $notices ? 12 * HOUR_IN_SECONDS : HOUR_IN_SECONDS );
		}
		return ( is_array( $notices ) && isset( $notices[ $version ] ) && is_array( $notices[ $version ] ) ) ? $notices[ $version ] : false; //指定のバージョンのキーがあったらメッセージ情報を取得
	}

	//通知JSONを取得し、バージョンをキーにした配列で返す（失敗時は空配列）
	private function fetch_notices() {
		$url      = 'https://rui-jin-en.com/update-notice/' . RJE_R002LP_KEY . '.json';
		$response = wp_remote_get( $url, array( 'timeout' => 5 ) );
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return array();
		}
		$json = wp_remote_retrieve_body( $response );
		if ( function_exists( 'mb_convert_encoding' ) ) {
			$json = mb_convert_encoding( $json, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-win' ); //文字コードをUTF-8に変換
		}
		$arr = json_decode( $json, true ); //JSONを連想配列に変換
		if ( ! is_array( $arr ) ) {
			return array();
		}
		//階層が１つ深いため配列の階層を1つ浅くする
		$notices = array();
		foreach ( $arr as $item ) {
			if ( is_array( $item ) ) {
				$notices = array_merge( $notices, $item );
			}
		}
		return $notices;
	}
}

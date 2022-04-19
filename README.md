[![Create Release](https://github.com/m-g-n/ruijinen-plugin_block-patterns--r002-lp/actions/workflows/release.yml/badge.svg)](https://github.com/m-g-n/ruijinen-plugin_block-patterns--r002-lp/actions/workflows/release.yml)

# 類人猿ブロックパターン：LP向けパターン集
WordPressテーマ Snow Monkeyを拡張する「類人猿ブロックパターンプラグイン」のLP向けパターン集アドオンです

# SCSSのコンパイル方法

当プラグインディレクトリーまで移動したあと、

- npm i(yarn)でpackegeをインストール
- npm gulp watch(yarn gulp watch)でSCSSファイルの修正を常時監視（SCSSを修正したら即時CSSにコンパイルしてくれる）
- npm gulp sass (yarn gulp sass)でCSSにコンパイル（コマンド走ったときだけCSSをコンパイル）

# comporserの準備

当プラグインディレクトリーまで移動したあと、

- composer install でパッケージをインストール

# 変更履歴
## 1.11.0
- Snow MonkeyのCSS用のハンドルを取得するプロパティ名を変更
- バージョン番号の桁を繰り上げ
- gulpでのコンパイルを廃止し、dart-scss・webpackで各種コンパイルを行う方式に変更

## 0.0.1.10
- Composerパッケージのアップデート
- PR用のGitHub Actionsの修正（バージョン番号取得の方法の変更）

## 0.0.1.9
- WordPress5.9対応
	- 編集画面でHeroイメージ（1カラム)のロゴ画像がセンターにならないバグ対応
	- 編集画面で編集画面用のCSSが一部読み込まれない部分の対応

## 0.0.1.8
- 伝えたいこと（ノーマル）のレイアウト崩れ対応
- load_textdomainのタイミングをinitに変更
- 類人猿ブロックパターン本体有効チェックの挙動を微調整
- Snow Monkey本体から呼び出しているメソッドを存在確認してから呼び出す方式に変更
- SCSSの調整

## 0.0.1.7
- 段落ブロックを利用時に文字サイズを変更しても実際の画面でサイズが変わらないバグを修正

## 0.0.1.6
- Heroイメージ（1カラム)をフル幅テンプレートで利用すると、コンテンツが中央に寄らないバグ修正

## 0.0.1.5
- Snow Monkey Blocks v13.3 変更内容に伴うパターンのHTML変更など

## 0.0.1.4
- CSSのスタイルでブロック名（wp-block-snow-monkey-xxx）で指定を行っていた箇所を別のクラス名で指定する形に変更
- CTAブロックより前に固定CTAブロックがある場合、実際の画面でCTA画面の後ろに固定CTAが回ってしまう不具合を対応

## 0.0.1.3
- v0.0.1.2で対応したサービス製品仕様パターンのブロック構造を戻しました

## 0.0.1.2
- 類人猿ブロックパターンプラグイン本体が有効かどうかの判定する仕組みを変更
- Snow Monkey Blocks v13.2.0対応
	- サービス製品仕様パターンのブロック構造の変更

## 0.0.1.1
- Snow Monkey Blocks v13.0.0 に対応

## 0.0.1.0
- 製品版リリース

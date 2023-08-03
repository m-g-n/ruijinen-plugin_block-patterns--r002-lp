[![Create Release](https://github.com/m-g-n/ruijinen-plugin_block-patterns--r002-lp/actions/workflows/release.yml/badge.svg)](https://github.com/m-g-n/ruijinen-plugin_block-patterns--r002-lp/actions/workflows/release.yml)

# 類人猿ブロックパターン：LP向けパターン集
WordPressテーマ Snow Monkeyを拡張する「類人猿ブロックパターンプラグイン」のLP向けパターン集アドオンです

# SCSSのコンパイル方法

当プラグインディレクトリーまで移動したあと、

- npm i(yarn)でpackegeをインストール
- npm run watch(yarn watch)でSCSSファイルの修正を常時監視（SCSSを修正したら即時CSSにコンパイルしてくれる）
- npm run build (yarn build)でCSSにコンパイル（コマンド走ったときだけCSSをコンパイル）

# comporserの準備

当プラグインディレクトリーまで移動したあと、

- composer install でパッケージをインストール

# 変更履歴
## 3.1.7
- パネル・項目ブロックを使ったパターンのスタイル調整
## 3.1.6
- 「伝えたいこと（ノーマル）」パターンのレイアウト崩れの修正
## 3.1.5
- LP向けパターン集のパターン内にコアのボタンブロックを設置しても、デフォルトの角丸が丸くならない不具合の修正
## 3.1.4
- Snow Monkey Blocks v19の仕様変更に伴い「Heroイメージ（メディアと文章)」「お客様の声」「サービス・製品仕様」「CTA」パターンのスタイルを調整
## 3.1.3
- ボタンのデフォルトの角丸の数値の指定方法の変更

## 3.1.2
- 各種パターン内のボタンの色・角丸について設定した値で表示されない不具合の対応
- CTAパターンのボタンの枠線の色を黒からボタンのテキストカラーになるように変更
- CTA（固定）パターンのボタンの背景色・文字色を設定で指定できるように変更
## 3.1.1
- CTAパターンの上部に隙間が空く崩れの対応
## 3.1.0
- Snow Monkey v19・Snow Monkey Blocks v18の対応
- Nodeパッケージの更新
## 3.0.0
- Snow Monkeyテーマ必須のパターンについて読み込みの条件処理を追加
## 2.0.0
- パターン無効化機能の実装
- Yarnをv1からv3にアップグレード
- 更新アラートボックスメッセージ表示機能を追加
## 1.18.0
- 画像をdist/img直ではなくsrc/imgから出力する形に変更
- Snow Monkey依存スタイル名取得用のプロパティ名の変更
- GitHub ActionsについてPRのマージなしのcloseは動かないように調整
- Nodeパッケージの更新

## 1.17.1
- JSのコンパイルの指示抜けを復旧

## 1.17.0
- 開発環境をlocalアプリからwp-envに変更
- BackstopJSを利用した差分チェックテストの導入

## 1.16.1
- README.mdにてv1.16.0の更新内容記述忘れの対応

## 1.16.0
- 編集画面にて「流れ・手順」パターンでアイテムに対して対象外の形式に変更したときに警告メッセージが表示されていない不具合を修正
- 「セクション1」ブロックスタイルで文字揃えを右揃えにしてもリード文が右揃えにならない現象の対応
- 編集画面にて「バリエーション」「採用企業一覧」「固定CTA」パターンの各アイテムの画像を設定しようとすると上部に隙間が空く問題の対応
- 編集画面にて「固定CTA」パターンのアイテムを2つ以上にした場合、2つ目以降が表示されない不具合の対応

## 1.15.0
- 編集画面でよくある質問パターンの回答が表示されず編集できない不具合の修正

## 1.14.1
- 内部処理のためバージョン更新（プラグインのコードは何も変更ありません）

## 1.14.0
- お知らせ一覧パターンのカテゴリー表記のレイアウト崩れの修正

## 1.13.0
- 編集画面で「CTA（固定）」パターンのプレビュー表示されない不具合の対応
- README.mdのSCSSコンパイルコマンドの更新
- プラグイン画面に表示する情報の追加

## 1.12.0
- CTA（固定表示）にてスマホ表示時にとじることができないバグを修正

## 1.11.2
- 編集画面用のCSS読み込みの処理を変更

## 1.11.1
- リリース用のGitHub Actionsの修正

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

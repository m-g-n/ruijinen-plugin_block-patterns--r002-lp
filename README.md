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
## 0.0.0.14
- CTAパターン上部のmarginを!importantに修正
- Hero1カラムのスタイル修正

## 0.0.0.13
- Release PRのタイトルにvがつかないように修正
- 共通CSSの依存関係をSnow Monkey公式の方法に変更
- editorCSSの優先度を高めるためにコードを修正

## 0.0.0.12
- Github Actionsエラー対応
## 0.0.0.11
- Github Actionsエラー対応
## 0.0.0.10
- 伝えたいこと（ノーマル）右揃えの修正
## 0.0.0.9
- 各種バグ修正
## 0.0.0.8
- 各種バグ修正
## 0.0.0.7
- 各種バグ修正
## 0.0.0.6
- release時のCI処理を変更
## 0.0.0.5
- Snow Monkey v15対応
## 0.0.0.4
- よくある質問ブロックパターンの追加
- ギャラリーブロックパターンの追加
- バリエーションブロックパターンの追加
- メディア掲載一覧ブロックパターンの追加
- 採用企業一覧ブロックパターンの追加
- サービス・製品仕様ブロックパターンの追加
- お知らせ一覧ブロックパターンの追加
- 料金表ブロックパターンの追加
- CTAブロックパターンの追加
- CTA（固定）ブロックパターンの追加
- パターン固有のJSを読み込むように調整

## 0.0.0.3
- composer設定の修正

## 0.0.0.2
- リリース用のzipファイル名変更
- アクティベート処理修正
- 翻訳ファイル設定
- オートアップデート設定

## 0.0.0.1
リリース初期整備
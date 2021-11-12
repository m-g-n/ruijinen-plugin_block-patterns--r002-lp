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

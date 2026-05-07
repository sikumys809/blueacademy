# Blue Academy WordPress Theme

総合型選抜・AO推薦入試対策のブルーアカデミー専用WordPressテーマ。

## 環境

- WordPress 6.0+
- PHP 8.0+
- Local（推奨）

## 必須プラグイン

- Meta Box（無料／WordPress.org）
- Meta Box Group（有料／$49）

## カスタム投稿タイプ

- `story` — 合格者体験記（`/story/{slug}/`）
- `teacher` — 講師（`/teacher/{slug}/`）
- `news` — お知らせ（`/news/{slug}/`）

## 構成

- `inc/` — 機能モジュール（CPT、Meta Box、enqueue等）
- `parts/` — 共通テンプレートパーツ
- `assets/css/` — スタイル
- `assets/js/` — スクリプト
- `single-{cpt}.php` — CPT個別ページテンプレート
- `page-{slug}.php` — 固定ページテンプレート

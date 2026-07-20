# Blue Academy デプロイ手順

本番: https://ao.blueacademy.jp/ (ConoHa WING)
ローカル: http://blue-academy.local/ (Local by Flywheel)
リポジトリ: https://github.com/sikumys809/blueacademy

---

## 接続情報

| 項目 | 値 |
|---|---|
| ホスト名 | www1170.conoha.ne.jp |
| IPアドレス | 157.120.209.92 |
| ポート | 8022 |
| ユーザー | c3470381 |
| 本番テーマパス | ~/public_html/ao.blueacademy.jp/wp-content/themes/blueacademy |

本番テーマは git 管理下。通常は git pull のみで反映できる。

---

## 通常のデプロイ手順

### 1. 作業機を最新にする

作業機を切り替えた直後は必ず実行すること。
Mac Studio と MacBook Pro の 2 台運用のため、片方が大きく遅れている場合がある。

    cd ~/Local\ Sites/blue-academy/app/public/wp-content/themes/blueacademy
    git pull

### 2. 変更 → commit → push

    git add -A
    git commit -m "変更内容"
    git push

コミットメッセージに感嘆符を含めないこと (zsh のヒストリー展開エラーになる)。

### 3. 本番に反映

    ssh -i ~/Downloads/KEYFILE.pem -p 8022 c3470381@www1170.conoha.ne.jp

接続後 (プロンプトが c3470381@web1170 に変わってから実行):

    cd ~/public_html/ao.blueacademy.jp/wp-content/themes/blueacademy
    git pull
    git status

### 4. キャッシュパージ

WP 管理画面 → LiteSpeed Cache → 全キャッシュパージ。
wp-cli 経由 (wp litespeed-purge all) は失敗するため管理画面から行う。

### 5. 確認

ブラウザで Cmd+Shift+R (スーパーリロード) して目視確認。

---

## SSH が繋がらない場合

2026-07-20 時点で 8022 番ポートが Connection refused となる事象が発生。

### 切り分け手順

    dig +short www1170.conoha.ne.jp
    nc -zv 157.120.209.92 443
    nc -zv www1170.conoha.ne.jp 8022

判定:

- dig が 157.120.209.92 を返す → ホスト名は正しい
- 443 が succeeded → サーバーには到達している
- 8022 のみ refused → SSH サービスまたは経路の問題

ConoHa コントロールパネル (サイト管理 → SSH) 側の設定は
利用設定 ON / 国外IP制限 OFF で正常だったため、ConoHa サポートへ要問い合わせ。

### 代替手段: ファイルマネージャーによる手動デプロイ

ConoHa コントロールパネル → ファイルマネージャー を使用。

アップロード先:

    public_html/ao.blueacademy.jp/wp-content/themes/blueacademy/

注意点:

- inc/helpers.php は inc フォルダの中にアップロードすること。
  ルート直下にアップすると新規ファイルとして別物ができ、
  本来の inc/helpers.php が古いまま残る。
  上書き確認ダイアログが出れば正しい場所。
- 手動アップロード後は本番の git 追跡とズレるため、
  SSH 復旧後に以下で整合を取る。

        cd ~/public_html/ao.blueacademy.jp/wp-content/themes/blueacademy
        git checkout .
        git pull

---

## CTA リンクの管理

無料受験相談と LINE のリンクは以下 6 ファイル 13 箇所に存在する。

| ファイル | 箇所 |
|---|---|
| header.php | 1 |
| footer.php | 2 |
| front-page.php | 4 |
| page-about.php | 2 |
| page-results.php | 2 |
| inc/helpers.php | 2 |

inc/helpers.php の blueacademy_cta_strip() は以下 7 テンプレートから呼ばれる。
このファイルの更新漏れがあると該当ページのみ旧リンクが残るため注意。

- page-teachers.php
- page-stories.php
- page-news.php
- page.php
- single-story.php
- single-teacher.php
- single-news.php

### 一括置換コマンド

    cd ~/Local\ Sites/blue-academy/app/public/wp-content/themes/blueacademy
    grep -rl 'OLD_URL' --include='*.php' . | xargs sed -i '' 's|OLD_URL|NEW_URL|g'
    grep -rn "OLD_URL" --include="*.php" .

macOS の sed は -i の後に空文字列が必要。

### 変更履歴

| 日付 | 無料受験相談 | LINE |
|---|---|---|
| 初期 | bit.ly/46QZuMS | bit.ly/3OMit55 |
| 2026-05-31 | bit.ly/4uMMSR9 | bit.ly/4uJsAYy |
| 2026-07-20 | utage-system.com/event/nLgsJEGf1Pff/register | utage-system.com/line/open/6mWKcAJuw1Ke |

---

## その他の環境メモ

- wp-cli はフルパス指定が必要
  /Applications/Local.app/Contents/Resources/extraResources/bin/wp-cli/posix/wp
- 本番 URL の正規形は https://ao.blueacademy.jp/ (www なし。www 版は DNS 未解決)
- 本番はファイル直接編集不可の設定 (テーマファイルエディター使用不可)

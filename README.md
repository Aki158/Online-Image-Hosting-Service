# Online-Image-Hosting-Service

## 🌱概要
オンラインで画像を共有できるサービス

## 🏠URL
https://online-image-hosting-service.aki158-website.blog/

## ✨デモ
### 画像のポスト
![post_url](https://github.com/Aki158/Online-Image-Hosting-Service/assets/119317071/733b34a3-b2a0-46ed-8913-8842d875488b)

## 📝説明
このサービスは、オンラインで画像を共有できるサービスです。

画像を知り合い(友人や家族、同僚など)と共有したり、他のユーザーがポストした画像を見ることができます。

このサービスでは、下記のような状況を想定してプライベートとパブリックの両方で利用できるように作成しました。

- 友人や家族などの親しい人のみと共有したい
- ユーザーが公開している画像を見たい

シンプルな見た目を意識して、直感的に利用できるようにデザインしていますので気軽に利用してみてください。

基本的な機能として、画像のポスト/表示/削除/一覧表示ができます。

画像をポストする際は、用途に合わせて表示設定を切り替えられます。

ポストURLやリストにアクセスすると、閲覧数が表示されるようにしています。

これにより、ポストされた画像がどれだけ注目されているかがわかります。

リストには、他のユーザーがポストした画像が展示されており、人気の画像(閲覧数が多い)ほどより上位に表示されます。

また、ポストした直後に画像を削除したくなった場合は、削除URLにアクセスすることで画像を削除できます。

### アップロードするファイルについての注意事項

サービスを利用する際は、下記の注意事項を確認してください。

項目に違反するとメッセージを表示するようにしていますが、把握しておくことでサービスを快適に利用できます。

| 項目 | 内容 |
| ------- | ------- |
| アップロードできるファイルの拡張子 | `*.gif`<br>`*.png`<br>`*.jpeg` |
| 1度にアップロードできるファイル数 | 1ファイル |
| 1度にアップロードできるファイルの最大サイズ | 3MB |
| 1日にアップロードできるファイル数 | 5枚まで |
| 1日にアップロードできるファイルの合計サイズ | 5MBまで |

## 🚀使用方法
1. [URL](#URL)にアクセスする 
2. タイトルを入力する
3. 参照... ボタンをクリックして、アップロードするファイルを選択する
4. 表示設定を選択する
5. ポストする ボタンをクリックしてURLを生成する
6. ポストURLにアクセスして、画像を確認する

## 🙋使用例
画像をポストする際のイメージは[デモ](#デモ)を参考にしてください。

また、設定については、機能一覧の[設定](#設定)を確認してください。

1. [URL](#URL)にアクセスする
2. タイトルに`test`と入力する
3. 参照... ボタンをクリックして、アップロードするファイル`Text-Snippet-Sharing-Service.gif`を選択する
4. 表示設定から`リストに表示する`を選択する
5. ポストする ボタンをクリックしてURLを生成する。<br>URLの生成に成功したので、ポストURLと削除URLが表示されました。
6. ポストURLにアクセスして、画像を確認する。<br>画像が表示されていることを確認できました。

## 💾使用技術
<table>
<tr>
  <th>カテゴリ</th>
  <th>技術スタック</th>
</tr>
<tr>
  <td rowspan=4>フロントエンド</td>
  <td>HTML</td>
</tr>
<tr>
  <td>CSS</td>
</tr>
<tr>
  <td>JavaScript</td>
</tr>
<tr>
  <td>フレームワーク : Bootstrap</td>
</tr>
<tr>
  <td>バックエンド</td>
  <td>PHP</td>
</tr>
<tr>
  <td rowspan=4>インフラ</td>
  <td>Amazon EC2</td>
</tr>
<tr>
  <td>Nginx</td>
</tr>
<tr>
  <td>Ubuntu</td>
</tr>
<tr>
  <td>VirtualBox</td>
</tr>
<tr>
  <td>データベース</td>
  <td>MySQL</td>
</tr>
<tr>
  <td rowspan=2>デザイン</td>
  <td>Figma</td>
</tr>
<tr>
  <td>Draw.io(vscode)</td>
</tr>
<tr>
  <td rowspan=5>その他</td>
  <td>Git</td>
</tr>
<tr>
  <td>Github</td>
</tr>
<tr>
  <td>SSL/TLS証明書取得、更新、暗号化 : Certbot</td>
</tr>
<tr>
  <td>スクリプトの定期実行 : cron</td>
</tr>
<tr>
  <td>オートスケール : Amazon EC2 Auto Scaling</td>
</tr>
</table>

## 🗄️ER図
![ER](https://github.com/Aki158/Online-Image-Hosting-Service/assets/119317071/a62262ea-b1ee-4c2d-b57e-5a8d57460d99)

## 👀機能一覧
### ヘッダー
![image](https://github.com/Aki158/Online-Image-Hosting-Service/assets/119317071/927cba9a-1170-4162-88a0-49d227d7dada)

| 機能 | 内容 |
| ------- | ------- |
| ポストする | ボタンをクリックすると、ポストページに遷移します。 |
| リスト | ボタンをクリックすると、リストページに遷移します。 |

### ポストページ
![image](https://github.com/Aki158/Online-Image-Hosting-Service/assets/119317071/ceffec18-7066-4d04-b077-f6a76be788eb)

#### 設定
<table>
<tr>
  <th colspan=2>機能</th>
  <th>内容</th>
</tr>
<tr>
  <td colspan=2>タイトル</td>
  <td>
    画像のタイトルを入力できます。<br>
    タイトルは、50文字以内におさめてください。
  </td>
</tr>
<tr>
  <td colspan=2>参照...</td>
  <td>
    ボタンをクリックすると、アップロードするファイルを選択できます。<br>
    ファイルは、gif/png/jpegのいづれかから選択してください。<br>
    それ以外のファイルを選択しても、アップロードすることはできません。<br>
    選択したファイルは、プレビューで確認できます。
  </td>
</tr>
<tr>
  <td rowspan=2>表示設定</td>
  <td>リストに表示しない</td>
  <td>
    知り合いだけで共有したい場合に選択してください。<br>
    ポストされた画像は、ポストURLにアクセスしたユーザーに共有されます。
  </td>
</tr>
<tr>
  <td>リストに表示する</td>
  <td>
    サービスを利用している多くのユーザーと共有したい場合は、選択して下さい。<br>
    ポストされた画像は、リストページに表示されます。<br>
    リストページに表示されるとサービスを利用しているユーザーは、誰でもアクセスすることができます。</td>
</tr>  
<tr>
  <td colspan=2>ポストする</td>
  <td>
    タイトル/参照.../表示設定を設定した後にクリックしてください。<br>
    設定した情報をもとに、ポストURLと削除URLを生成します。<br>
    生成に失敗した場合は、メッセージを表示しますので、設定を見直してください。<br>
    <strong>また、生成されたURLは、ページを離れると表示されなくなります。</strong><br>
    <strong>ポストURLと削除URLは、コピーしてメモ帳などのアプリケーションに貼り付けて残しておくことを推奨します。</strong>
  </td>
</tr>
  <td colspan=2>メッセージ</td>
  <td>
    <code>ポストする</code>ボタンをクリックした後に、画像のアップロードと画像についてのデータをデータベースに登録する処理を行います。<br>
    処理の結果をメッセージとして表示します。
  </td>
</table>

#### プレビュー

| 機能 | 内容 |
| ------- | ------- |
| プレビュー | 設定の`参照...`ボタンで選択したファイルを表示します。<br>画像ではない場合は、表示できません。 |

#### URL

| 機能 | 内容 |
| ------- | ------- |
| ポストURL | `ポストする`ボタンをクリックした後に表示されます。<br>URLをクリックすると、ポストURLページへ遷移します。 |
| 削除URL | `ポストする`ボタンをクリックした後に表示されます。<br>URLをクリックすると、削除URLページへ遷移します。 |

### リストページ

![image](https://github.com/Aki158/Online-Image-Hosting-Service/assets/119317071/8525dd96-b019-4485-b79d-f1ee50c42cdf)

| 機能 | 内容 |
| ------- | ------- |
| 一覧表示 | ポストされた画像の一覧が表示されます。<br>閲覧数が多い順に表示されます。<br>ポストページの表示設定をもとに一覧は生成されます。 |
| ポストURLページへの遷移 | リストからユーザーが見たい画像をクリックして閲覧することができます。 |

### ポストURLページ

![image](https://github.com/Aki158/Online-Image-Hosting-Service/assets/119317071/ca3ea13a-5229-4a0d-86a1-3f0f8e188ef8)

| 機能 | 内容 |
| ------- | ------- |
| 画像の表示 | ポストされた画像についての情報(タイトル/閲覧数/画像)が表示されます。<br>画像が削除されている場合は、URLの有効期限切れページへ遷移します。 |

### 削除URLページ

![image](https://github.com/Aki158/Online-Image-Hosting-Service/assets/119317071/491bdee4-49c0-4c0c-b5e4-e222d868c498)

| 機能 | 内容 |
| ------- | ------- |
| 画像の表示 | ポストされた画像についての情報(タイトル/画像)が表示されます。<br>画像が削除されている場合は、URLの有効期限切れページへ遷移します。 |
| 画像を削除する | ボタンをクリックすると、画像とデータベースに登録されている画像のデータが削除されます。 |

### URLの有効期限切れページ

![image](https://github.com/Aki158/Online-Image-Hosting-Service/assets/119317071/e7f7b2d1-49f3-4d20-ab83-0281f54ee2c4)

| 機能 | 内容 |
| ------- | ------- |
| 有効期限切れページの表示 | 削除された画像のURLにアクセスした場合は、このページに遷移します。 |

### スケジューリング

| 機能 | 内容 |
| ------- | ------- |
| スケジューリング | 30日間アクセスされていない画像は、システムから自動的に削除します。<br>アクセス計算チェックは、cron Linuxユーティリティを使用して、1日に1回cronファイルに記述しているコマンドを実行しPHPのスクリプトファイルを動かします。<br>cronファイルは、ユーザー名:ubuntuとして毎日22時46分に`/home/ubuntu/web/Online-Image-Hosting-Service`フォルダに移動して`php console cron`というコマンドを実行します。<br>スクリプトファイルは、データベースに登録されている各データのポストURLへの最終アクセス時間(カラム名:accessed_at)をチェックします。<br>最終アクセス時間とスクリプト実行時の時間の差を計算し、30日を超えていれば、画像とデータを削除します。<br>実行時間は、サーバーの他タスクの実行と重なることでサーバーに負荷がかかることを避けるために、あえて微妙な時間に設定しています。<br>実際に使用しているファイルの内容は下記になります。<br>・cronファイル内の記述<br>　`46 22 * * * ubuntu cd /home/ubuntu/web/Online-Image-Hosting-Service && php console cron`<br>・スクリプトファイル<br>　[Cron.php](https://github.com/Aki158/Online-Image-Hosting-Service/blob/main/Commands/Programs/Cron.php)<br>また、cronが期待した通りに動くか、テストも実施しました。<br>テストについては、[スケジューリングのテスト](#スケジューリングのテスト)を確認してください。 |

## 📜作成の経緯
下記項目の理解を深めるために作成しました。
- 3 層アーキテクチャ
- データベースのセットアップ
- envのセットアップ
- バックエンド言語を用いたデータベースの操作
- クエリのセキュリティ
- URLルーティング
- サーバサイドレンダリング
- スケーラビリティを考慮したシステム
- cronによるデータ保持

## ⭐️こだわった点

### 画像のアップロード

ユーザーがポストページのみで作業を完結できるように、Ajaxベースで画像のアップロードを行いました。

ユーザーが[使用方法](#使用方法)を実施すると、URL(※1)が生成されるような処理にしています。

unique-stringの部分には、hash関数を活用しランダムな文字列を生成しました。

また、ユーザーをIPアドレスで区別しアップロードするファイル数やデータ量に制限を設けました。

アップロードするファイル数やデータ量については、[アップロードするファイルについての注意事項](#アップロードするファイルについての注意事項)を確認してください。

※1. フォーマット : https://{domain}/{media-type}/{unique-string}

### ストレージ

画像ファイルは、日付ベースでの管理方法を採用しました。

ファイル名は、一意になるようにhash関数を利用して設定しました。

これにより、1つのフォルダに多くのファイルが集中することを防げます。

現状のリストページでは、閲覧数の多い順に画像を表示させていますが、

今後の実装で、日付ベースでの管理を利用することで 日付の古い順/新しい順/年月日などによるフィルタリング 

などにも容易に拡張できると考えています。

#### 日付ベースでのフォルダ構成イメージ

Images<br>
┗2023<br>
　┗12<br>
　　┣24<br>
　　┃┣{hash値}.png<br>
　　┃┗{hash値}.gif<br>
　　┗25<br>
　　　┣{hash値}.jpg<br>
　　　┗{hash値}.jpeg

### スケジューリングのテスト

スケジューリングには、cronを採用しました。

テストは、下記のようなステップで実施しました。

#### 1.ダミーデータの生成

アクセスされていない画像を削除するスケジューリングを実施しています。

このスケジューリングにより、30日間アクセスされていない画像は自動的にシステムから削除されます。

しかし、テストを行う際に、30日間アクセスされていない画像が必要であり、画像がポストされてから30日間待つことは時間がかかります。

この問題を解決するため、テスト用のダミーデータを簡単に生成できる仕組みを導入しました。

具体的には、指定した年月日に関連するダミーデータを生成できるコマンドラインツールを作成しました。

ターミナルを起動し、以下のコマンドを実行することで、必要なダミーデータを生成できます。

```
php console dummy --year [年] --month [月] --day [日]
```

例えば、テスト実施日が2023年12月31日であれば、30日前は2023年12月1日です。

したがって、以下のコマンドを実行することで、30日間アクセスされていない画像のダミーデータを生成できます。

```
php console dummy --year 2023 --month 12 --day 1
```

ダミーデータの生成には、[Dummy.php](https://github.com/Aki158/Online-Image-Hosting-Service/blob/main/Commands/Programs/Dummy.php)ファイルを使用しています。


#### 2.スクリプトファイルの実行

cronを実行する前に、スクリプトファイル([Cron.php](https://github.com/Aki158/Online-Image-Hosting-Service/blob/main/Commands/Programs/Cron.php))がコマンドで実行できるか確認しました。

下記のような手順で、スクリプトファイルを実行し画像が削除できました。

フォルダまで移動する
```
cd /home/ubuntu/web/Online-Image-Hosting-Service
```

スクリプトファイルを実行する
```
php console cron
```

#### 3.cronによる定期的なスクリプトファイルの実行

cronファイルに下記のような記述をすると、定期的にスクリプトファイルが実行されることを確認できました。

```
46 22 * * * ubuntu cd /home/ubuntu/web/Online-Image-Hosting-Service && php console cron
```

### スケーラビリティ

サービスの負荷を適切に分散するために、 Amazon EC2 Auto Scalingを採用しました。

Amazon EC2 Auto Scaling は、アプリケーションの負荷を処理するために適切な数の EC2 インスタンスを利用できるように準備することができます。

サービスの需要に応じて、EC2インスタンスの台数を自動で増減させるためにAuto Scaling グループを作成しました。

インスタンス数は、下記のように設定しました。

| キャパシティ | インスタンス数 |
| ------- | ------- |
| 希望するキャパシティ | 2 |
| 最小キャパシティ | 1 |
| 最大キャパシティ | 3 |

### セキュリティ

アップロードされるファイルを通して、サービスを悪用される可能性があるため、ファイルに対しては、厳格なチェックを行いました。

下記項目の1つでも、違反していればアップロードを中止しユーザーに設定を見直すようにエラーメッセージを表示します。

- アップロード時に、フロントエンド(JavaScript)とバックエンド(PHP)間でAjaxによる通信ができるか
- ファイルは、アップロードされているか
- 1日にアップロードできるファイル数(最大5ファイル)を超えていないか
- 1日にアップロードできるファイルサイズ(合計5MBまで)を超えていないか
- 画像ファイルとして有効か
- 許可されているMIMEタイプか
- 許可されている拡張子か
- 1度にアップロードできるファイルサイズ(最大3MB)を超えていないか
- ファイルをImagesフォルダに移動できるか

### その他

下記項目についてもこだわりましたが、[Text-Snippet-Sharing-Service](https://github.com/Aki158/Text-Snippet-Sharing-Service)と同様のため記載を省略します。

気になる項目がある場合は、下記リンクから確認してください。

- [マイグレーションベースのスキーマ管理](https://github.com/Aki158/Text-Snippet-Sharing-Service?tab=readme-ov-file#マイグレーションベースのスキーマ管理)
- [データの投入](https://github.com/Aki158/Text-Snippet-Sharing-Service?tab=readme-ov-file#データの投入)
- [MVCモデル](https://github.com/Aki158/Text-Snippet-Sharing-Service?tab=readme-ov-file#MVCモデル)
- [入力値のチェック](https://github.com/Aki158/Text-Snippet-Sharing-Service?tab=readme-ov-file#入力値のチェック)
- [SQLインジェクションの対策](https://github.com/Aki158/Text-Snippet-Sharing-Service?tab=readme-ov-file#SQLインジェクションの対策)

## 📮今後の実装したいもの
- [ ] ログイン機能
- [ ] ログインしたユーザーがポストした画像を一覧で見れる機能
- [ ] Imagesフォルダ内の不要なフォルダを定期的に削除する処理の追加(再帰を利用する)
- [ ] 不適切な画像かを判別する機能
- [ ] レスポンシブデザイン

## 📑参考文献
### 公式ドキュメント
- [Bootstrap](https://getbootstrap.jp/)
- [PHPマニュアル](https://www.php.net/manual/ja/index.php#index)
- [MySQL](https://dev.mysql.com/doc/refman/8.0/en/innodb-online-ddl-operations.html)

### 参考にしたサイト
- [Imgur](https://imgur.com/)
- [fontawesome](https://fontawesome.com/)
- [Webサービスにおけるファイルアップロード機能の仕様パターンとセキュリティ観点](https://blog.flatt.tech/entry/file_upload_security#%E5%AF%BE%E7%AD%962-%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E5%90%8D%E3%81%AE%E3%83%81%E3%82%A7%E3%83%83%E3%82%AF)
- [よくある MIME タイプ](https://developer.mozilla.org/ja/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Common_types)
- [AWSのEC2周りを整理して、EC2 Auto Scalingを設定してみる。](https://qiita.com/nobkovskii/items/56d811c47952e06112e3)
- [cron job string format](https://cloud.google.com/scheduler/docs/configuring/cron-job-schedules)
- [【Ubuntu】cron（crontab）でプログラムを定期的に実行：ジョブスケジューリング](https://office54.net/iot/linux/ubuntu-cron-crontab)
- [サーバーのphp.iniによるアップロードファイルの最大容量の確認と容量制限の変更](https://www.php-factory.net/trivia/05.php)
- [【php】ファイルアップロード時のエラーコードとエラーメッセージ](https://www.softel.co.jp/blogs/tech/archives/1824)
- [ファイルサイズ変更のLinuxコマンド](https://qiita.com/yamada_yoshiki/items/b7cea46daa7b72ceb898)

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

| 項目 | 内容 |
| ------- | ------- |
| アップロードできるファイルの拡張子 | `*.gif`<br>`*.png`<br>`*.jpeg` |
| 1度にアップロードできるファイル数 | 1ファイル |
| 1度にアップロードできるファイルの最大サイズ | 2MB |
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

### 設定
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

### プレビュー

| 機能 | 内容 |
| ------- | ------- |
| プレビュー | 設定の`参照...`ボタンで選択したファイルを表示します。<br>画像ではない場合は、表示できません。 |

### URL

| 機能 | 内容 |
| ------- | ------- |
| ポストURL | `ポストする`ボタンをクリックした後に表示されます。<br>URLをクリックすると、ポストURLページへ遷移します。 |
| 削除URL | `ポストする`ボタンをクリックした後に表示されます。<br>URLをクリックすると、削除URLページへ遷移します。 |

### リストページ

| 機能 | 内容 |
| ------- | ------- |
| 一覧表示 | ポストされた画像の一覧が表示されます。<br>閲覧数が多い順に表示されます。<br>ポストページの表示設定をもとに一覧は生成されます。 |
| ポストURLページへの遷移 | リストからユーザーが見たい画像をクリックして閲覧することができます。 |

### ポストURLページ

| 機能 | 内容 |
| ------- | ------- |
| 画像の表示 | ポストされた画像についての情報(タイトル/閲覧数/画像)が表示されます。<br>画像が削除されている場合は、URLの有効期限切れページへ遷移します。 |

### 削除URLページ

| 機能 | 内容 |
| ------- | ------- |
| 画像の表示 | ポストされた画像についての情報(タイトル/画像)が表示されます。<br>画像が削除されている場合は、URLの有効期限切れページへ遷移します。 |
| 画像を削除する | ボタンをクリックすると、画像とデータベースに登録されている画像のデータが削除されます。 |

### URLの有効期限切れページ

| 機能 | 内容 |
| ------- | ------- |
| 有効期限切れページの表示 | 削除された画像のURLにアクセスした場合は、このページに遷移します。 |

### データ保持

| 機能 | 内容 |
| ------- | ------- |
| データ保持 | データ保持のためにアクセスチェックを1日1回実行しています。<br>30日間アクセスされていない画像は、削除されます。 |

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

### スニペットのアップロード
ユーザーが[使用方法](#使用方法) を実施すると、スニペット用の一意のURL(※2)が生成されるような処理にしています。  

unique-stringの部分にはhash関数を活用しランダムな文字列を生成しました。

URLのパースには、parse_url関数を活用し`{path}/{unique-string}`のみを取得しています。

※2. フォーマット : `https://{domain}/{path}/{unique-string}`

### エラーハンドリング
不適切な入力(大量のテキストやコード、またはサポートされていない文字)が送信された場合に、エラーメッセージを表示します。

具体的な不適切な入力の条件は、[スニペット作成ページ](#スニペット作成ページ) の「機能 : エラーメッセージ」に記載していますので確認ください。

### その他

下記項目についても、こだわりましたが、[Text-Snippet-Sharing-Service](https://github.com/Aki158/Text-Snippet-Sharing-Service)と同様のため記載を省略します。

気になる項目があれば、下記リンクから確認してください。

- [マイグレーションベースのスキーマ管理](https://github.com/Aki158/Text-Snippet-Sharing-Service?tab=readme-ov-file#マイグレーションベースのスキーマ管理)
- [データの投入(シーディング)](https://github.com/Aki158/Text-Snippet-Sharing-Service?tab=readme-ov-file#データの投入(シーディング))
- [MVCモデル](https://github.com/Aki158/Text-Snippet-Sharing-Service?tab=readme-ov-file#MVCモデル)
- [入力値のチェック](https://github.com/Aki158/Text-Snippet-Sharing-Service?tab=readme-ov-file#入力値のチェック)
- [SQLインジェクションの対策](https://github.com/Aki158/Text-Snippet-Sharing-Service?tab=readme-ov-file#SQLインジェクションの対策)


## 📮今後の実装したいもの
- [ ] Imagesフォルダ内の不要なフォルダを定期的に削除する処理の追加(再帰を利用する)


----



## 👀機能一覧
### ヘッダー
![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/04a2f93f-e4c0-4530-8022-c72a355a138a)

| 機能 | 内容 |
| ------- | ------- |
| New Snippet | ボタンをクリックすると、スニペット作成ページに遷移します。 |
| Public Snippets | ボタンをクリックすると、スニペット一覧ページに遷移します。 |

### スニペット作成ページ
![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/96014ea6-0ada-4229-80e9-1d7adb15ed4d)

<table>
<tr>
  <th colspan=2>機能</th>
  <th>内容</th>
</tr>
<tr>
  <td colspan=2>エラーメッセージ</td>
  <td>エディタが下記入力の場合は、Create New Snippet ボタンをクリックすると、スニペットの作成に失敗しエラーメッセージを表示します。<br>・65,535バイトを超えている<br>・空白<br>・UTF-8以外のエンコーディング</td>
</tr>
<tr>
  <td colspan=2>エディタ</td>
  <td>共有したいスニペットを記述できます。</td>
</tr>
<tr>
  <td rowspan=4>Optional Snippet Settings</td>
  <td>Syntax Highlighting :</td>
  <td>plaintextと10の主要な言語から選択できます。</td>
</tr>
<tr>
  <td>Snippet Expiration :</td>
  <td>10min、1h、1day、Never のいづれかから選択できます。</td>
</tr>
<tr>
  <td>Snippet Name / Title :</td>
  <td>シンタックスの名前を入力できます。<br>入力しない場合は、デフォルトで Untitled という名前になります。<br>入力時は、サポートしていない文字がありますので、注意してください。<br>サポートしていない文字が入力欄にある場合は、Create New Snippet ボタンをクリックすることができません。</td>
</tr>
<tr>
  <td>Create New Snippet</td>
  <td>ボタンをクリックすると、スニペットを作成できます。</td>
</tr>
</table>

### スニペットの一覧ページ

![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/89e10dbc-f2e0-479c-afd1-a500e1bfb230)

| 機能 | 内容 |
| ------- | ------- |
|  スニペットの一覧表示 | 共有されたスニペットの一覧が表示されます。<br>スニペットが作成されてから新しい順番で表示されます。<br>また、スニペット一覧ページがロードされた時に有効期限を確認しているため、有効期限が切れているスニペットは表示されません。 |
| スニペット閲覧ページへの遷移 | 一覧からユーザーが見たいスニペットをクリックして閲覧することができます。 |
| クリックしたスニペットが有効期限切れの場合の処理 | ロードされてからしばらく時間をおくと、その間にスニペットの有効期限が切れることがあります。<br>その場合は、スニペットの有効期限切れページに遷移します。 |

### スニペットの閲覧ページ

![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/d849a8d8-8900-4495-b51f-36b064b18ea9)

| 機能 | 内容 |
| ------- | ------- |
| スニペットのURL生成 | スニペット作成ページのCreate New Snippet ボタンをクリックすると、スニペット用の一意のURLが生成されます。 |
| スニペットの閲覧 | 共有されたスニペットを閲覧することができます。<br>エディタに記述されているスニペットは、スニペット作成ページで設定したシンタックスハイライトが適用されています。<br>また、閲覧のみを想定しているため、編集はできません。 |
| スニペットの有効期限の確認 | ページがロードされた際にスニペットの有効期限を確認しています。<br>もしも有効期限が切れていた場合は、スニペットの有効期限切れページへ遷移します。 |
| スニペットのコピー | Copy code　ボタンをクリックすると、スニペットを丸ごとコピーできます。 |

### スニペットの有効期限切れページ
![image](https://github.com/Aki158/Text-Snippet-Sharing-Service/assets/119317071/6d85c914-f294-45f5-a738-ba4e47b0e31b)

| 機能 | 内容 |
| ------- | ------- |
|  有効期限切れページの表示 | スニペット有効期限が切れた場合は、このページに遷移します。 |

## 📜作成の経緯
下記項目の理解を深めるために作成しました。
- 3 層アーキテクチャ
- データベースのセットアップ
- envのセットアップ
- バックエンド言語を用いたデータベースの操作
- クエリのセキュリティ
- URLルーティング
- サーバサイドレンダリング

## ⭐️こだわった点
### マイグレーションベースのスキーマ管理

| 項目 | 内容 |
| ------- | ------- |
|  概要 | マイグレーションベースのスキーマ管理は、バージョン管理された小規模な変更を段階的に適用してデータベーススキーマを時間とともに管理・進化させる方法です。<br>この方法によりシステムに小さな変更を加え、それを実行またはロールバックする手段を提供できます。 |
| スクリプトの生成 | CLIで下記コマンドを実行すると、スクリプトを生成することができます。<br>`php console code-gen migration --name {FILENAME}`<br>スクリプトはマイグレーションインターフェースに準拠しており、up関数とdown関数で構成されています。<br>下記フォーマットのスクリプトが `Database\Migrations` の配下に生成されます。<br> `{YYYY-MM-DD}_{UNIX_TIMESTAMP}_{FILENAME}.php`|
| 実行 | スクリプトを実行する際は、スキーママイグレーションを行うためのマイグレーションコマンドが用意されていてアップグレード(up)またはロールバック(down)を行うことができます。<br>また、CLIで下記コマンドを実行すると、テーブルが初期化されます。<br>`php console migrate --init` |

### データの投入(シーディング)

| 項目 | 内容 |
| ------- | ------- |
|  スクリプトの生成 | CLIで下記コマンドを実行すると、スクリプトを生成することができます。<br>`php console code-gen seeder --name {FILENAME}`<br>スクリプトは、シーダーシステムに準拠しており、tableName、tableColumns、createRowData()で構成されています。<br>下記フォーマットのスクリプトが `Database\Seeds` の配下に生成されます。|
| 実行 | シードコマンドを実行すると、スクリプトで定義した通りにデータベースにデータが挿入されます。<br>ユーザーが [使用方法](#使用方法) を実施すると、実行されるような処理にしています。 |

### MVCモデル
HTMLRendererは、MVCモデルのアプローチを採用しています。

モデル、ビュー、コントローラが分離され、 `Routing\routes.php` 内の匿名関数型のコントローラが Renderer クラスのインスタンスを作成して返す役割を果たします。

コントローラは、OOP クラスやデータベーススキーマにマッピングされたデータなどのモデルを使ってデータを準備し、このデータをビューに渡してコンテンツを作成します。

### スニペットのアップロード
ユーザーが[使用方法](#使用方法) を実施すると、スニペット用の一意のURL(※2)が生成されるような処理にしています。  

unique-stringの部分にはhash関数を活用しランダムな文字列を生成しました。

URLのパースには、parse_url関数を活用し`{path}/{unique-string}`のみを取得しています。

※2. フォーマット : `https://{domain}/{path}/{unique-string}`

### 入力値のチェック
入力値は厳格に検証とサニタイズを行っています。

ここでの入力値とは、[使用方法](#使用方法) に従いユーザーが設定したものです。

不適切な入力値があればエラーメッセージを出力するようにしています。

### SQLインジェクションの対策
インジェクションを防ぐ方法として、プリペアドステートメントを利用してデータを取得しています。

具体的には、PHPのmysqliクラスが提供している下記3つの関数を使用しています。

| 関数 | 内容 |
| ------- | ------- |
|  prepare() | 実行するためのSQL文を準備します。<br> ここでは、実際のデータの代わりにプレースホルダを使用しています。|
| bind_param() | プリペアドステートメントのパラメータに変数をバインドします。 |
| execute() | プリペアドステートメントを実行します。 |

### エラーハンドリング
不適切な入力(大量のテキストやコード、またはサポートされていない文字)が送信された場合に、エラーメッセージを表示します。

具体的な不適切な入力の条件は、[スニペット作成ページ](#スニペット作成ページ) の「機能 : エラーメッセージ」に記載していますので確認ください。

## 📮今後の実装したいもの
- [ ] ログイン機能
- [ ] ログインしたユーザーが作成したスニペットを一覧で見れる機能
- [ ] シンタックスハイライトの選択肢を増やす
- [ ] 有効期限の選択肢を増やす
- [ ] レスポンシブデザイン

## 📑参考文献
### 公式ドキュメント
- [Monaco Editor](https://microsoft.github.io/monaco-editor/)
- [Bootstrap](https://getbootstrap.jp/)
- [PHPマニュアル](https://www.php.net/manual/ja/index.php#index)
- [MySQL](https://dev.mysql.com/doc/refman/8.0/en/innodb-online-ddl-operations.html)

### 参考にしたサイト
- [Pastebin](https://pastebin.com/)

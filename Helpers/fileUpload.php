<?php 

namespace Helpers;

// composerの依存関係のオートロード
require_once '../vendor/autoload.php';

use Helpers\ValidationHelper;
use Helpers\DatabaseHelper;

$inputTitle = ValidationHelper::string($_POST['text'] !== ''?$_POST['text']:'Untitled');
$uploadFile = $_FILES['file'];
$accessControl = ValidationHelper::string($_POST['button']??'Private');

$status = '';
$message = '';
$postUrl = '';
$deleteUrl = '';

if (isset($uploadFile) && is_uploaded_file($uploadFile['tmp_name'])) {
    $fileTmpPath = $uploadFile['tmp_name'];
    $fileName = $uploadFile['name'];
    $fileSize = $uploadFile['size'];
    $fileType = $uploadFile['type'];
    
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $mediaType = str_replace("/" , "-", $fileType);

    $userIp = $_SERVER['REMOTE_ADDR'];
    $date = date("Y-m-d H:i:s");
    $postFileName = hash("md5",$date);
    $deleteFileName = hash("sha1",$date);
    $protocol = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $postUrl = $protocol.$host."/".$mediaType."/".$postFileName;
    $deleteUrl = $protocol.$host."/".$mediaType."/".$deleteFileName;
    
    $allowedFileExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $allowedMimeType = ['image/jpeg', 'image/png', 'image/gif'];

    $fileCount = DatabaseHelper::countFile($userIp, date("Y-m-d ")."%") + 1;
    $totalFileSize = DatabaseHelper::totalFileSize($userIp, date("Y-m-d ")."%") + $fileSize;

    // 1日にアップロードできるファイル数(最大:5ファイル)を超えていないかチェック
    if($fileCount > 5){
        $status = 'failed';
        $message = '1日にアップロードできるファイル数(5ファイルまで)を超えています。';
    }
    // 1日にアップロードできるファイルサイズ(合計5MBまで)を超えていないかチェック
    else if($totalFileSize > 5242880){
        $status = 'failed';
        $message = '1日にアップロードできるファイルサイズ(合計5MBまで)を超えています。';
    }
    // 画像ファイルとして有効かチェック
    else if(getimagesize($fileTmpPath) === false){
        $status = 'failed';
        $message = 'アップロードされたファイルは、画像として認識できませんでした。<br>メディアファイルを選択してください。';
    }
    // 許可されているMIMEタイプかチェック
    else if(!in_array($fileType, $allowedMimeType)){
        $status = 'failed';
        $message = 'アップロードされたファイルの種類(MIMEタイプ)は、許可されていません。<br>許可されているMIMEタイプは、下記になります。<br>・image/jpeg<br>・image/png<br>・image/gif';
    }
    // 許可されている拡張子かチェック
    else if (!in_array($fileExtension, $allowedFileExtensions)) {
        $status = 'failed';
        $message = 'アップロードされたファイルの拡張子は、許可されていません。<br>許可されている拡張子は、下記になります。<br>・jpg<br>・jpeg<br>・png<br>・gif';
    }
    // 1度にアップロードできるファイルサイズ(最大3MBまで)を超えていないかチェック
    else if($fileSize > 3145728){
        $status = 'failed';
        $message = 'アップロードできるファイルサイズ(最大:3MB)を超えています。';
    }
    else{
        $upload_file_dir = DatabaseHelper::generateDir("..", date('Y'), date('m'), date('d'));
        $image_path = $upload_file_dir . "/" . $postFileName . "." . $fileExtension;
        
        if(move_uploaded_file($fileTmpPath, $image_path)) {
            $status = 'success';
            $message = 'ファイルは正しくアップロードされました。';

            // DBにデータを追加する
            $command = sprintf("php ../console seed --title %s --access_control %s --image_path %s --post_url %s --delete_url %s --ip_address  %s --file_size  %s",$inputTitle, $accessControl, $image_path, $postUrl, $deleteUrl, $userIp, $fileSize);
            exec($command, $output);
        } else {
            $status = 'failed';
            $message = 'ファイルの移動中にエラーが発生しました。<br>開発者に問い合わせてください。';
        }
    }
} else {
    $status = 'failed';
    $message = 'ファイルがアップロードされていないかエラーが発生しました。<br>ファイルは、選択されているか確認してください。';
}

$response_data = array(
    'status' => $status,
    'message' => $message,
    'post_url' => $postUrl,
    'delete_url' => $deleteUrl
);

// app_newImage.jsにJSON形式でデータをレスポンスする
print(json_encode($response_data));



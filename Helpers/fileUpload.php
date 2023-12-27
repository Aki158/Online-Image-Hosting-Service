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
    $protocol = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $postUrl = $protocol.$host."/".$mediaType."/".$postFileName;
    $deleteUrl = $protocol.$host."/".$mediaType."/".hash("sha1",$date);
    
    $allowedFileExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $allowedMimeType = ['image/jpeg', 'image/png', 'image/gif'];

    $fileCount = DatabaseHelper::countFile($userIp, date("Y-m-d ")."%") + 1;
    $totalFileSize = DatabaseHelper::totalFileSize($userIp, date("Y-m-d ")."%") + $fileSize;

    // 1日にアップロードできるファイル数(最大:5ファイル)を超えないかチェック
    if($fileCount > 5){
        $status = 'failed';
        $message = '1日にアップロードできるファイル数は、5ファイルまでです。';
    }
    // 1日にアップロードできるファイルサイズ(合計5MBまで)を超えないかチェック
    else if($totalFileSize > 5242880){
        $status = 'failed';
        $message = '1日にアップロードできるファイルサイズは、合計で5MBまでです。';
    }
    // 画像ファイルとして有効かチェック
    else if(getimagesize($fileTmpPath) === false){
        $status = 'failed';
        $message = 'アップロードされたファイルは、画像として認識できませんでした。<br>設定を見直してください。';
    }
    // 許可されているMIMEタイプかチェック
    else if(!in_array($fileType, $allowedMimeType)){
        $status = 'failed';
        $message = 'アップロードされたファイルの種類(MIMEタイプ)は、許可されていません。<br>設定を見直してください。';
    }
    // 許可されている拡張子かチェック
    else if (!in_array($fileExtension, $allowedFileExtensions)) {
        $status = 'failed';
        $message = 'アップロードされたファイルの拡張子は、許可されていません。<br>設定を見直してください。';
    }
    // ファイルサイズのチェック(上限2MB)
    else if($fileSize > 2097152){
        $status = 'failed';
        $message = 'アップロードできるファイルサイズ(最大:2MB)を超えています。<br>設定を見直してください。';
    }
    else{
        $upload_file_dir = generateDir();
        $image_path = $upload_file_dir . "/" . $postFileName . "." . $fileExtension;
        
        if(move_uploaded_file($fileTmpPath, $image_path)) {
            $status = 'success';
            $message = 'ファイルは正しくアップロードされました。';

            // DBにデータを追加する
            $command = sprintf("php ../console seed --title %s --access_control %s --image_path %s --post_url %s --delete_url %s --ip_address  %s --file_size  %s",$inputTitle, $accessControl, $image_path, $postUrl, $deleteUrl, $userIp, $fileSize);
            exec($command, $output);
        } else {
            $status = 'failed';
            $message = 'ファイルの移動中にエラーが発生しました。';
        }
    }
} else {
    $status = 'failed';
    $message = 'ファイルがアップロードされていないかエラーが発生しました。';
}

$response_data = array(
    'status' => $status,
    'message' => $message,
    'post_url' => $postUrl,
    'delete_url' => $deleteUrl
);

// app_newImage.jsにJSON形式でデータをレスポンスする
print(json_encode($response_data));

function generateDir(){
    $dirPath = '..';
    $dirArr = ['Images', date('Y'), date('m'), date('d')];

    foreach($dirArr as $dir_name){
        $dirPath .= '/' . $dir_name;
        if(!file_exists($dirPath)){
            mkdir($dirPath, 0777);
            chmod($dirPath, 0777);
        }
    }
    return $dirPath;
}

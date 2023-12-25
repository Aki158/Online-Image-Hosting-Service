<?php 

namespace Helpers;

// composerの依存関係のオートロード
require_once '../vendor/autoload.php';

use Helpers\ValidationHelper;
use Helpers\DatabaseHelper;

$input_title = ValidationHelper::string($_POST['text'] !== ''?$_POST['text']:'Untitled');
$upload_file = $_FILES['file'];
$access_control = ValidationHelper::string($_POST['button']??null);

$status = '';
$message = '';
$post_url = '';
$delete_url = '';

if (isset($upload_file) && is_uploaded_file($upload_file['tmp_name'])) {
    $file_tmp_path = $upload_file['tmp_name'];
    $file_name = $upload_file['name'];
    $file_size = $upload_file['size'];
    $file_type = $upload_file['type'];
    
    $file_name_cmps = explode(".", $file_name);
    $file_extension = strtolower(end($file_name_cmps));

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file_tmp_path);
    $media_type = str_replace("/" , "-", $mime_type);

    $user_ip = $_SERVER['REMOTE_ADDR'];
    $date = date("Y-m-d H:i:s");
    $post_file_name = hash("md5",$date);
    $post_url = $media_type."/".$post_file_name;
    $delete_url = $media_type."/".hash("sha1",$date);
    
    $allowed_file_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $allowed_mime_type = ['image/jpeg', 'image/png', 'image/gif'];

    $file_count = DatabaseHelper::countNumberFile($user_ip, date("Y-m-d ")."%") + 1;
    $total_file_size = DatabaseHelper::totalFileSize($user_ip, date("Y-m-d ")."%") + $file_size;

    // 1日にアップロードできるファイル数(最大:5ファイル)を超えないかチェック
    if($file_count > 5){
        $status = 'failed';
        $message = '1日にアップロードできるファイル数は、5ファイルまでです。';
    }
    // 1日にアップロードできるファイルサイズ(合計5MBまで)を超えないかチェック
    else if($total_file_size > 5242880){
        $status = 'failed';
        $message = '1日にアップロードできるファイルサイズは、合計で5MBまでです。';
    }
    // 画像ファイルとして有効かチェック
    else if(getimagesize($file_tmp_path) === false){
        $status = 'failed';
        $message = 'アップロードされたファイルは、画像として認識できませんでした。<br>設定を見直してください。';
    }
    // 許可されているMIMEタイプかチェック
    else if(!in_array($mime_type, $allowed_mime_type)){
        $status = 'failed';
        $message = 'アップロードされたファイルの種類(MIMEタイプ)は、許可されていません。<br>設定を見直してください。';
    }
    // 許可されている拡張子かチェック
    else if (!in_array($file_extension, $allowed_file_extensions)) {
        $status = 'failed';
        $message = 'アップロードされたファイルの拡張子は、許可されていません。<br>設定を見直してください。';
    }
    // ファイルサイズのチェック(上限2MB)
    else if($file_size > 2097152){
        $status = 'failed';
        $message = 'アップロードできるファイルサイズ(最大:2MB)を超えています。<br>設定を見直してください。';
    }
    else{
        $upload_file_dir = generateDir();
        $image_path = $upload_file_dir . "/" . $post_file_name . "." . $file_extension;
        
        if(move_uploaded_file($file_tmp_path, $image_path)) {
            $status = 'success';
            $message = 'ファイルは正しくアップロードされました。';

            // DBにデータを追加する
            $command = sprintf("php ../console seed --title %s --access_control %s --image_path %s --post_url %s --delete_url %s --ip_address  %s --file_size  %s",$input_title, $access_control, $image_path, $post_url, $delete_url, $user_ip, $file_size);
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
    'post_url' => $post_url,
    'delete_url' => $delete_url,
);

// app_newImage.jsにJSON形式でデータをレスポンスする
print(json_encode($response_data));

function generateDir(){
    $dir_path = '..';
    $dir_arr = ['Images', date('Y'), date('m'), date('d')];

    foreach($dir_arr as $dir_name){
        $dir_path .= '/' . $dir_name;
        if(!file_exists($dir_path)){
            mkdir($dir_path, 0777);
            chmod($dir_path, 0777);
        }
    }
    return $dir_path;
}

?>
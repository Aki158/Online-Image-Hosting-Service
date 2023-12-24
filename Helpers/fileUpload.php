<?php 

namespace Helpers;

// composerの依存関係のオートロード
require_once '../vendor/autoload.php';

use Helpers\ValidationHelper;

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

    // 画像ファイルとして有効かチェック
    if(getimagesize($file_tmp_path) === false){
        $status = 'failed';
        $message = 'アップロードされたファイルは、画像として認識できませんでした。';
    }
    // 許可されているMIMEタイプかチェック
    else if(!in_array($mime_type, $allowed_mime_type)){
        $status = 'failed';
        $message = 'アップロードされたファイルの種類(MIMEタイプ)は、許可されていません。';
    }
    // 許可されている拡張子かチェック
    else if (!in_array($file_extension, $allowed_file_extensions)) {
        $status = 'failed';
        $message = 'アップロードされたファイルの拡張子は、許可されていません。';
    }
    // ファイルサイズのチェック(上限2MB)
    else if($file_size > 2097152){
        $status = 'failed';
        $message = 'アップロードできるファイルサイズ(上限:2MB)を超えています。';
    }
    else{
        $upload_file_dir = generateDir();

        // ファイルの処理を行う
        // 例：ファイルを特定のディレクトリに移動する
        // $upload_file_dir = '../Images/'.$file_extension.'/';
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
    'delete_url' => $delete_url
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
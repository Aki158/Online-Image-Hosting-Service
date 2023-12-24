<?php

namespace Helpers;

use Database\MySQLWrapper;
use DateTime;
use Exception;

class DatabaseHelper
{
    public static function deleteImage(string $image_path): string{
        $db = new MySQLWrapper();
        
        if(!unlink($image_path)){
            return "画像は見つかりませんでした...";
        }

        // Imageテーブルからデータを削除する
        $stmt = $db->prepare("DELETE FROM Image WHERE image_path = ?");
        $stmt->bind_param('s', $image_path);
        
        if(!$stmt->execute()){
            return "テーブルから画像データを削除できませんでした...";
        }
        return "画像の削除に成功しました!";
    }

    public static function updateImage(int $id): void{
        $db = new MySQLWrapper();
        $date = date("Y-m-d H:i:s");

        $stmt = $db->prepare("UPDATE Image SET accessed_at = ?, view_count = view_count + 1 WHERE id = ?");
        $stmt->bind_param('si', $date, $id);
        $stmt->execute();
    }


    public static function getImage(string $column_name,string $path): array{
        $db = new MySQLWrapper();

        if($column_name === "post_url"){
            $stmt = $db->prepare("SELECT * FROM Image WHERE post_url = ?");
        }
        else if($column_name === "delete_url"){
            $stmt = $db->prepare("SELECT * FROM Image WHERE delete_url = ?");
        }
        else{
            throw new Exception('column_name contains an unexpected value.');
        }
        $stmt->bind_param('s', $path);
        $stmt->execute();

        $result = $stmt->get_result();
        $image = $result->fetch_assoc();

        // 画像が見つからない場合
        if(!$image){
            header("Location: ../notFoundImage");
            exit;
        }
        return $image;
    }

    public static function getImagesListInfo(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM Image WHERE access_control = 'Public' ORDER BY view_count DESC");
        $stmt->execute();

        $result = $stmt->get_result();
        $ImagesList = [];
        $i = 0;

        while ($row = $result->fetch_assoc()) {
            $ImagesList[$i] = $row;
            $i++;
        }

        if (!$ImagesList){
            // header("Location: ../notFoundImage");
            // exit;
            $ImagesList[0] = [
                "id" => 0,
            ];
        }
        return $ImagesList;
    }

    // public static function getImage(string $path): array{
    //     $db = new MySQLWrapper();

    //     $stmt = $db->prepare("SELECT * FROM Image WHERE path = ?");
    //     $stmt->bind_param('s', $path);
    //     $stmt->execute();

    //     $result = $stmt->get_result();
    //     $image = $result->fetch_assoc();

    //     if (!$image) throw new Exception('Could not find a path in database');


    //     // スニペットはの有効期限が切れていたら削除し、「Expired Image」というメッセージを表示する
    //     if(self::isExpired($image["expiration"], $image["created_at"])){
    //         header("Location: ../notFoundImage");
    //         exit;
    //     }
    //     return $image;
    // }

    // public static function checkImagesExpiration(): void{
    //     $db = new MySQLWrapper();

    //     $stmt = $db->prepare("SELECT * FROM Image");
    //     $stmt->execute();

    //     $result = $stmt->get_result();

    //     while ($image = $result->fetch_assoc()) {
    //         if(self::isExpired($image["expiration"], $image["created_at"])){
    //             self::deleteImage($image["path"]);
    //         }
    //     }
    // }

    // public static function isExpired(string $expiration, string $pre): bool{
    //     $now = date("Y-m-d H:i:s");
    //     $expirationValue = PHP_INT_MAX;

    //     if($expiration === "Never"){
    //         return false;
    //     }
    //     else if($expiration === "10min"){
    //         $expirationValue = 10;
    //     }
    //     else if($expiration === "1h"){
    //         $expirationValue = 60;
    //     }
    //     else if($expiration === "1day"){
    //         $expirationValue = 1440;
    //     }

    //     $preTime = new DateTime($pre);
    //     $currentTime = new DateTime($now);
    //     $interval = $preTime->diff($currentTime);

    //     $minutes = $interval->days * 24 * 60;
    //     $minutes += $interval->h * 60;
    //     $minutes += $interval->i;

    //     return $expirationValue - $minutes < 0;
    // }

    // private static function deleteImage(string $path): void{
    //     $db = new MySQLWrapper();

    //     $stmt = $db->prepare("DELETE FROM Image Where path = ?");
    //     $stmt->bind_param('s', $path);
    //     $stmt->execute();
    // }

    // public static function getImagesTableInfo(): array{
    //     $db = new MySQLWrapper();

    //     $stmt = $db->prepare("SELECT * FROM Image ORDER BY id DESC");
    //     $stmt->execute();

    //     $result = $stmt->get_result();
    //     $ImagesList = [];
    //     $i = 0;

    //     while ($row = $result->fetch_assoc()) {
    //         $ImagesList[$i] = [
    //             "name" => $row["name"],
    //             "posted" => self::getPostTime($row["created_at"]),
    //             "syntax" => $row["syntax"],
    //             "path" => $row["path"]
    //         ];
    //         $i++;
    //     }

    //     if (!$ImagesList){
    //         $ImagesList[0] = [
    //             "name" => "There are no images.<br>Let's create a new Image !",
    //             "posted" => "None",
    //             "syntax" => "None",
    //             "path" => "None"
    //         ];
    //     }
    //     return $ImagesList;
    // }

    // private static function getPostTime(string $pre): string{
    //     $now = date("Y-m-d H:i:s");
    //     $preTime = new DateTime($pre);
    //     $currentTime = new DateTime($now);
    //     $interval = $preTime->diff($currentTime);

    //     $minutes = $interval->days * 24 * 60;
    //     $minutes += $interval->h * 60;
    //     $minutes += $interval->i;

    //     return $minutes / 60 < 1 ? (int)$minutes." min ago" : (int)($minutes / 60)." hours ago" ;
    // }
}
<?php

namespace Helpers;

use Database\MySQLWrapper;
use DateTime;
use Exception;

class DatabaseHelper
{
    public static function getImagesListInfo(): array{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM Image WHERE access_control = 'Public' ORDER BY view_count DESC");
        $stmt->execute();

        $result = $stmt->get_result();
        $ImagesList = [];
        $i = 0;

        while ($row = $result->fetch_assoc()) {
            $ImagesList[$i] = [
                "title" => $row["title"],
                "post_url" => $row["post_url"],
                "file_extension" => $row["file_extension"],
                "view_count" => $row["view_count"]
            ];
            $i++;
        }

        if (!$ImagesList){
            $ImagesList[0] = [
                "title" => "",
                "post_url" => "",
                "file_extension" => "",
                "view_count" => 0
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
    //         header("Location: ../notExistImage");
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
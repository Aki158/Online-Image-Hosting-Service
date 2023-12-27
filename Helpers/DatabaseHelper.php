<?php

namespace Helpers;

use Database\MySQLWrapper;
use DateTime;
use Exception;

class DatabaseHelper
{
    public static function accessCheck(): void{
        $db = new MySQLWrapper();

        $stmt1 = $db->prepare("SELECT * FROM Image");
        $stmt1->execute();

        $result = $stmt1->get_result();
        $currDate = new DateTime(date("Y-m-d H:i:s"));
        $i = 0;
        $imagesId = [];

        while ($row = $result->fetch_assoc()) {
            $accessedAt = new DateTime($row["accessed_at"]);
            $interval = $currDate->diff($accessedAt);
            if((int)$interval->format("%a") >= 30){
                // 30日間アクセスされていない画像を削除する
                unlink($row["image_path"]);
                $imagesId[$i] = $row["id"];
                $i++;
            }
        }

        if(count($imagesId) > 0){
            $inClause = substr(str_repeat(',?', count($imagesId)), 1);
            $shortTypes = str_repeat('i', count($imagesId));
        
            $stmt2 = $db->prepare(sprintf('DELETE FROM Image WHERE id in (%s)', $inClause));
        
            // bind_param() が配列を受け取るように動的に変数を割り当てる
            $params = array_merge(array($shortTypes), $imagesId);

            foreach ($params as $key => $value) {
                $params[$key] = &$params[$key];
            }
            call_user_func_array(array($stmt2, 'bind_param'), $params);
            // 30日間アクセスされていないデータを削除する
            $stmt2->execute();
        }
    }

    public static function getImage(string $columnName,string $path): array{
        $db = new MySQLWrapper();

        if($columnName === "post_url"){
            $stmt = $db->prepare("SELECT * FROM Image WHERE post_url = ?");
        }
        else if($columnName === "delete_url"){
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
        $accessControl = 'Public';

        $stmt = $db->prepare("SELECT * FROM Image WHERE access_control = ? ORDER BY view_count DESC");
        $stmt->bind_param('s', $accessControl);
        $stmt->execute();

        $result = $stmt->get_result();
        $imagesList = [];
        $i = 0;

        while ($row = $result->fetch_assoc()) {
            $imagesList[$i] = $row;
            $i++;
        }

        if (!$imagesList){
            $imagesList[0] = [
                "id" => 0
            ];
        }
        return $imagesList;
    }

    public static function countFile(string $ip_address, string $date): int{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT COUNT(*) AS num FROM Image WHERE ip_address = ? AND created_at LIKE ?");
        $stmt->bind_param('ss', $ip_address, $date);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["num"]??0;
    }

    public static function totalFileSize(string $ip_address, string $date): float{
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT SUM(file_size) AS total_file_size FROM Image WHERE ip_address = ? AND created_at LIKE ?");
        $stmt->bind_param('ss', $ip_address, $date);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["total_file_size"]??0;
    }

    public static function updateImage(int $id): void{
        $db = new MySQLWrapper();
        $date = date("Y-m-d H:i:s");

        $stmt = $db->prepare("UPDATE Image SET accessed_at = ?, view_count = view_count + 1 WHERE id = ?");
        $stmt->bind_param('si', $date, $id);
        $stmt->execute();
    }

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
}
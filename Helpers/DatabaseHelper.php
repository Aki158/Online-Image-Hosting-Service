<?php

namespace Helpers;

use Database\MySQLWrapper;
use Exception;

class DatabaseHelper
{
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

        $stmt = $db->prepare("SELECT * FROM Image WHERE access_control = 'Public' ORDER BY view_count DESC");
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
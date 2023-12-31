<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Database\MySQLWrapper;
use Helpers\DatabaseHelper;

class Dummy extends AbstractCommand
{
    protected static ?string $alias = 'dummy';

    public static function getArguments(): array
    {
        return [
            (new Argument('year'))->description('Set year.')->required(false)->allowAsShort(true),
            (new Argument('month'))->description('Set month.')->required(false)->allowAsShort(true),
            (new Argument('day'))->description('Set day.')->required(false)->allowAsShort(true)
        ];
    }

    public function execute(): int
    {
        $year = $this->getArgumentValue('year');
        $month = $this->getArgumentValue('month');
        $day = $this->getArgumentValue('day');

        if($year && $month && $day){
            $this->seedTestData($year, $month, $day);
        }
        else{
            $this->log("Argument not set correctly.");
        }
        return 0;
    }

    private function seedTestData(string $year, string $month, string $day): void{
        $db = new MySQLWrapper();
        
        $time = date("H:i:s");
        $date = $year."-".$month."-".$day." ".$time;
        $postFileName = hash("md5",$date);
        $deleteFileName = hash("sha1",$date);
        $upload_file_dir = DatabaseHelper::generateDir("", $year, $month, $day);
        $this->log($upload_file_dir);
        $sourceFile = "Dummies/dummyImage.png";

        // テスト用のダミーデータ
        $title = "Untitled";
        $access_control = "Private";
        $image_path = $upload_file_dir . "/" . $postFileName . ".png";
        $post_url = "https://online-image-hosting-service.aki158-website.blog/image-png/".$postFileName;
        $delete_url = "https://online-image-hosting-service.aki158-website.blog/image-png/".$deleteFileName;
        $ip_address = "127.0.0.1";
        $file_size = 1294607;
        $created_at = $date;
        $accessed_at = $date;

        // Dummiesフォルダから画像をコピーしてImagesフォルダにおく
        if(copy($sourceFile, $image_path)){
            $this->log("Successfully copied files from Dummies folder.");
        }
        else{
            $this->log("Failed to copy files from Dummies folder.");
        }

        // created_at列のデフォルト値を無効化
        $stmt = $db->prepare("ALTER TABLE Image MODIFY created_at DATETIME NOT NULL");
        $stmt->execute();

        // accessed_at列のデフォルト値を無効化
        $stmt = $db->prepare("ALTER TABLE Image MODIFY accessed_at DATETIME NOT NULL");
        $stmt->execute();

        $columnNames = ['title', 'access_control', 'image_path', 'post_url', 'delete_url', 'ip_address', 'file_size', 'created_at', 'accessed_at'];
        $placeholders = str_repeat('?,', count($columnNames) - 1) . '?';
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            "Image",
            implode(', ', $columnNames),
            $placeholders
        );
        
        $image_path =  '../'.$image_path;

        // データを投入する
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssssssdss', $title, $access_control, $image_path, $post_url, $delete_url, $ip_address, $file_size, $created_at, $accessed_at);
        $stmt->execute();

        // created_at列のデフォルト値を変更前に戻す
        $stmt = $db->prepare("ALTER TABLE Image MODIFY created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $stmt->execute();

        // accessed_at列のデフォルト値を変更前に戻す
        $stmt = $db->prepare("ALTER TABLE Image MODIFY accessed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $stmt->execute();

        $this->log("Inserted dummy data into the Image table.");
    }
}
<?php

namespace Commands\Programs;

use DateTime;

use Commands\AbstractCommand;
use Database\MySQLWrapper;

class Cron extends AbstractCommand
{
    protected static ?string $alias = 'cron';

    public static function getArguments(): array
    {
        return [];
    }

    public function execute(): int
    {
        $this->accessCheck();
        return 0;
    }

    private function accessCheck(): void{
        $db = new MySQLWrapper();

        $stmt1 = $db->prepare("SELECT * FROM Image");
        $stmt1->execute();

        $result = $stmt1->get_result();
        $date = date("Y-m-d H:i:s");
        $currDate = new DateTime($date);
        $i = 0;
        $imagesId = [];
        $this->log("Execution time of cron command : ".$date."\n");

        while ($row = $result->fetch_assoc()) {
            $accessedAt = new DateTime($row["accessed_at"]);
            $interval = $currDate->diff($accessedAt);
            if((int)$interval->format("%a") >= 30){
                // 30日間アクセスされていない画像を削除する
                $deleteFilePath = substr($row["image_path"], 3);
                // 画像ファイルの所有者をwww-dataからubuntu(管理者)に変更する
                chown($deleteFilePath, "ubuntu");
                $this->log("image_path : ".$row["image_path"]."\n");
                if(unlink($deleteFilePath)){
                    $this->log("File successfully deleted.\n");
                }
                else{
                    $this->log("Failed to delete file.\n");
                }
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
            if($stmt2->execute()){
                $this->log("Data successfully deleted.\n");
            }
            else{
                $this->log("Failed to delete data.\n");
            }
        }
    }
}
<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Database\MySQLWrapper;
use Database\Seeder;

class Seed extends AbstractCommand
{
    protected static ?string $alias = 'seed';

    public static function getArguments(): array
    {
        return [
            (new Argument('title'))->description('Set title.')->required(false)->allowAsShort(true),
            (new Argument('access_control'))->description('Set access_control.')->required(false)->allowAsShort(true),
            (new Argument('image_path'))->description('Set image_path.')->required(false)->allowAsShort(true),
            (new Argument('post_url'))->description('Set post_url.')->required(false)->allowAsShort(true),
            (new Argument('delete_url'))->description('Set delete_url.')->required(false)->allowAsShort(true),
            (new Argument('ip_address'))->description('Set ip_address.')->required(false)->allowAsShort(true),
            (new Argument('file_size'))->description('Set file_size.')->required(false)->allowAsShort(true)
        ];
    }

    public function execute(): int
    {
        $title = $this->getArgumentValue('title');
        $access_control = $this->getArgumentValue('access_control');
        $image_path = $this->getArgumentValue('image_path');
        $post_url = $this->getArgumentValue('post_url');
        $delete_url = $this->getArgumentValue('delete_url');
        $ip_address = $this->getArgumentValue('ip_address');
        $file_size = $this->getArgumentValue('file_size');

        $this->runAllSeeds($title, $access_control, $image_path, $post_url, $delete_url, $ip_address, $file_size);
        return 0;
    }
    
    function runAllSeeds(string $title, string $access_control, string $image_path, string $post_url, string $delete_url, string $ip_address, float $file_size): void {
        $directoryPath = __DIR__ . '/../../Database/Seeds';

        // ディレクトリをスキャンしてすべてのファイルを取得する
        $files = scandir($directoryPath);

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                // ファイル名からクラス名を抽出する
                $className = 'Database\Seeds\\' . pathinfo($file, PATHINFO_FILENAME);

                // シードファイルをインクルードする
                include_once $directoryPath . '/' . $file;

                if (class_exists($className) && is_subclass_of($className, Seeder::class)) {
                    $seeder = new $className(new MySQLWrapper());
                    $seeder->seed($title, $access_control, $image_path, $post_url, $delete_url, $ip_address, $file_size);
                }
                else throw new \Exception('Seeder must be a class that subclasses the seeder interface');
            }
        }
    }
}
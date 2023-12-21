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
            (new Argument('file_extension'))->description('Set file_extension.')->required(false)->allowAsShort(true),
            (new Argument('post_url'))->description('Set post_url.')->required(false)->allowAsShort(true),
            (new Argument('delete_url'))->description('Set delete_url.')->required(false)->allowAsShort(true),
            (new Argument('ip_address'))->description('Set ip_address.')->required(false)->allowAsShort(true),
            (new Argument('view_count'))->description('Set view_count.')->required(false)->allowAsShort(true),
            (new Argument('file_size'))->description('Set file_size.')->required(false)->allowAsShort(true),
            (new Argument('accessed_at'))->description('Set accessed_at.')->required(false)->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        $title = $this->getArgumentValue('title');
        $access_control = $this->getArgumentValue('access_control');
        $file_extension = $this->getArgumentValue('file_extension');
        $post_url = $this->getArgumentValue('post_url');
        $delete_url = $this->getArgumentValue('delete_url');
        $ip_address = $this->getArgumentValue('ip_address');
        $view_count = $this->getArgumentValue('view_count');
        $file_size = $this->getArgumentValue('file_size');
        $accessed_at = $this->getArgumentValue('accessed_at');

        $this->runAllSeeds($title, $access_control, $file_extension, $post_url, $delete_url, $ip_address, $view_count, $file_size, $accessed_at);
        return 0;
    }
    
    function runAllSeeds(string $title, string $access_control, string $file_extension, string $post_url, string $delete_url, string $ip_address, int $view_count, float $file_size, string $accessed_at): void {
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
                    $seeder->seed($title, $access_control, $file_extension, $post_url, $delete_url, $ip_address, $view_count, $file_size, $accessed_at);
                }
                else throw new \Exception('Seeder must be a class that subclasses the seeder interface');
            }
        }
    }
}
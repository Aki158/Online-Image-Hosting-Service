<?php

namespace Database;

interface Seeder
{
    public function seed(string $title, string $access_control, string $file_extension, string $post_url, string $delete_url, string $ip_address, int $view_count, float $file_size, string $accessed_at): void;

    public function createRowData(string $title, string $access_control, string $file_extension, string $post_url, string $delete_url, string $ip_address, int $view_count, float $file_size, string $accessed_at): array;
}
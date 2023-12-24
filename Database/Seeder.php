<?php

namespace Database;

interface Seeder
{
    public function seed(string $title, string $access_control, string $file_extension, string $post_url, string $delete_url, string $ip_address, float $file_size): void;

    public function createRowData(string $title, string $access_control, string $file_extension, string $post_url, string $delete_url, string $ip_address, float $file_size): array;
}
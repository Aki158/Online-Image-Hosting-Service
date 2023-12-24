<?php

namespace Database\Seeds;

use Database\AbstractSeeder;

class ImageSeeder extends AbstractSeeder {

    protected ?string $tableName = 'Image';

    protected array $tableColumns = [
        [
            'data_type' => 'string',
            'column_name' => 'title'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'access_control'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'file_extension'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'post_url'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'delete_url'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'ip_address'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'file_size'
        ]
    ];

    public function createRowData(string $title, string $access_control, string $file_extension, string $post_url, string $delete_url, string $ip_address, float $file_size): array
    {
        return [
            [
                $title,
                $access_control,
                $file_extension,
                $post_url,
                $delete_url,
                $ip_address,
                $file_size
            ]
        ];
    }
}
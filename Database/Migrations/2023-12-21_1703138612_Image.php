<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class Image implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE Image (
                id INT PRIMARY KEY AUTO_INCREMENT,
                title VARCHAR(255) NOT NULL,
                access_control VARCHAR(255) NOT NULL,
                image_path VARCHAR(255) NOT NULL,
                post_url VARCHAR(255) NOT NULL,
                delete_url VARCHAR(255) NOT NULL,
                ip_address VARCHAR(255) NOT NULL,
                view_count INT NOT NULL DEFAULT 0,
                file_size FLOAT NOT NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                accessed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            )"
        ];
    }

    public function down(): array
    {
        return [
            "DROP TABLE Image"
        ];
    }
}
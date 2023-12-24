<?php 

namespace Helpers;

// composerの依存関係のオートロード
require_once '../vendor/autoload.php';

use Helpers\DatabaseHelper;

$raw = file_get_contents('php://input');
$image_path = json_decode($raw);
$status = DatabaseHelper::deleteImage($image_path);

print($status);

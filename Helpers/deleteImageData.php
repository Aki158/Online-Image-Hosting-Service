<?php 

namespace Helpers;

// composerの依存関係のオートロード
require_once '../vendor/autoload.php';

use Helpers\DatabaseHelper;

$raw = file_get_contents('php://input');
$imagePath = json_decode($raw);
$status = DatabaseHelper::deleteImage($imagePath);

print($status);

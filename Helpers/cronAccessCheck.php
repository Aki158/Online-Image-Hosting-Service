<?php 

namespace Helpers;

// composerの依存関係のオートロード
require_once '../vendor/autoload.php';

use Helpers\DatabaseHelper;

// cronを使用して1日1回アクセス計算チェックを行う
// 30日間アクセスされていない画像は、削除する
DatabaseHelper::accessCheck();

<?php

namespace Views;

use Helpers\DatabaseHelper;

?>

<div class="container py-3">
    <h3><?= htmlspecialchars($image["title"])?></h3>
    <h5 class="my-2">閲覧数 : <?= htmlspecialchars($image["view_count"])?></h5>
    <div>
        <img src="<?= htmlspecialchars($image["image_path"])?>" alt="No image.">
    </div>
</div>

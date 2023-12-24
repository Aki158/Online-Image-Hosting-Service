<?php

namespace Views;

use Helpers\DatabaseHelper;

DatabaseHelper::updateImage($image["id"]);

?>

<div class="container pb-3">
    <h4><i class='fa-solid fa-file-signature'></i> <?= htmlspecialchars($image["title"])?></h4>
    <h5 class="my-2"><i class='fa-solid fa-fire'></i> 閲覧数 : <?= htmlspecialchars($image["view_count"])?></h5>
    <div>
        <img src="<?= htmlspecialchars($image["image_path"])?>" alt="No image.">
    </div>
</div>

<?php

namespace Views;

?>

<div class="container pb-3">
    <h4><?= htmlspecialchars($image["title"])?></h4>
    <h5 class="my-2">閲覧数 : <?= htmlspecialchars($image["view_count"])?></h5>
    <div>
        <img src="<?= htmlspecialchars($image["image_path"])?>" alt="No image.">
    </div>
</div>

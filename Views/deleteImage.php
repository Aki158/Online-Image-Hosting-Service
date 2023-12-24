<?php

namespace Views;

?>

<div class="container pb-3">
    <div>
        <h4><?= htmlspecialchars($image["title"])?></h4>
        <div>
            <img src="<?= htmlspecialchars($image["image_path"])?>" alt="No image.">
        </div>
    </div>
    <div>
        <button class="btn btn-primary my-3" onclick="click_delete('<?php print($image['image_path']) ?>')"><i class="fa-solid fa-trash"></i> 画像を削除する</a>
    </div>
    <p id="res_message"></p>
</div>
<script src="../../Public/js/app_deleteImage.js"></script>

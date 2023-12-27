<?php

namespace Views;

?>

<div class="container pb-3">
    <div>
        <h4><i class='fa-solid fa-file-signature'></i> <?= htmlspecialchars($image["title"])?></h4>
        <div>
            <img src="<?= htmlspecialchars($image["image_path"])?>" alt="画像は、表示できませんでした">
        </div>
    </div>
    <div>
        <button class="btn btn-primary my-3" onclick="clickDelete('<?php print($image['image_path']) ?>')"><i class="fa-solid fa-trash"></i> 画像を削除する</a>
    </div>
    <p id="res_message"></p>
</div>
<script src="../../Public/js/app_deleteImage.js"></script>

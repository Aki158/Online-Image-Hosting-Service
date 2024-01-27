<?php

namespace Views;

?>

<div class="container">
    <h4><i class="fa-solid fa-table"></i> リスト</h4>
    <p>&#x2757; このページには、最近ポストされた画像が含まれています</p>
    <div id="images_list_body" class="row"></div>
</div>

<script>
    const imagesList = <?php echo json_encode($imagesList); ?>;
</script>
<script src="/Public/js/app_publicImages.js"></script>

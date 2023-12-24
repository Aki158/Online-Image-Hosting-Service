<div class="container">
    <h4><i class="fa-solid fa-table"></i> リスト</h4>
    <p>&#x2757; このページには、最近投稿された画像が含まれています</p>
    <div id="images_list_body" class="row"></div>
</div>

<script>
    const ImagesList = <?php echo json_encode($ImagesList); ?>;
</script>
<script src="../Public/js/app_publicImages.js"></script>

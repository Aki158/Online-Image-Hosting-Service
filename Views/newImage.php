<?php

namespace Views;

?>

<div class="container pb-5">
    <div class="row">
        <div class="col-4">
            <div class="container mb-3">
                <h5 class="py-1"><i class="fa-solid fa-gear"></i> 設定</h5>
                <div class="row">
                    <div class="col-md-12 bg-light rounded custom-border">
                        <div class="my-3">
                            <p class="my-1">タイトル</p>
                            <input id="input_title" type="text" name="name" size="20" maxlength="50">
                        </div>
                        <div class="my-3">
                            <input type="file" id="upload_file" accept=".jpg, .jpeg, .png, .gif">
                        </div>
                        <div class="my-3">
                            <p class="my-1">表示設定</p>
                            <select id="access_control" name="access_control">
                                <option value="Private">リストに表示しない</option>
                                <option value="Public">リストに表示する</option>
                            </select>
                        </div>
                        <div class="my-4">
                            <button onclick="postData()">ポストする</button>
                        </div>
                    </div>
                </div>
                <p class="my-3" id="post_status"></p>
                <div id="url_display_area">
                    <h5 class="py-1"><i class="fa-solid fa-link"></i>URL</h5>
                    <div class="row">
                        <div class="col-md-12 bg-light rounded custom-border pb-3">
                            <p class="my-1">ポストURL : </p>
                            <a id="post_url" href=""></a>
                            <p class="my-1">削除URL : </p>
                            <a id="delete_url" href=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <h5 class="my-1"><i class="fa-regular fa-image"></i> プレビュー</h5>
            <img id="uploadImg" src="" alt="ファイルを選択すると表示されます">
        </div>
    </div>
</div>
<script src="../Public/js/app_newImage.js"></script>

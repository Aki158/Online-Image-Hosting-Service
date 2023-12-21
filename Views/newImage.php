<div class="container">
    <h4 id="ImageStatus" class="bg-danger text-white "></h4>
    <h4><i class="fa-solid fa-plus"></i> New Image</h4>
    <div class="py-3">
        <img src="" alt="No images have been chosen yet.">
    </div>
    <form action="../Helpers/createNewImage.php" method="post">
        <h5 class="py-1"><i class="fa-regular fa-pen-to-square"></i> Optional Image Settings</h5>
        <div class="container mb-3">
            <div class="row">
                <div class="col-md-4 bg-light rounded custom-border">
                    <div class="my-3">
                        <p class="my-1">Access Control : </p>
                        <p class="my-1">You can choose whether to display in “Public Images”.</p>
                        <select name="access_control">
                            <option value="Private">Private</option>
                            <option value="Public">Public</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <p class="my-1">Image Title :</p>
                        <p id="errorMessage" class="my-1"><i class="fa-solid fa-triangle-exclamation"></i> Unsupported characters < > : " . / \ | ?*</p>
                        <input id="inputName" type="text" name="name" size="20" maxlength="50">
                    </div>
                    <div class="my-4">
                        <input id="submitButton" type="submit" value="Post New Image">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.20.0/min/vs/loader.min.js"></script>
<script src="../Public/js/app_newImage.js"></script>

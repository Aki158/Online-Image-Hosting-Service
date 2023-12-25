const postStatus = document.getElementById('post_status');
const urlDisplayArea = document.getElementById("url_display_area");

const input = document.getElementById('upload_file');
input.addEventListener('change', function() {
    const reader = new FileReader();
    reader.onload = function() {
        clearResult();
        document.getElementById('uploadImg').src = reader.result;
    };
    reader.readAsDataURL(input.files[0]);
});

function clearResult(){
    postStatus.classList.remove("text-danger");
    postStatus.innerHTML = "";
    urlDisplayArea.style.display = "none";
}

function postData() {
    const inputTitle = document.getElementById('input_title').value;
    const uploadFile = document.getElementById('upload_file');
    const accessControl = document.getElementById('access_control').value;
    const formData = new FormData();
    formData.append('text', inputTitle);
    formData.append('file', uploadFile.files[0]);
    formData.append('button', accessControl);

    clearResult();

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../Helpers/fileUpload.php', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                renderpostResult(response);
            } catch (e) {
                console.log('Error parsing JSON:', e, xhr.responseText);
            }
        } else {
            postStatus.innerHTML = "エラーが発生しました。";
        }
    };
    xhr.send(formData);
}

function renderpostResult(response){
    if(response.status === "success"){
        const postURL = document.getElementById("post_url");
        const deleteURL = document.getElementById("delete_url");

        postStatus.innerHTML = "↓URLの生成に成功しました!";
        postURL.href = response.post_url;
        deleteURL.href = response.delete_url;
        postURL.textContent = "https://online-image-hosting-service.aki158-website.blog/"+response.post_url;
        deleteURL.textContent = "https://online-image-hosting-service.aki158-website.blog/"+response.delete_url;
        urlDisplayArea.style.display = "block";
    }
    else{
        postStatus.classList.add("text-danger");
        postStatus.innerHTML = response.message;
    }
}
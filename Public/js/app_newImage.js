const postStatus1 = document.getElementById('post_status1');
const postStatus2 = document.getElementById('post_status2');
const urlDisplayArea = document.getElementById("url_display_area");

const input = document.getElementById('upload_file');
input.addEventListener('change', function() {
    const reader = new FileReader();
    reader.onload = function() {
        postStatus1.classList.remove("text-danger");
        postStatus1.innerHTML = "";
        postStatus2.innerHTML = "";
        urlDisplayArea.style.display = "none";
        document.getElementById('uploadImg').src = reader.result;
    };
    reader.readAsDataURL(input.files[0]);
});

function postData() {
    const inputTitle = document.getElementById('input_title').value;
    const uploadFile = document.getElementById('upload_file');
    const accessControl = document.getElementById('access_control').value;
    const formData = new FormData();
    formData.append('text', inputTitle);
    formData.append('file', uploadFile.files[0]);
    formData.append('button', accessControl);

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
            postStatus1.innerHTML = "エラーが発生しました。";
            postStatus2.innerHTML = "設定を見直してください。";
        }
    };
    xhr.send(formData);
}

function renderpostResult(response){
    if(response.status === "success"){
        const postURL = document.getElementById("post_url");
        const deleteURL = document.getElementById("delete_url");

        postStatus1.innerHTML = "↓URLの生成に成功しました!";
        postURL.href = response.post_url;
        deleteURL.href = response.delete_url;
        postURL.textContent = "https://online-image-hosting-service.aki158-website.blog/"+response.post_url;
        deleteURL.textContent = "https://online-image-hosting-service.aki158-website.blog/"+response.delete_url;
        urlDisplayArea.style.display = "block";
    }
    else{
        postStatus1.classList.add("text-danger");
        postStatus1.innerHTML = response.message;
        postStatus2.innerHTML = "設定を見直してください。";
    }
}
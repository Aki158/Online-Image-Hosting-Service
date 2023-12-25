window.addEventListener("load", (event) => {
    for (var i = 0; i < Object.keys(imagesList).length; i++) {
        renderList(i,imagesList,document.getElementById("images_list_body"));
    }
});

function renderList(index, imagesList, imagesListBody){
    const div = document.createElement("div");
    const a = document.createElement("a");
    const img = document.createElement("img");
    const title = document.createElement("p");
    const viewCount = document.createElement("p");

    // Imageテーブルに画像がない場合
    if(imagesList[index].id === 0) {
        div.classList.add("my-3");
        title.innerHTML = "ポストされた画像はありません...";
        div.append(title);
        imagesListBody.append(div);
    }
    else{
        const title_str = imagesList[index].title.length > 16 ? imagesList[index].title.substr(0, 15) + '...' : imagesList[index].title;
        
        div.setAttribute("id", "ImageList"+(index+1));
        a.setAttribute("id", "a"+(index+1));
        img.setAttribute("id", "img"+(index+1));
        title.setAttribute("id", "title"+(index+1));
        viewCount.setAttribute("id", "view_count"+(index+1));

        div.classList.add("col-3", "my-2");
        img.classList.add("public-img-size");
        
        a.href = imagesList[index].post_url;
        img.src = imagesList[index].image_path;
        title.innerHTML = "<i class='fa-solid fa-file-signature'></i> " + title_str;
        viewCount.innerHTML = "<i class='fa-solid fa-fire'></i> 閲覧数 : " + imagesList[index].view_count;

        a.append(img);
        div.append(a);
        div.append(title);
        div.append(viewCount);
        imagesListBody.append(div);
    }
}
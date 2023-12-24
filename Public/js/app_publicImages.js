window.addEventListener("load", (event) => {
    for (var i = 0; i < Object.keys(ImagesList).length; i++) {
        renderTableCell(i,ImagesList,document.getElementById("images_list_body"));
    }
});

function renderTableCell(index, ImagesList, imagesListBody){
    const div = document.createElement("div");
    const a = document.createElement("a");
    const img = document.createElement("img");
    const title = document.createElement("p");
    const view_count = document.createElement("p");

    div.setAttribute("id", "ImageList"+(index+1));
    a.setAttribute("id", "a"+(index+1));
    img.setAttribute("id", "img"+(index+1));
    title.setAttribute("id", "title"+(index+1));
    view_count.setAttribute("id", "view_count"+(index+1));

    div.classList.add("col-3", "my-2");
    img.classList.add("public-img-size");
    
    a.href = ImagesList[index].post_url;
    img.src = ImagesList[index].image_path;
    title.innerHTML = "<i class='fa-solid fa-file-signature'></i> " + ImagesList[index].title;
    view_count.innerHTML = "<i class='fa-solid fa-fire'></i> 閲覧数 : " + ImagesList[index].view_count;

    a.append(img);
    div.append(a);
    div.append(title);
    div.append(view_count);
    imagesListBody.append(div);
}
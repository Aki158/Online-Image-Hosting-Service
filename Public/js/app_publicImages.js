window.addEventListener("load", (event) => {
    for (var i = 0; i < Object.keys(ImagesList).length; i++) {
        renderTableCell(i,ImagesList,document.getElementById("images_list_body"));
    }
});

function renderTableCell(index,ImagesList,imagesListBody){
    const div = document.createElement("div");
    const img = document.createElement("img");
    const title = document.createElement("p");
    const view_count = document.createElement("p");

    div.classList.add("col-3","my-2");
    img.src = "../Images" + ImagesList[index].file_extension + 


    // const row = document.createElement("tr");
    // const cellThName = document.createElement("th");
    // const cellTdPosted = document.createElement("td");
    // const cellTdSyntax = document.createElement("td");

    // row.setAttribute("id", "table_content"+(index+1));

    // cellThName.setAttribute("id", "name"+(index+1));
    // cellTdPosted.setAttribute("id", "posted"+(index+1));
    // cellTdSyntax.setAttribute("id", "syntax"+(index+1));

    // cellThName.innerHTML = ImagesList[index].name;
    // cellTdPosted.innerHTML = ImagesList[index].posted;
    // cellTdSyntax.innerHTML = ImagesList[index].syntax;

    // row.classList.add("cursor-pointer");
    
    // row.addEventListener("click", function() {
    //     if(ImagesList[index].path !== "None"){
    //         window.location.href = "image/"+ImagesList[index].path;
    //     }
    // });

    // row.append(cellThName);
    // row.append(cellTdPosted);
    // row.append(cellTdSyntax);
    imagesListBody.append(row);
}
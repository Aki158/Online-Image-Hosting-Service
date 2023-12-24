function click_delete(image_path){
    fetch("../../Helpers/deleteImageData.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(image_path)
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        var res_message = document.getElementById("res_message");
        res_message.innerHTML = data;
    })
    .catch(error => {
        console.error("Error:", error);
    });
}
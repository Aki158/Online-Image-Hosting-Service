function clickDelete(imagePath){
    fetch("../../Helpers/deleteImageData.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(imagePath)
    })
    .then(response => response.text())
    .then(data => {
        var resMessage = document.getElementById("res_message");
        resMessage.innerHTML = data;
    })
    .catch(error => {
        console.error("Error:", error);
    });
}
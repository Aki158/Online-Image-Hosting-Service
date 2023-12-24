function click_download(){
    // download用にボタンを設定してHTMLにレンダリングする
    hashmap.display_format = "Preview";
    document.getElementById("highlight_button").innerHTML = "Highlight: ON";
    hashmap.highlight_sw = document.getElementById("highlight_button").innerHTML;
    render();

    const htmlContent = document.getElementById("display_code_area").innerHTML;
    const blob = new Blob([htmlContent], { type: "text/html" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "converted.html";
    link.click();
}
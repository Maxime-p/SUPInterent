document.getElementById("toggle").addEventListener('click', function () {
    let checkBox = document.getElementById("toggle");
    let text = document.getElementById("generate");
    
    if (checkBox.checked == true){
        text.style.display = "none";
    } else {
        text.style.display = "block";
    }
})



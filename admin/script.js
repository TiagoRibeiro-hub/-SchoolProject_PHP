function clickChooseImage(imagem, custom_btn, text_btn){

let realBtn = document.getElementById(imagem);
let customBtn = document.getElementById(custom_btn);
let text = document.getElementById(text_btn);

customBtn.addEventListener("click", function() {
    realBtn.click();
});

realBtn.addEventListener("change", function(){
    if(realBtn.value){
        text.innerHTML = realBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1]; // fica so o nome da imagem [1] -> primeiro elemento 
    }else{
        text.innerHTML = "No image chosen, yet!"
    }
});
}


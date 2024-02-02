$(function(){
    
    (function(){ //init
        $("#form-basic-data").fadeIn();
        $(".item.1").addClass("selected");
    })();

    itensMenu();

    function itensMenu(){
        $(".item.1").click(function(){
            $(".item.3").removeClass("selected");
            $(".item.2").removeClass("selected");
            $(".item.1").addClass("selected");
            disableFormEditPhoto();
            disableFormEditPassw();
            activeFormBasicData();
        });
        $(".item.2").click(function(){
            $(".item.3").removeClass("selected");
            $(".item.1").removeClass("selected");
            $(".item.2").addClass("selected");
            disableFormBasicData();
            disableFormEditPassw();
            activeFormEditPhoto();
        });
        $(".item.3").click(function(){
            $(".item.1").removeClass("selected");
            $(".item.2").removeClass("selected");
            $(".item.3").addClass("selected");
            disableFormBasicData();
            disableFormEditPhoto();
            activeFormEditPassw();
        });
    }

    function activeFormBasicData() {
        $("#form-basic-data").fadeIn();
    }
    function disableFormBasicData(){
        $("#form-basic-data").hide();
    }

    function activeFormEditPhoto(){
        $("#form-edit-photo").fadeIn();
    }
    function disableFormEditPhoto(){
        $("#form-edit-photo").hide();
    }

    function activeFormEditPassw(){
        $("#form-edit-passw").fadeIn();
    }
    function disableFormEditPassw(){
        $("#form-edit-passw").hide();
    }
});

const inputFile = document.querySelector("#picture__input");
const pictureImage = document.querySelector(".picture__image");
const pictureImageTxt = "Selecione uma imagem";
pictureImage.innerHTML = pictureImageTxt;

inputFile.addEventListener("change", function (e) {
    const inputTarget = e.target;
    const file = inputTarget.files[0];

    if (file) {
        const reader = new FileReader();

        reader.addEventListener("load", function (e) {
            const readerTarget = e.target;

            const img = document.createElement("img");
            img.src = readerTarget.result;
            img.classList.add("picture__img");

            pictureImage.innerHTML = "";
            pictureImage.appendChild(img);
        });

        reader.readAsDataURL(file);
    } else {
        pictureImage.innerHTML = pictureImageTxt;
    }
});
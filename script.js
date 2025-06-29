'use strict';

function imgLink(link){
    document.getElementById("img_form" + link).submit(); 
}

function linkSelect(){
    console.log("ciao");
    const selectBox = document.querySelectorAll(".linkSelect");
    //const selectedValue = selectBox.options[selectBox.selectedIndex].value;
    console.log(selectBox);
}

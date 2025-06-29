

const input = document.querySelectorAll('.input_file')
const input_head = document.querySelector('#head_file')
const output = document.querySelectorAll('.output_file')
const output_head = document.querySelector('#output_file_head')

let imagesArray = []
let newImagesArray = []
newImagesArray[0] = []
newImagesArray[1] = []

// Summernote
// $('.summernote').summernote({
//     height : 300
// });

$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});

// activates whenever the admin uploads image with the input file selector
input_head.addEventListener("change", () => {
    let file = input_head.files
    displayImageHead(file[0])

})

function displayImageHead(image) {
    let image_head = `<div class='image'>
                    <img src="${URL.createObjectURL(image)}" alt="image">
                </div>`
    // display the image
    output_head.innerHTML = image_head
}


// activates whenever the admin uploads images with the multiple input file selector
for (let inp=0; inp<input.length; inp++){
    input[inp].addEventListener("change", () => {
        newImagesArray[inp] = []
        const files = input[inp].files
        for (let i = 0; i < files.length; i++) {
            newImagesArray[inp].push(files[i])
        }
        displayImages([inp])
    })
}

// the variable images will hold the dynamic HTML for each image
function displayImages(input_index) {
    let images = ""
    newImagesArray[input_index].forEach((image, index) => {
      images += `<div class="image">
                  <img src="${URL.createObjectURL(image)}" alt="image">
                </div>`
    })
    // display the image
    for (let i=0; i<output.length; i++) {
        if(input_index == i) {
            output[i].innerHTML = images
        }
    }
}
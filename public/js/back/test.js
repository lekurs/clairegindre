const target = document.getElementById('target');
const newImg = document.querySelector('.new-img');

target.addEventListener('drop', e => {
    e.stopPropagation();
e.preventDefault();

newImg.src = URL.createObjectURL(e.dataTransfer.files[0]); // Adds files to empty img element
newImg.nextElementSibling.remove(); // removes h2
});

target.addEventListener('dragover', e => {
    e.stopPropagation();
e.preventDefault();

e.dataTransfer.dropEffect = 'copy';
})
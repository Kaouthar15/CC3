const slider = document.getElementById('slider');
const images = slider.getElementsByTagName('img');
let currentImageIndex = 0;

function showImage(index) {
  for (let i = 0; i < images.length; i++) {
    images[i].style.opacity = 0;
  }
  images[index].style.opacity = 1;
}

function slideImages() {
  showImage(currentImageIndex);
  currentImageIndex = (currentImageIndex + 1) % images.length;
}

setInterval(slideImages, 3000); // Change image every 3 seconds

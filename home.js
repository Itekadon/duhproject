
function showMore() {
  var moreContent = document.getElementById("moreContent");
  var button = document.querySelector(".show-more-button");

  if (moreContent.style.display === "none" || moreContent.style.display === "") {
      moreContent.style.display = "block";
      button.textContent = "Show Less";
  } else {
      moreContent.style.display = "none";
      button.textContent = "Show More";
  }
}
var currentIndex = 0;
var images = document.querySelectorAll('.image-container');

function showImage(index) {
    // Calculate the wrapped index to ensure continuous looping
    var wrappedIndex = index % images.length;
    // Move the container to reveal the current image
    var translateValue = -wrappedIndex * 100 + '%';
    images.forEach(function(image) {
        image.style.transform = 'translateX(' + translateValue + ')';
    });
}

function nextImage() {
    currentIndex++;
    showImage(currentIndex);
}

function startSlideshow() {
    // Show the first image initially
    showImage(currentIndex);
    // Set interval to switch images every 60 seconds
    setInterval(nextImage, 60000);
}

startSlideshow();


// READ CONTENT ALOUD
function readContentAloud() {
    var content = document.getElementById('content').cloneNode(true); 
    var showLessButton = content.querySelector('.show-more-button'); 
    if (showLessButton) { 
        showLessButton.remove(); 
    }
    var textContent = content.textContent; 
    var speech = new SpeechSynthesisUtterance(textContent);
    speech.lang = 'en-US'; 
    window.speechSynthesis.speak(speech); 
}




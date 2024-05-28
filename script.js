const container = document.getElementById('container')
const registerBtn = document.getElementById('register')
const loginBtn = document.getElementById('login')

registerBtn.addEventListener('click', () => {
    container.classList.add("active")
});
loginBtn.addEventListener('click', () => {
    container.classList.remove("active")
});


// Play the audio when the page is loaded
window.onload = function () {
    // Get the audio element
    var audio = document.getElementById("myAudio");

    
    audio.play();
};

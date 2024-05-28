// JavaScript code to play audio based on events
document.addEventListener('DOMContentLoaded', function() {
    // Play success audio when the registration message is shown
    if(document.contains(document.getElementById('successAudio'))) {
        document.getElementById('successAudio').play();
    }

    // Play wrong login audio when wrong login message is shown
    if(document.contains(document.getElementById('wrongLoginAudio'))) {
        document.getElementById('wrongLoginAudio').play();
    }
});


// Select the form element inside the element with the class "signup"
const form = document.querySelector(".signup form");

// Select the input element inside the button inside the form
const continueBtn = form.querySelector(".button input");

// Select the element with the class "error-text" inside the form
const errorText = form.querySelector(".error-text");

// Prevent the form from submitting normally (which would reload the page)
form.onsubmit = (e) => {
    e.preventDefault();
};

// Add an event listener to the continue button for when it is clicked
continueBtn.onclick = () => {
    // Create a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    // Configure it to make a POST request to "php/signup.php"
    xhr.open("POST", "php/signup.php", true);
    // Set up an event handler for when the request completes
    xhr.onload = () => {
        // Check if the request is complete
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // Check if the request was successful
            if (xhr.status === 200) {
                // Get the response from the server
                let data = xhr.response;
                // If the response is "success", redirect to "users.php"
                if (data === "success") {
                    location.href = "users.php";
                } else {
                    // Otherwise, display the error text and set its content to the response
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        }
    };
    // Create a FormData object from the form
    let formData = new FormData(form);
    // Send the form data with the request
    xhr.send(formData);
};

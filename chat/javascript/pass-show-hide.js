// Select the password input field inside the element with the class "form"
const pswrdField = document.querySelector(".form input[type='password']");

// Select the toggle icon inside the element with the class "form .field"
const toggleIcon = document.querySelector(".form .field i");

// Add an event listener to the toggle icon for when it is clicked
toggleIcon.onclick = () => {
    // Check if the password field type is "password"
    if (pswrdField.type === "password") {
        // Change the password field type to "text" to show the password
        pswrdField.type = "text";
        // Add the "active" class to the toggle icon
        toggleIcon.classList.add("active");
    } else {
        // Change the password field type back to "password" to hide the password
        pswrdField.type = "password";
        // Remove the "active" class from the toggle icon
        toggleIcon.classList.remove("active");
    }
};


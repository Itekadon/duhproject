// Select the form element with the class "typing-area"
const form = document.querySelector(".typing-area");

// Get the value of the input with the class "incoming_id" from the form
const incoming_id = form.querySelector(".incoming_id").value;

// Select the input field with the class "input-field" from the form
const inputField = form.querySelector(".input-field");

// Select the send button from the form
const sendBtn = form.querySelector("button");

// Select the chat box element with the class "chat-box"
const chatBox = document.querySelector(".chat-box");

// Prevent the form from submitting normally (which would reload the page)
form.onsubmit = (e) => {
    e.preventDefault();
};

// Focus on the input field when the page loads
inputField.focus();

// Add an event listener to the input field for when a key is released
inputField.onkeyup = () => {
    // If the input field is not empty, add the "active" class to the send button
    if (inputField.value != "") {
        sendBtn.classList.add("active");
    } else {
        // Otherwise, remove the "active" class from the send button
        sendBtn.classList.remove("active");
    }
};

// Add an event listener to the send button for when it is clicked
sendBtn.onclick = () => {
    // Create a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    // Configure it to make a POST request to "php/insert-chat.php"
    xhr.open("POST", "php/insert-chat.php", true);
    // Set up an event handler for when the request completes
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // If the request was successful, clear the input field
                inputField.value = "";
                // Scroll the chat box to the bottom
                scrollToBottom();
            }
        }
    };
    // Create a FormData object from the form
    let formData = new FormData(form);
    // Send the form data with the request
    xhr.send(formData);
};

// Add an event listener to the chat box for when the mouse enters
chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
};

// Add an event listener to the chat box for when the mouse leaves
chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
};

// Set up a function to repeatedly fetch new chat messages every 500 milliseconds
setInterval(() => {
    // Create a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();
    // Configure it to make a POST request to "php/get-chat.php"
    xhr.open("POST", "php/get-chat.php", true);
    // Set up an event handler for when the request completes
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // If the request was successful, update the chat box with the new messages
                let data = xhr.response;
                chatBox.innerHTML = data;
                // If the chat box does not have the "active" class, scroll it to the bottom
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    };
    // Set the request header for the type of content being sent
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Send the incoming_id with the request
    xhr.send("incoming_id=" + incoming_id);
}, 500);

// Function to scroll the chat box to the bottom
function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}

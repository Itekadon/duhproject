// Select the input field inside the element with the class "search"
const searchBar = document.querySelector(".search input");

// Select the button inside the element with the class "search"
const searchIcon = document.querySelector(".search button");

// Select the element with the class "users-list"
const usersList = document.querySelector(".users-list");

// Add an event listener to the search icon for when it is clicked
searchIcon.onclick = () => {
  // Toggle the "show" class on the search bar
  searchBar.classList.toggle("show");
  // Toggle the "active" class on the search icon
  searchIcon.classList.toggle("active");
  // Focus on the search bar
  searchBar.focus();
  // If the search bar has the "active" class
  if (searchBar.classList.contains("active")) {
    // Clear the search bar's value
    searchBar.value = "";
    // Remove the "active" class from the search bar
    searchBar.classList.remove("active");
  }
};

// Add an event listener to the search bar for when a key is released
searchBar.onkeyup = () => {
  // Get the value of the search bar
  let searchTerm = searchBar.value;
  // If the search term is not empty, add the "active" class to the search bar
  if (searchTerm != "") {
    searchBar.classList.add("active");
  } else {
    // Otherwise, remove the "active" class from the search bar
    searchBar.classList.remove("active");
  }
  // Create a new XMLHttpRequest object
  let xhr = new XMLHttpRequest();
  // Configure it to make a POST request to "php/search.php"
  xhr.open("POST", "php/search.php", true);
  // Set up an event handler for when the request completes
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Get the response from the server
        let data = xhr.response;
        // Update the users list with the response data
        usersList.innerHTML = data;
      }
    }
  };
  // Set the request header for the type of content being sent
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // Send the search term with the request
  xhr.send("searchTerm=" + searchTerm);
};

// Set up a function to repeatedly fetch the users list every 500 milliseconds
setInterval(() => {
  // Create a new XMLHttpRequest object
  let xhr = new XMLHttpRequest();
  // Configure it to make a GET request to "php/users.php"
  xhr.open("GET", "php/users.php", true);
  // Set up an event handler for when the request completes
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Get the response from the server
        let data = xhr.response;
        // If the search bar does not have the "active" class, update the users list with the response data
        if (!searchBar.classList.contains("active")) {
          usersList.innerHTML = data;
        }
      }
    }
  };
  // Send the request
  xhr.send();
}, 500);

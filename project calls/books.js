// let books = {
//     data:[
//     {
//         BookName: "Be The One",
//         category: "AVAILABLE OFFLINE",
//         fature: "Featured Books",
//         author: "Eileen Lamb",
//         image: "books/se the one.jpeg"
//     },
//     {
//         BookName: "A Gentle Reminder",
//         category: "AVAILABLE OFFLINE",
//         fature: "Featured Books",
//         author: "Eileen Lamb",
//         image: "books/se the one.jpeg"
//     },    
//     {
//         BookName: "The Mountain is You",
//         category: "AVAILABLE OFFLINE",
//         fature: "Featured Books",
//         author: "Eileen Lamb",
//         image: "books/se the one.jpeg"
//     },   
//     {
//         BookName: "Love notes to grievers",
//         category: "AVAILABLE OFFLINE",
//         fature: "Featured Books",
//         author: "Eileen Lamb",
//         image: "books/se the one.jpeg"
//     },  
//     {
//         BookName: "Be The One",
//         category: "AVAILABLE OFFLINE",
//         fature: "Featured Books", 
//         author: "Eileen Lamb",
//         image: "books/se the one.jpeg"
//     },
// ],
// }

// for(let i  of books.data){

//     let card= document.createElement("div")
//     card.classList.addd("card","i.category")

//     let imgcontainer = document.createElement("div")
//     imgcontainer.classList.add("image-container")

//     let image= document.createElement("img")
//     image.setAttribute("src",i.image)
//     imgcontainer.appendChild(image)
//     card.appendChild(imgcontainer)

//     document.getElementById("result-books").appendChild(card)
// }



document.addEventListener("DOMContentLoaded", function() {
    let authors = document.getElementsByClassName("writer");
    let bookNames = document.getElementsByClassName("name");
    let bookCards = document.getElementsByClassName("featured_book_box");
    let searchInput = document.getElementById("search");
    let button = document.getElementById("btn");

    function Search(event) {
        event.preventDefault(); // Prevent form submission
        let searchValue = searchInput.value.trim().toLowerCase();

        // Hide all books initially
        for (let i = 0; i < bookCards.length; i++) {
            bookCards[i].style.display = "none";
        }

        // Show only the matched books
        let matched = false;
        for (let i = 0; i < authors.length; i++) {
            if (authors[i].innerText.toLowerCase().includes(searchValue) ||
                bookNames[i].innerText.toLowerCase().includes(searchValue)) {
                bookCards[i].style.display = "flex";
                matched = true;
            }
        }

        if (!matched) {
            displayElement.innerHTML = "<p>No results found</p>";
        } else {
            displayElement.innerHTML = ""; // Clear previous 'No results found' message
        }
    }

    button.addEventListener("click", Search);
});
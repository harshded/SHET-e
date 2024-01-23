let card = document.querySelector(".card"); // declaring profile card element
let displayPicture = document.querySelector(".display-picture"); // declaring profile picture

displayPicture.addEventListener("click", function(event) {
    // Prevent the click event from propagating to the body
    event.stopPropagation();
    
    // Toggle the "hidden" class on the card element
    card.classList.toggle("hidden");
});

// Clicking anywhere on the body except the card should hide the card
document.body.addEventListener('click', function() {
 
    if (!card.classList.contains('hidden')) {
        
        card.classList.add("hidden");
    }
});

// Prevent clicks on the card from propagating to the body
// card.addEventListener('click', function(event) {
//     event.stopPropagation();
// });


   

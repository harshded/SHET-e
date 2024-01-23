// Initialize Stripe.js with your publishable key.
var stripe = Stripe('pk_test_6she4ZilKU5WblkGYSvGQC2L');

// Create an instance of Elements.
var elements = stripe.elements();

// Create an instance of the card Element.
var card = elements.create('card');

// Add an instance of the card Element into the `card-element` div.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    // Create a token from the card Element.
    stripe.createToken(card,{


        
    }).then(function(result) {
        if (result.error) {
            // Show error to your customer (e.g., insufficient funds, card expired).
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Token is created successfully. Send it to your server.
            stripeTokenHandler(result.token);
        }
    });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
    // Insert the token ID into the form as a hidden input.
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form.
    form.submit();
}

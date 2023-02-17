
// Create a Stripe client
var stripe = Stripe('pk_test_51M9mb6BlVQ0NJoLd98m5VVZlPMUpv4lcTXivXFxCRi2rdEctAO6QjaUCHZ7uQVkibyVB0Tg4braHm0koCQClRaGA00KYKbXOyd');
// Create an instance of Elements
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
        color: '#aab7c4'
    }
    },
    invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
    }
};
// Create an instance of the card Element
var card = elements.create('card', {
    style: style,
    hidePostalCode: true
});
// Add an instance of the card Element into the `card-element` <div>
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
// Handle form submission
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();
    // Disable the submit button to prevent repeated clicks
    document.getElementById('complete-order').disabled = true;
    var options = {
    name: document.getElementById('name_on_card').value,
    address_line1: document.getElementById('address').value,
    address_city: document.getElementById('city').value,
    address_state: document.getElementById('province').value,
    address_zip: document.getElementById('postalcode').value
    }
    stripe.createToken(card, options).then(function(result) {
    if (result.error) {
        // Inform the user if there was an error
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
        // Enable the submit button
        document.getElementById('complete-order').disabled = false;
    } else {
        // Send the token to your server
        stripeTokenHandler(result.token);
    }
    });
});

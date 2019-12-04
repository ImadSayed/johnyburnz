import {Spinner} from '../spin.js/spin.js';

// Set up Stripe.js and Elements to use in checkout form
const style = {
    base: {
        color: "#32325d",
    }
};


//spin.js
const target = document.getElementById('wait');
new Spinner({color:'#fff', lines: 12});
const spinner = new Spinner();//.spin();
//spinner.stop();

// Set your publishable key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
const stripe = Stripe('pk_test_3y61B1wRKH7h7ml7XyFJoMDk00lN7QqSRo');//development key: pk_test_3y61B1wRKH7h7ml7XyFJoMDk00lN7QqSRo
const elements = stripe.elements();


const submitButton = document.getElementById('btnSubmit');
const clientSecret = document.getElementById("client_secret").value;



const card = elements.create("card", {style: style});

card.mount("#card-element");



card.addEventListener('change', ({error}) => {
    const displayError = document.getElementById('card-errors');
    if (error) {
        displayError.textContent = error.message;
    } else {
        displayError.textContent = '';
    }
});


const form = $('#checkout-form');



submitButton.addEventListener('click', function(ev) {
    //stripe.confirmCardPayment(clientSecret, {
    //    payment_method: {card: card}
    //})
    spinner.spin(target);
    let resulta = process()

    .then(function(result) {
        spinner.stop();
        if (result.error) {
            document.getElementById("card-errors").innerText = result.error.message;
            document.getElementById("btnSubmit").disabled = false;
        } else {
            // The payment has been processed!
            if (result.paymentIntent.status === 'succeeded') {

                // Show a success message to your customer
                // There's a risk of the customer closing the window before callback
                // execution. Set up a webhook or plugin to listen for the
                // payment_intent.succeeded event that handles any business critical
                // post-payment actions.

                document.getElementById("checkout-form").submit();

            } else {
                $('#card-errors').innerText = 'Payment failed - please try again with another payment method';
                return false;
            }
        }
    });
});
async function process() {
    let a;
    document.getElementById("btnSubmit").disabled = true;
    a = await stripe.confirmCardPayment(clientSecret, {
        payment_method: {card: card}
    })
    return a;
}

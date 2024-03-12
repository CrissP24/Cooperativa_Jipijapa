document.addEventListener('DOMContentLoaded', function() {
    var stripe = Stripe('pk_test_51OtNBbLDKq4IBzHtAuOGZSQ7HbGDksI5ZH1ZcrsYO138rYVIfT82Ln4RZe8oX8YTvFzYPyhJA9IFequEHXr0Xz0X00BfZm7qOl');
    var elements = stripe.elements();

    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    cardElement.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var openModalButton = document.getElementById('open-modal');
    var modal = document.getElementById('payment-modal');
    var closeButton = document.getElementsByClassName('close')[0];

    openModalButton.onclick = function() {
        modal.style.display = 'block';
    };

    closeButton.onclick = function() {
        modal.style.display = 'none';
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(cardElement).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Aquí puedes enviar el token a tu servidor para procesar el pago
                console.log(result.token);
                alert('El pago se ha procesado exitosamente.');
            }
        });
    });
});

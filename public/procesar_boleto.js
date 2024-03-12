<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configurar la clave pública de Stripe
        var stripe = Stripe('pk_test_51OtNBbLDKq4IBzHtAuOGZSQ7HbGDksI5ZH1ZcrsYO138rYVIfT82Ln4RZe8oX8YTvFzYPyhJA9IFequEHXr0Xz0X00BfZm7qOl');

        // Configurar elementos de Stripe
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        // Manejar la sumisión del formulario
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Manejar errores de Stripe
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Envía el token al servidor
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Función para enviar el token al servidor
        function stripeTokenHandler(token) {
            // Agrega el token como un campo oculto al formulario
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Envía el formulario
            form.submit();
        }
    });
</script>

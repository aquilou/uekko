document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('hazte-uekko-reservation-form-no-map');
    const summarySection = document.getElementById('hazte-uekko-summary-section');
    const confirmationSection = document.getElementById('hazte-uekko-confirmation-section');

    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            
            // Obtener valores del formulario
            const name = document.getElementById('hazte_uekko_name').value;
            const phone = document.getElementById('hazte_uekko_phone').value;
            const email = document.getElementById('hazte_uekko_email').value;
            const zone = document.getElementById('hazte_uekko_zone').value;

            // Mostrar resumen
            document.getElementById('summary-name').innerText = name;
            document.getElementById('summary-phone').innerText = phone;
            document.getElementById('summary-email').innerText = email;
            document.getElementById('summary-zone').innerText = zone;

            form.style.display = 'none';
            summarySection.style.display = 'block';
        });

        document.getElementById('hazte-uekko-confirm-button').addEventListener('click', function () {
            summarySection.style.display = 'none';
            confirmationSection.style.display = 'block';

            // Aquí puedes añadir la lógica para enviar los datos al servidor si es necesario
        });
    }
});

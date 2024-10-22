document.getElementById('forgot-password-form').addEventListener('submit', async function (e) {
    e.preventDefault(); // Prevenir el envío del formulario por defecto

    const email = document.getElementById('email').value;
    const messageDiv = document.getElementById('message');

    try {
        const response = await fetch('/reset-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email }),
        });

        if (response.ok) {
            messageDiv.innerText = 'Se ha enviado un enlace a tu correo electrónico para restablecer la contraseña.';
        } else {
            const errorText = await response.text();
            messageDiv.innerText = `Error: ${errorText}`;
        }
    } catch (error) {
        messageDiv.innerText = 'Hubo un problema al enviar el correo. Por favor, inténtalo de nuevo más tarde.';
    }
});

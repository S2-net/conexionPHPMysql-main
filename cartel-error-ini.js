document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío del formulario
        const correo = document.querySelector('input[name="correo"]').value;
        const contrasenia = document.querySelector('input[name="contrasenia"]').value;
        const errorDiv = document.getElementById('errorMessages');
        const errorMessages = [];


        // Mostrar errores o enviar formulario
        if (errorMessages.length > 0) {
            errorDiv.innerHTML = errorMessages.join("<br>");
            errorDiv.style.display = 'block'; // Mostrar el mensaje de error
        } else {
            errorDiv.style.display = 'none'; // Ocultar el mensaje de error
            console.log('Enviando datos al servidor...'); // Verificación
            const formData = new FormData(this);

            fetch('RF_login_usr.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log(data); // Verificación de la respuesta
                if (data.status === 'error') {
                    errorDiv.innerHTML = data.message + "⚠️";
                    errorDiv.style.display = 'block';
                } else if (data.status === 'success') {
                    errorDiv.innerHTML = "Inicio de sesión exitoso.✔️";
                    errorDiv.style.display = 'block';
                    // Redirigir al usuario a la página principal
                    setTimeout(() => {
                        window.location.href = "index.php"; // Cambia esto según tu estructura
                    }, 1000); // Esperar un segundo antes de redirigir
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorDiv.innerHTML = "Hubo un problema en la solicitud.⚠️";
                errorDiv.style.display = 'block';
            });
        }
    });
});
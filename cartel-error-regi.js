document.addEventListener('DOMContentLoaded', function() { 
    document.getElementById('registroForm').addEventListener('submit', function(event) { 
        event.preventDefault(); // Prevenir el envío del formulario
        
        const nombre = document.getElementById('nombre').value;
        const apellido = document.getElementById('apellido').value;
        const correo = document.getElementById('correo').value;
        const fechaNacimiento = new Date(document.getElementById('fecha_nacimiento').value);
        const fechaActual = new Date();
        const edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear() - (fechaActual < new Date(fechaNacimiento.setFullYear(fechaNacimiento.getFullYear())) ? 1 : 0);
        const errorMessages = [];

        // Validar nombre y apellido
        if (!/^[a-zA-Z]+$/.test(nombre)) {
            errorMessages.push("El nombre debe contener solo letras.⚠️ ");
        }
        if (!/^[a-zA-Z]+$/.test(apellido)) {
            errorMessages.push("El apellido debe contener solo letras.⚠️");
        }

        // Validar correo
        const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        const hotmailRegex = /^[a-zA-Z0-9._%+-]+@hotmail\.com$/;
        if (!gmailRegex.test(correo) && !hotmailRegex.test(correo)) {
            errorMessages.push("El correo no es válido. Debe ser @gmail.com o @hotmail.com ⚠️");
        }

        // Validar edad
        if (edad < 0 || edad > 100) {
            errorMessages.push("Debes ser mayor de 18 años y menor de 100 años.⚠️");
        }

        // Mostrar errores o enviar formulario
        const errorDiv = document.getElementById('errorMessages');
        if (errorMessages.length > 0) {
            errorDiv.innerHTML = errorMessages.join("<br>");
            errorDiv.style.display = 'block'; // Mostrar el mensaje de error
        } else {
            errorDiv.style.display = 'none'; // Ocultar el mensaje de error

            // Envío del formulario
            const formData = new FormData(this);
            fetch('RF_registro_usr.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    errorDiv.innerHTML = data.message + "⚠️";
                    errorDiv.style.display = 'block';
                } else if (data.status === 'success') {
                    errorDiv.innerHTML = "Registro exitoso.✔️";
                    errorDiv.style.display = 'block';
                    
                    // Redirigir a la página iniregi.php después de un registro exitoso
                    setTimeout(() => {
                        window.location.href = 'iniregi.php';
                    }, 2000); // Redirigir después de 2 segundos (puedes ajustar el tiempo si lo prefieres)
                }
            })
            
            .catch(error => {
                errorDiv.innerHTML = "Hubo un problema en la solicitud.⚠️";
                errorDiv.style.display = 'block';
            });
        }
    });
});

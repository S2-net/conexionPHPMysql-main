const containerIR = document.getElementById('containerIR');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    containerIR.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    containerIR.classList.remove("active");
});

/* Mostrar/Ocultar contraseña en inicio de sesión */
var contador = true;

function vista() {
    var texto = document.getElementById("verPassword");
    var input = document.getElementById("input");

    if (contador === true) {
        texto.className = "fas fa-eye-slash verPassword";
        input.type = "text";
        contador = false;
    } else {
        texto.className = "fas fa-eye verPassword";
        input.type = "password";
        contador = true;
    }
}

document.querySelector("form").addEventListener("submit", function(event) {
    var nombre = document.getElementById("nombre").value;
    var apellido = document.getElementById("apellido").value;
    var errorMessage = "";
    var errorDiv = document.getElementById("error-message"); // El div donde se mostrará el error

    // Limpiar cualquier error anterior
    errorDiv.style.display = "none"; // Asegurarnos de ocultar cualquier mensaje anterior
    errorDiv.textContent = ""; // Limpiar el mensaje de error

    // Validación del nombre
    if (nombre.length > 50) {
        errorMessage += "El nombre no puede tener más de 50 caracteres.\n";
    }

    // Validación del apellido
    if (apellido.length > 50) {
        errorMessage += "El apellido no puede tener más de 50 caracteres.\n";
    }

    // Si hay errores, prevenir el envío del formulario y mostrar el mensaje
    if (errorMessage) {
        event.preventDefault(); // Detener el envío del formulario
        errorDiv.textContent = errorMessage; // Mostrar el mensaje de error
        errorDiv.style.display = "block"; // Asegurarnos de que el mensaje sea visible
    }
});



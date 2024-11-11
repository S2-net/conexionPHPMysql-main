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

document.getElementById("registroForm").addEventListener("submit", function(event) {
    event.preventDefault();  // Evitar que el formulario se envíe de forma tradicional

    // Obtener los valores del formulario
    const nombre = document.getElementById("nombre").value;
    const apellido = document.getElementById("apellido").value;
    const correo = document.getElementById("correo").value;
    const contrasenia = document.getElementById("contrasenia").value;
    const fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
    const genero = document.getElementById("genero").value;

    // Limpiar cualquier mensaje de error anterior
    const errorMessage = document.getElementById("error-message");
    errorMessage.style.display = "none";  // Ocultar el contenedor de error
    errorMessage.textContent = "";  // Limpiar el mensaje

    let errors = [];

    // Validación del nombre
    if (nombre.length > 50) {
        errors.push("El nombre no puede tener más de 50 caracteres.");
    }

    // Validación del apellido
    if (apellido.length > 50) {
        errors.push("El apellido no puede tener más de 50 caracteres.");
    }

    // Si hay errores, mostrar y detener el envío del formulario
    if (errors.length > 0) {
        errorMessage.style.color = "red";
        errorMessage.textContent = errors.join("\n");
        errorMessage.style.display = "block";
        return;
    }

    // Enviar los datos del formulario mediante fetch
    fetch("RF_registro_usr.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            nombre: nombre,
            apellido: apellido,
            correo: correo,
            contrasenia: contrasenia,
            fecha_nacimiento: fecha_nacimiento,
            genero: genero,
            register: true  // Indicar que es un registro
        })
    })
    .then(response => response.json())  // Esperamos respuesta JSON
    .then(data => {
        if (data.error) {
            // Mostrar el mensaje de error
            errorMessage.style.color = "red";
            errorMessage.textContent = data.error;
            errorMessage.style.display = "block";  // Mostrar el error
        } else if (data.success) {
            // Si el registro es exitoso, mostrar mensaje de éxito
            errorMessage.style.color = "green";
            errorMessage.textContent = "Registro exitoso!";
            errorMessage.style.display = "block";
            
            window.location.href = "iniregi.php"; 
        }
    })
    .catch(error => {
        console.error('Error:', error);
        errorMessage.style.color = "red";
        errorMessage.textContent = "Hubo un error en la comunicación con el servidor.";
        errorMessage.style.display = "block";
    });
});

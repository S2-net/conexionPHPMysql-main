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

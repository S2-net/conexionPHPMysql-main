const containerIR = document.getElementById('containerIR');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    containerIR.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    containerIR.classList.remove("active");
});

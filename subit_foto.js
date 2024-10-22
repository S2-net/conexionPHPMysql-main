// subir_foto.js
function subirFoto() {
    var input = document.getElementById('foto_perfil');
    var archivo = input.files[0];
    
    if (archivo) {
        var formData = new FormData();
        formData.append('foto_perfil', archivo);
        
        fetch('subir_foto_perfil.php', { // Asegúrate de que la ruta sea correcta
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Aquí puedes manejar la respuesta del servidor
            // Actualiza la imagen de perfil si es necesario
            // document.querySelector('.avatar-perfil img').src = 'ruta/a/la/nueva/imagen';
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}

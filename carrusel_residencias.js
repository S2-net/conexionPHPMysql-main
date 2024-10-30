document.getElementById("filterForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevenir recarga del formulario

    // Capturar los valores del formulario
    let formData = new FormData(this);

    // Agregar el ID de usuario a los datos del formulario
    formData.append("id_usuario", id_usuario);

    // Enviar datos mediante fetch a buscar_resi.php
    fetch("buscar-resi.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(html => {
        // Cargar el contenido recibido en el carrusel
        document.querySelector(".carousel-inner").innerHTML = html;
    })
    .catch(error => {
        console.error("Error en la búsqueda:", error);
    });
});

function guardarResidencia(id_residencia, id_usuario) {
    if (!id_usuario) { // Si no hay ID de usuario
        window.location.href = 'iniregi.php'; // Redirige a la página de inicio de sesión
        return;
    }

    fetch('guardar_residencia.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id_residencia: id_residencia, id_usuario: id_usuario }),
    })
    .then(response => response.json())
    .then(data => {
        const starElement = document.querySelector(`.star[data-residencia="${id_residencia}"]`);

        if (data.success) {
            if (data.action === 'saved') {
                starElement.classList.add('saved'); // Cambia a color dorado
                alert("Residencia guardada con éxito.");
            } else if (data.action === 'removed') {
                starElement.classList.remove('saved'); // Cambia a gris
                alert("Residencia eliminada de favoritos.");
            }
        } else if (data.error === 'no_session') {
            window.location.href = 'iniregi.php'; // Redirige si no está logueado
        } else {
            alert("Error al guardar la residencia: " + data.error);
        }
    })
    .catch((error) => {
        alert("Error: " + error);
    });
}

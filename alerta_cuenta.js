function borrarCuenta() { 
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, ¡elimínalo!",
        cancelButtonText: "Cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Realiza la solicitud para eliminar la cuenta
            fetch('eliminar_regi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                return response.text(); // Cambiar a text() para ver el contenido
            })
            .then(data => {
                console.log(data); // Mostrar el contenido en la consola
                try {
                    const jsonData = JSON.parse(data); // Intentar parsear el JSON
                    // Verifica si la respuesta tiene un mensaje
                    if (jsonData.message) {
                        swalWithBootstrapButtons.fire({
                            title: "¡Eliminado!",
                            text: jsonData.message,
                            icon: "success"
                        }).then(() => {
                            // Redirigir a index.php después de que se cierre la alerta
                            window.location.href = 'index.php';
                        });
                        }

                } catch (e) {
                    console.error('Error al parsear JSON:', e);
                    swalWithBootstrapButtons.fire({
                        title: "Error",
                        text: "La respuesta del servidor no es válida.",
                        icon: "error"
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                swalWithBootstrapButtons.fire({
                    title: "Error",
                    text: error.message,
                    icon: "error"
                });
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "Tu cuenta permanece segura :)",
                icon: "error"
            });
        }
    });
}

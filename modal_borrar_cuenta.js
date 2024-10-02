function abrirModal(modalId) {
    // Abre el modal que corresponde
    document.getElementById(`modal${modalId}`).style.display = "block";
}

function cerrarModal(modalId) {
    // Cierra el modal que corresponde
    document.getElementById(`modal${modalId}`).style.display = "none";
}
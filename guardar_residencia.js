function guardarResidencia(id_residencia, id_usuario) {
    console.log("ID Residencia:", id_residencia, "ID Usuario:", id_usuario); 
    if (id_usuario === undefined) {
alert("ID de usuario no está definido.");
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
if (data.success) {
    alert("Residencia guardada con éxito.");
} else {
    alert("Error al guardar la residencia: " + data.error);
}
})
.catch((error) => {
alert("Error: " + error);
});
}
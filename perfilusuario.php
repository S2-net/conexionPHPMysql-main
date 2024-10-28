<?php
require("datos_perfil.php"); 
require_once("conexion.php");

$con = conectar_bd(); // Conectar a la base de datos

$id_usuario = $_SESSION['id_usuario']; // Asegúrate de que el ID del usuario esté disponible

// Consulta para obtener los datos del usuario
$stmt = $con->prepare("SELECT nombre, apellido, correo, genero, fecha_nacimiento FROM usuario WHERE id_usuario = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result_usuario = $stmt->get_result();

if ($result_usuario->num_rows > 0) {
    $usuario = $result_usuario->fetch_assoc();
    $nombre = $usuario['nombre'];
    $apellido = $usuario['apellido'];
    $correo = $usuario['correo'];
    $genero = $usuario['genero'];
    $fecha_nacimiento = $usuario['fecha_nacimiento'];
} else {
    // Manejar el caso en que no se encontró el usuario
    echo "Usuario no encontrado.";
    exit();
}

// Consulta para obtener las residencias favoritas
$stmt = $con->prepare("SELECT r.* FROM favoritos f JOIN residencia r ON f.id_residencia = r.id_residencia WHERE f.id_usuario = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result_favoritos = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        margin: 15% auto;
        width: 50%;
        pointer-events: auto;
        background-color: #004aad;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: .3rem;
        outline: 0;
        padding: 10px;
    }
    .modal-content h1 label {
        color: white;
    }
</style>
<body>
<section class="perfil-usuario">
    <div class="contendor-perfil">
        <div class="portada-perfil" style="background-image: url(http://localhost/conexionPHPMysql-main/images/resi4.jpeg);">
            <a href="index.php" class="botonperfil">
                <i class="fas fa-home"></i> Inicio
            </a>
            <div class="avatar-perfil">
                <?php if (!empty($foto)): ?>
                    <img src="<?php echo $foto; ?>" alt="Foto de perfil">
                <?php else: ?>
                    <img src="http://localhost/conexionPHPMysql-main/images/user.png" alt="Usuario predeterminado" style="max-width: 150px; max-height: 150px;">
                <?php endif; ?>
                <form action="subir_foto.php" method="POST" enctype="multipart/form-data" style="display: inline;">
                    <input type="file" name="foto" accept="image/*" required id="input-foto" style="display: none;">
                    <button type="button" class="cambiar-foto" id="cambiar-foto">Cambiar Foto</button>
                    <button type="submit" style="display: none;" id="submit-foto">Subir Foto</button>
                </form>
            </div>
            <script>
                document.getElementById('cambiar-foto').addEventListener('click', function() {
                    document.getElementById('input-foto').click(); // Abre el explorador de archivos
                });

                document.getElementById('input-foto').addEventListener('change', function() {
                    if (this.files.length > 0) {
                        document.getElementById('submit-foto').click(); // Simula el clic en el botón de envío
                    }
                });
            </script>
        </div>
    </div>
</section>

<div class="nombreusu1">
    <h1> <?php echo $nombre . ' ' . $apellido; ?></h1>
</div>

<div class="propi">
    <p> <?php echo $correo; ?></p>
    <button type="button" onclick="abrirModalll()"><i class="fas fa-user" style="padding: 5px;"></i>Mi perfil</button>
</div>

<div class="propietario">
    <p><strong>ESTUDIANTE</strong></p>
</div>

<div class="tony">



<section class="cambiar-contrasena">
    <!-- Modal para cambiar la contraseña -->
    <div id="perfilModal" class="modal">
        <div class="datosresi1">
            <span class="close cerrar" onclick="cerrarModalll(1)">&times;</span>

            <div class="nombreusu">
                <h1> <?php echo $nombre . ' ' . $apellido; ?></h1>
                <hr>
                <p> Correo: <?php echo $correo; ?></p>
                <hr>
                <p>Contraseña: <button type="button" onclick="abrirModal()" class="cambiar-btn">Cambiar Contraseña</button></p>
                <hr>
                <p>Género: <?php echo $genero; ?></p>
                <hr>
                <p>Fecha de Nacimiento: <?php echo $fecha_nacimiento; ?></p>
            </div>

            <button class="button" type="button" onclick="borrarCuenta()">
                <span class="button__text">Borrar Cuenta</span>
                <span class="button__icon">
                    <svg class="svg" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                        <title></title>
                        <path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                        <line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432" y1="112" y2="112"></line>
                        <path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                        <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256" x2="256" y1="176" y2="400"></line>
                        <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184" x2="192" y1="176" y2="400"></line>
                        <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328" x2="320" y1="176" y2="400"></line>
                    </svg>
                </span>
            </button>
        </div>
    </div>
</section>
</div>

<hr style="background-color: #c4c4c4;">

<<div class="datosresi2">
    <h1>Residencias Favoritas</h1>
    <?php if ($result_favoritos && $result_favoritos->num_rows > 0): ?>
        <div class="flex-container">
            <?php while ($row = $result_favoritos->fetch_assoc()): ?>
                <div class="flex-item">
                    <h3>Nombre: <?php echo htmlspecialchars($row['nombreresi'] ?? 'Nombre no disponible'); ?></h3>
                    <p><?php echo htmlspecialchars($row['descripcion'] ?? 'Descripción no disponible'); ?></p>
                    <a href="residencia.php?id_residencia=<?php echo $row['id_residencia']; ?>" class="btn btn-primary">Ver Residencia</a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No hay residencias favoritas.</p>
    <?php endif; ?>
</div>


<!-- Resto del código de tu página -->

<script src="alerta_cuenta.js"></script>
<script src="modal_cambiar_contrasena.js"></script>
<script src="modal_editar_resi.js"></script>
<script src="modal_perfil.js"></script>

</body>
</html>

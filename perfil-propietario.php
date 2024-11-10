<?php
session_start();  // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Redirige a la página de inicio de sesión si no está logueado
    header("Location: iniregi.php");
    exit();
}

require("datos_perfil_propietario.php");  // Incluye los datos del perfil
require_once("conexion.php");  // Asegúrate de que la conexión a la base de datos se incluya aquí

// Llama a la función de conexión para obtener $conn
$conn = conectar_bd();  // Establece la conexión a la base de datos

// Verifica que la conexión haya sido exitosa
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
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
    
    .close:hover{
        cursor: pointer;
        color: red;
    }
    
    .modal-content h1 label {
        color: white;
    }
    .consupadre{
        gap: 10px;
        
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

        <p> <?php echo $correo; ?></p>
    
        <p><strong>PROPIETARIO</strong></p>
    
        <button type="button" onclick="abrirModalll()"><i class="fas fa-user" style="padding: 5px;"></i>Mi perfil</button>
    </div>
    <hr>
    
    
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
                        <hr>
                        <p>ID Residencia: <?php echo $id_residencia; ?></p>
                        <hr>
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
    
    <section class="cambiar-contrasena">
        <!-- Modal para cambiar la contraseña -->
        <div id="contrasenaModal" class="modal">
            <div class="modal-content">
                <span class="close cerrar" onclick="cerrarModal(1)">&times;</span>
                <h2 style="color: white;">Cambiar Contraseña</h2>
                <hr style="background-color: white;">
                <form action="cambiar_contrasena.php" method="POST">
                    <label for="contrasena_actual" style="color: white;">Contraseña Actual:</label>
                    <input type="password" id="contrasena_actual" name="contrasena_actual" required>
                    <br>
                    <label for="nueva_contrasena" style="color: white;">Nueva Contraseña:</label>
                    <input type="password" id="nueva_contrasena" name="nueva_contrasena" required minlength="8">
                    <br>
                    <label for="confirmar_contrasena" style="color: white;">Confirmar Nueva Contraseña:</label>
                    <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required minlength="8">
                    <br>
                    <button type="submit" name="cambiar_contrasena" class="cambiar-btn">Cambiar Contraseña</button>
                </form>
            </div>
        </div>
    </section>
    <div class="consupadre">
    <div class="datosresi2">

        <?php if (isset($mensaje)) : ?>
            <p><?php echo $mensaje; ?></p>
        <?php else : ?>

            <h1>Nombre de la residencia: <?php echo $nombreresi; ?></h1>
            <br>
            <p>Tipo de residencia: <?php echo $tipoo; ?></p>
            <p>Precio: $<?php echo $precio; ?></p>
            <p>Cantidad de Dormitorios: <?php echo $disponibilidad; ?></p>
            <p>Normas de convivencia: <?php echo $normas; ?> </p>
            <p>Numero de baños: <?php echo $banios; ?></p>
            <p>Detalles: <?php echo $detalles; ?></p>
            <p>Descripción: <?php echo $descripcion; ?></p>
            <div class="boton-container">
                <button onclick="borrarResidencia(<?php echo $id_residencia; ?>)" class="btn btn-danger">Eliminar Residencia</button>
                <button onclick="abrirModall()" class="btn btn-success">Editar Residencia</button>
            </div>

        <?php endif; ?>

        <!-- Modal para editar residencia -->
        <div id="editResidenciaModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="cerrarModall(1)">&times;</span>
                <h1 style="color: white;">Editar Residencia</h1>
                <form id="editResidenciaForm" action="editar_residencia.php" method="POST">
                    <input type="hidden" id="edit_id_residencia" name="id_residencia" value="<?php echo $id_residencia; ?>">

                    <label for="edit_nombreresi" style="color: white;">Nombre de la Residencia:</label>
                    <input type="text" id="edit_nombreresi" name="nombreresi" value="<?php echo $nombreresi; ?>" required>
                    <br>

                    <label for="edit_tipo" style="color: white;">Tipo de residencia:</label>
                    <select name="tipo" id="tipo" name="tipo" required>
                        <option value="1">Masculina</option>
                        <option value="2">Femenina</option>
                        <option value="3">Mixta</option>
                    </select>
                    <br>

                    <label for="edit_descripcion" style="color: white;">Descripción:</label>
                    <textarea id="edit_descripcion" name="descripcion" required><?php echo $descripcion; ?></textarea>
                    <br>

                    <label for="edit_precio" style="color: white;">Precio:</label>
                    <input type="number" id="edit_precio" name="precio" value="<?php echo $precio; ?>" required>
                    <br>

                    <label for="edit_normas" style="color: white;">Normas:</label>
                    <textarea id="edit_normas" name="normas" required><?php echo $normas; ?></textarea>
                    <br>

                    <label for="edit_banios" style="color: white;">Número de Baños:</label>
                    <input type="number" id="edit_banios" name="banios" value="<?php echo $banios; ?>" required>
                    <br>

                    <label for="edit_detalles" style="color: white;">Detalles de la Habitación:</label>
                    <input type="text" id="edit_detalles" name="detalles" value="<?php echo $detalles; ?>" required>
                    <br>

                    <label for="edit_disponibilidad" style="color: white;">Disponibilidad:</label>
                    <input type="number" id="edit_disponibilidad" name="disponibilidad" value="<?php echo $disponibilidad; ?>" required>
                    <br>

                    <button type="submit">Guardar Cambios</button>
                </form>
            </div>

        </div>

    </div>

    <div class="datosresi4">
    <p>Consultas</p>
    <?php
    // Verifica que la conexión sea válida
    if ($conn) {
        // Obtén el ID del propietario desde la sesión
        $id_usuario = $_SESSION['id_usuario'];

        // Consulta las consultas del propietario
        $sql = "SELECT id, nombre, email, mensaje, fecha FROM consultas WHERE id_usuario = ?";

        // Intenta preparar la consulta
        $stmt = $conn->prepare($sql);

        // Si la preparación falla, muestra el error de MySQL
        if ($stmt === false) {
            // Muestra el error de la consulta
            die("Error al preparar la consulta: " . $conn->error);
        }

        // Vincula el parámetro
        $stmt->bind_param("i", $id_usuario);  // Asegúrate de que $id_usuario sea un entero

        // Ejecuta la consulta
        $stmt->execute();
        $result = $stmt->get_result();

        // Mostrar las consultas si existen
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='consulta'>";
                echo "<p><strong>Nombre:</strong> " . htmlspecialchars($row['nombre']) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
                echo "<p><strong>Mensaje:</strong> " . nl2br(htmlspecialchars($row['mensaje'])) . "</p>";
                echo "<p><small><strong>Fecha:</strong> " . htmlspecialchars($row['fecha']) . "</small></p>";

                // Botón para borrar la consulta
                echo "<form method='POST' action='borrar_consulta.php'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<button type='submit' class='btn btn-danger'>Cerrar Consulta</button>";
                echo "</form>";

                echo "</div><hr>";
            }
        } else {
            echo "<p>No hay consultas disponibles.</p>";
        }
    } else {
        echo "<p>Error en la conexión a la base de datos.</p>";
    }
    ?>
</div>
</div>
</div>


    <script src="alerta_cuenta.js"></script>
    <script src="borrar_residencia.js"></script>
    <script src="modal_cambiar_contrasena.js"></script>
    <script src="modal_editar_resi.js"></script>
    <script src="modal_perfil.js"></script>



</body>


</html>
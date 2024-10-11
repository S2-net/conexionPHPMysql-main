<?php 
    // Incluyo el archivo de conexión
    require("conexion.php");

    // Conexión a la base de datos
    $con = conectar_bd();

    // Consulta para obtener los datos de todos los usuarios
    $consulta = "SELECT u.id_usuario, u.nombre, u.apellido, u.correo, 
    CASE 
       WHEN a.id_admin IS NOT NULL THEN 'Administrador'
       WHEN p.id_propietario IS NOT NULL THEN 'Propietario'
       WHEN e.id_estudiante IS NOT NULL THEN 'Estudiante'
       ELSE 'Sin tipo'
    END AS tipo_usuario
    FROM usuario u
    LEFT JOIN admin a ON u.id_usuario = a.id_admin
    LEFT JOIN propietario p ON u.id_usuario = p.id_propietario
    LEFT JOIN estudiante e ON u.id_usuario = e.id_estudiante";


    $resultado = mysqli_query($con, $consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuarios</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

    <h2>Panel de Usuarios</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Tipo de Usuario</th>
            <th>Modificar Tipo</th>
        </tr>
        
        <?php
            // Verificar si hay resultados
            if (mysqli_num_rows($resultado) > 0) {
                // Recorrer cada fila de la tabla y mostrar los datos en una fila de la tabla HTML
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_usuario'] . "</td>";
                    echo "<td>" . $fila['nombre'] . "</td>";
                    echo "<td>" . $fila['apellido'] . "</td>";
                    echo "<td>" . $fila['correo'] . "</td>";
                    echo "<td>" . $fila['tipo_usuario'] . "</td>";
                    echo "<td>
                        <form action='editar_usuario.php' method='POST'>
                            <input type='hidden' name='id_usuario' value='" . $fila['id_usuario'] . "'>
                            <select name='tipo_usuario'>
                                <option value='Administrador'" . ($fila['tipo_usuario'] == 'Administrador' ? ' selected' : '') . ">Administrador</option>
                                <option value='Propietario'" . ($fila['tipo_usuario'] == 'Propietario' ? ' selected' : '') . ">Propietario</option>
                                <option value='Estudiante'" . ($fila['tipo_usuario'] == 'Estudiante' ? ' selected' : '') . ">Estudiante</option>
                            </select>
                            <button type='submit'>Modificar</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay usuarios registrados</td></tr>";
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($con);
        ?>
    </table>

</body>
</html>

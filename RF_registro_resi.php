    <?php

    require("conexion.php");

    $con = conectar_bd();

    // Comprobar que se envió un formulario por POST desde carga_datos
    if (isset($_POST["envio"])) {

        $nombreresi = $_POST["nombreresi"];
        $normas = $_POST["normas"];
        $precio = $_POST["precio"];
        $descripcion =$_POST["descripcion"];
        $disponibilidad = $_POST["disponibilidad"];
        $banios = $_POST ["banios"];
        $detalles = $_POST["detalles"];
    
        // Consultar si la residencia ya existe
        $existe_resi = consultar_existe_resi($con, $nombreresi);

        // Insertar datos si la residencia no existe
        insertar_datos($con, $precio, $nombreresi, $normas, $descripcion, $disponibilidad, $banios, $detalles, $existe_resi);

    }

    function consultar_existe_resi($con, $nombreresi) {
        $consulta = "SELECT * FROM residencia WHERE nombreresi = '$nombreresi'";
        $resultado = mysqli_query($con, $consulta);

        // Si existe al menos un registro, significa que la residencia ya existe
        return mysqli_num_rows($resultado) > 0;
    }


    function consultar_datos($con) {
        $consulta_residencia = "SELECT * FROM residencia";
        $consulta_habitaciones = "SELECT * FROM habitaciones";
        
        $resultado_residencia = mysqli_query($con, $consulta_residencia);
        $resultado_habitaciones = mysqli_query($con, $consulta_habitaciones);
    
        // Verificar que las consultas fueron exitosas
        if ($resultado_residencia === false || $resultado_habitaciones === false) {
            echo "Error en la consulta: " . mysqli_error($con);
            return;
        }
    
        $salida = "";
    
        if (mysqli_num_rows($resultado_residencia) > 0) {
            while (($fila = mysqli_fetch_assoc($resultado_residencia)) && ($filaa = mysqli_fetch_assoc($resultado_habitaciones))) {
                $salida .= "id: " . $fila["id_residencia"] . " - Nombre: " . $fila["nombreresi"] . " - Normas: " . $fila["normas"] . " - Precio: " . $fila["precio"] . " - Descripcion: " . $fila["descripcion"] . " - Numero de habitaciones: " . $filaa["disponibilidad"] . " - Cantidad de Baños: " . $filaa["banios"] . " - Detalle: " . $filaa["detalles"] ."<br> <hr>";
            }
        } else {
            $salida = "Sin datos";
        }
    
        return $salida;
    }
    
        

    function insertar_datos($con, $precio, $nombreresi, $normas, $disponibilidad, $banios, $detalles, $existe_resi) {
        if ($existe_resi == false) {
            
            $insertar_residencia = "INSERT INTO residencia (precio, normas, nombreresi, descripcion) VALUES ('$precio', '$normas', '$nombreresi', 'descripcion')";
            $insertar_habitaciones = "INSERT INTO habitaciones(disponibilidad, banios, detalles) VALUES ('$disponibilidad', '$banios', '$detalles')";
    
            if (mysqli_query($con, $insertar_habitaciones) && mysqli_query($con, $insertar_residencia)) {
                $salida = consultar_datos($con);
                echo $salida;
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Ya existe una residencia con este nombre.";
        }
    }
    

    mysqli_close($con);

    <?php

    require("conexion.php");

    $con = conectar_bd();

    // Comprobar que se envió un formulario por POST desde carga_datos
    if (isset($_POST["envio"])) {

        $nombreresi = $_POST["nombreresi"];
        $normas = $_POST["normas"];
        $precio = $_POST["precio"];
        $disponibilidad = $_POST["disponibilidad"];
    
        // Consultar si la residencia ya existe
        $existe_resi = consultar_existe_resi($con, $nombreresi);

        // Insertar datos si la residencia no existe
        insertar_datos($con, $precio, $nombreresi, $normas, $disponibilidad, $existe_resi);

    }

    function consultar_existe_resi($con, $nombreresi) {
        $consulta = "SELECT * FROM residencia WHERE nombreresi = '$nombreresi'";
        $resultado = mysqli_query($con, $consulta);

        // Si existe al menos un registro, significa que la residencia ya existe
        return mysqli_num_rows($resultado) > 0;
    }


        function consultar_datos($con) {
            $consulta_residencia = "SELECT * FROM residencia";
            $resultado_residencia = mysqli_query($con, $consulta_residencia);
            
            $salida = "";
        
            if (mysqli_num_rows($resultado_residencia) > 0) {
                while ($fila = mysqli_fetch_assoc($resultado_residencia)) {
                    $salida .= "id: " . $fila["id_residencia"] . " - Nombre: " . $fila["nombreresi"] . " - Normas: " . $fila["normas"] . " - Precio: " . $fila["precio"] . " - Cantidad de habitaciones: " . $fila["disponibilidad"] . "<br> <hr>";
                }
            } else {
                $salida = "Sin datos";
            }
        
            return $salida;
        }
        

    function insertar_datos($con, $precio, $nombreresi, $normas, $disponibilidad, $existe_resi) {
        if ($existe_resi == false) {
            $insertar_habitaciones = "INSERT INTO habitaciones(disponibilidad) VALUES ('$disponibilidad')";
            $insertar_residencia = "INSERT INTO residencia (precio, normas, nombreresi) VALUES ('$precio', '$normas', '$nombreresi')";
    
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

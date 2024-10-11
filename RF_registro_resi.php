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
        insertar_residencia($con, $precio, $nombreresi, $normas, $descripcion, $existe_resi);

    }

    function consultar_existe_resi($con, $nombreresi) {
        $consulta = "SELECT * FROM residencia WHERE nombreresi = '$nombreresi'";
        $resultado = mysqli_query($con, $consulta);

        // Si existe al menos un registro, significa que la residencia ya existe
        return mysqli_num_rows($resultado) > 0;
    }

    
        

    function insertar_residencia($con, $precio, $nombreresi, $normas, $descripcion, $existe_resi) {
        if ($existe_resi == false) {
            
            $insertar_residencia = "INSERT INTO residencia (precio, normas, nombreresi, descripcion) VALUES ('$precio', '$normas', '$nombreresi', '$descripcion')";
    
            if (mysqli_query($con, $insertar_residencia)) {
                header("Location: residencia.php");
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Ya existe una residencia con este nombre.";
        }
    }

    function insertar_habitaciones($con, $banios, $detalles, $disponibilidad, $descripcion, $existe_resi) {
        if ($existe_resi == false) {
            
            $insertar_habitaciones = "INSERT INTO habitaciones(disponibilidad, banios, detalles) VALUES ('$disponibilidad', '$banios', '$detalles')";
    
            if (mysqli_query($con, $insertar_habitaciones)) {
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

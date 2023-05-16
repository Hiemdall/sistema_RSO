<?php
// Llamar a el archivo conexion.php para hacer la conexion a la base de datos
include("conexion.php");


// Obtener los valores del formulario
$datos_empresa = $_POST['empresa'];
$sede = $_POST['sede'];
$departamento = $_POST['departamento'];
$nombre = $_POST['nom_tec'];
$nom_usuario = $_POST['nom_usuario'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$serial = $_POST['serial'];
$activo_fijo = $_POST['activo_fijo'];
$tipo_equipo = $_POST['tipo_equipo'];
$modelo = $_POST['modelo'];
$fabricante = $_POST['fabricante'];
$nom_equipo = $_POST['nom_equipo'];
$nom_procesador = $_POST['nom_procesador'];
$ram = $_POST['ram'];
$slot = $_POST['slot'];
$puntero = $_POST['puntero'];
$capacidad = $_POST['capacidad'];


// Insertar los valores en la tabla datos_empresa
$sql_datos_empresa = "INSERT INTO datos(empresa, sede, departamento, nombre, nom_usuario, fecha, hora, serial, activo_fijo, tipo_equipo, modelo, fabricante, nom_equipo, nom_procesador, ram, slot) 
VALUES ('$datos_empresa', '$sede', '$departamento', '$nombre', '$nom_usuario', '$fecha', '$hora', '$serial', '$activo_fijo', '$tipo_equipo', '$modelo', '$fabricante', '$nom_equipo', '$nom_procesador', '$ram', '$slot')";

if ($conn->query($sql_datos_empresa) === TRUE) {
    // Obtener el ID del último registro insertado en datos_empresa
    $datos_empresa_id = $conn->insert_id;
    
    // Insertar los valores en la tabla disco
    $sql_disco = "INSERT INTO disco (puntero, capacidad, serial_id) VALUES ('$puntero', '$capacidad', '$serial')";
    
    if ($conn->query($sql_disco) === TRUE) {
        // Generar una alerta
         $mensaje = "Ficha técnica guardada correctamente";
         echo '<script>alert("'. $mensaje . '");</script>';
        // echo "Ficha técnica guardada correctamente";
    } else {
        echo "Error al guardar la ficha técnica en la tabla disco: " . $conn->error;
    }
} else {
    echo "Error al guardar la ficha técnica en la tabla datos_empresa: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

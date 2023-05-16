<?php
// Conexión local
include("conexion.php");

/* Obtener el valor del parámetro "input" enviado a través de una solicitud POST.
   Asignar el valor a la variable $serial para su posterior procesamiento. */
$serial = $_POST["input"];

// Consulta en la tabla "datos"
$sql_datos = "SELECT empresa, sede, departamento
FROM datos WHERE serial = '$serial'";

// Consulta en la base de historial
$sql_historial = "SELECT empresa, sede, departamento, fecha, hora, tipo_mant, observacion, recomendaciones, nom_tec
FROM historial WHERE serial = '$serial'";

// Ejecutar la consulta en la tabla "datos"
$result_datos = mysqli_query($conn, $sql_datos);

// Ejecutar la consulta en la tabla "disco"
$result_historial = mysqli_query($conn, $sql_historial);

if (mysqli_num_rows($result_datos) > 0 && mysqli_num_rows($result_historial) > 0) {
    $row_datos = mysqli_fetch_assoc($result_datos);
    $row_historial = mysqli_fetch_assoc($result_historial);
    //Variable   ->     Campo (BD)
        $empresa = $row_datos["empresa"];
        $sede = $row_datos["sede"];
        $departamento = $row_datos["departamento"];
        
        $fecha = $row_historial["fecha"];
        $hora = $row_historial["hora"];
        $tipo_mant = $row_historial["tipo_mant"];
        $observacion = $row_historial["observacion"];
        $recomendaciones = $row_historial["recomendaciones"];
        $nom_tec = $row_historial["nom_tec"];
        
    // "name del input formulario  -> Variable que contiene el campo de la base de datos"
    // "name del input  -> Variable que contiene el campo de la base de datos"
    $data = array(
        "exists" => true,
        "empresa" => $empresa,
        "sede" => $sede,
        "departamento" => $departamento,
        "fecha" => $fecha,
        "hora" => $hora,
        "tipo_mant" => $tipo_mant,
        "observacion" => $observacion,
        "recomendaciones" => $recomendaciones,
        "nom_tec" => $nom_tec,
        
    );
    
    echo json_encode($data);
    // echo "El valor ingresado existe en la base de datos";
   
} else {
    //Coloca vacio los input
    //echo json_encode(array("exists" => true, "empresa" => "","sede" => "", "departamento" => "","nom_usuario" => "","fecha" => "","hora" => ""));
    
    date_default_timezone_set('America/Bogota');
    $fecha_actual = date('d/m/Y');
    $hora_actual = date('H:i:s A');

    $data = array(
       "exists" => true,
       "empresa" => "",
       "sede" => "",
       "departamento" => "",
       "fecha" => ($fecha_actual != "") ? $fecha_actual : date("Y-m-d"),
       "hora" => ($hora_actual != "") ? $hora_actual : date("H:i:s"),
       "tipo_mant" => "",
       "observacion" => "",
       "recomendaciones" => "",
       "nom_tec" => "",
       
       
    );
    echo json_encode($data);
    //echo "El valor ingresado no existe en la base de datos";
}

$conn->close();
?>
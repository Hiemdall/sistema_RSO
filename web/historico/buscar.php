<?php
// Conexión local
include("conexion.php");

/* Obtener el valor del parámetro "input" enviado a través de una solicitud POST.
   Asignar el valor a la variable $serial para su posterior procesamiento. */
$serial = $_POST["input"];

// Consulta en la tabla "datos"
$sql = "SELECT empresa, sede, departamento
FROM datos WHERE serial = '$serial'";

//Con una sola tabla
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    //Variable   ->     Campo (BD)
        $empresa = $row["empresa"];
        $sede = $row["sede"];
        $departamento = $row["departamento"];
        
        
    // "name del input formulario  -> Variable que contiene el campo de la base de datos"
    // "name del input  -> Variable que contiene el campo de la base de datos"
    $data = array(
        "exists" => true,
        "empresa" => $empresa,
        "sede" => $sede,
        "departamento" => $departamento,
                
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
             
       
    );
    echo json_encode($data);
    //echo "El valor ingresado no existe en la base de datos";
}

$conn->close();
?>
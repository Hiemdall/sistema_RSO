<?php
// Conexión local
include("conexion.php");

/* Obtener el valor del parámetro "input" enviado a través de una solicitud POST.
   Asignar el valor a la variable $serial para su posterior procesamiento. */
$serial = $_POST["input"];

// Consulta en la base de datos
$sql_datos = "SELECT empresa, sede, departamento, nom_usuario, fecha, hora, tipo_equipo, activo_fijo, modelo, fabricante, nom_equipo, nom_procesador, ram, slot, nombre, ip_equipo ,componentes_add
FROM datos WHERE serial = '$serial'";

// Consulta en la tabla "disco"
$sql_disco = "SELECT puntero, capacidad, serial_id
FROM disco WHERE serial_id = '$serial'";

//Con una sola tabla
//$result = mysqli_query($conn, $sql);
//if (mysqli_num_rows($result) > 0) {
    //$row = mysqli_fetch_assoc($result);

// Ejecutar la consulta en la tabla "datos"
$result_datos = mysqli_query($conn, $sql_datos);

// Ejecutar la consulta en la tabla "disco"
$result_disco = mysqli_query($conn, $sql_disco);

if (mysqli_num_rows($result_datos) > 0 && mysqli_num_rows($result_disco) > 0) {
    $row_datos = mysqli_fetch_assoc($result_datos);
    $row_disco = mysqli_fetch_assoc($result_disco);

    //Variable   ->     Campo (BD)
        $empresa = $row_datos["empresa"];
        $sede = $row_datos["sede"];
        $departamento = $row_datos["departamento"];
        $nom_usuario = $row_datos["nom_usuario"];
        $fecha = $row_datos["fecha"];
        $hora = $row_datos["hora"];
        $tipo_equipo = $row_datos["tipo_equipo"];
        $activo_fijo = $row_datos["activo_fijo"];
        $ip_equipo = $row_datos["ip_equipo"];
        $modelo = $row_datos["modelo"];
        $fabricante = $row_datos["fabricante"];
        $nom_equipo = $row_datos["nom_equipo"];
        $nom_procesador = $row_datos["nom_procesador"];
        $ram = $row_datos["ram"];
        $slot = $row_datos["slot"];
        $nombre = $row_datos["nombre"];
        $componentes_add = $row_datos["componentes_add"];

        // Variables de la tabla "disco"
        $puntero = $row_disco["puntero"];
        $capacidad = $row_disco["capacidad"];
        
                  
    // "name del input formulario  -> Variable que contiene el campo de la base de datos"
    //echo json_encode(array("exists" => true, "empresa" => $empresa,"sede" => $sede, "departamento" => $departamento, "nom_usuario" => $nom_usuario, "fecha" => $fecha, "hora" => $hora));
    // "name del input  -> Variable que contiene el campo de la base de datos"
    $data = array(
        "exists" => true,
        "empresa" => $empresa,
        "sede" => $sede,
        "departamento" => $departamento,
        "nom_usuario" => $nom_usuario,
        "fecha" => $fecha,
        "hora" => $hora,
        "tipo_equipo" => $tipo_equipo,
        "activo_fijo" => $activo_fijo,
        "ip_equipo" => $ip_equipo,
        "modelo" => $modelo,
        "fabricante" => $fabricante,
        "nom_equipo" => $nom_equipo,
        "nom_procesador" => $nom_procesador,
        "ram" => $ram,
        "slot" => $slot,
        "nom_tec" => $nombre,
        "comp_add" => $componentes_add,
        "puntero" => $puntero,
        "capacidad" => $capacidad,
              
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
       "nom_usuario" => "",
       "fecha" => ($fecha_actual != "") ? $fecha_actual : date("Y-m-d"),
       "hora" => ($hora_actual != "") ? $hora_actual : date("H:i:s"),
       "tipo_equipo" => "",
       "activo_fijo" => "",
       "ip_equipo" => "",
       "modelo" => "",
       "fabricante" => "",
       "nom_equipo" => "",
       "nom_procesador" => "",
       "ram" => "",
       "slot" => "",
       "nom_tec" => "",
       "comp_add" => "",
       "puntero" => "",
       "capacidad" => "",
       
    );
    echo json_encode($data);
    //echo "El valor ingresado no existe en la base de datos";
}

$conn->close();
?>
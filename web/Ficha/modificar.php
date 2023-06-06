<?php
// Llamar al archivo de conexión a la base de datos
include("conexion.php");

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtener los valores del formulario
  $serial = $_POST['serial'];
  $empresa = $_POST['empresa'];
  $sede = $_POST['sede'];
  $departamento = $_POST['departamento'];
  $nom_usuario = $_POST['nom_usuario'];
  $tipo_equipo = $_POST['tipo_equipo'];
  $activo_fijo = $_POST['activo_fijo'];
  $ip_equipo = $_POST['ip_equipo'];
  $modelo = $_POST['modelo'];
  $fabricante = $_POST['fabricante'];
  $nom_equipo = $_POST['nom_equipo'];
  $nom_procesador = $_POST['nom_procesador'];
  $so = $_POST['so'];
  $ram = $_POST['ram'];
  $slot = $_POST['slot'];
  $nom_tec = $_POST['nom_tec'];
  $puntero = $_POST['puntero'];
  $capacidad = $_POST['capacidad'];
  $componentes_add = $_POST['comp_add'];

  // Realizar la consulta para actualizar los campos
  $sql_datos  = "UPDATE datos SET empresa='$empresa', sede='$sede', departamento='$departamento', nom_usuario='$nom_usuario' , tipo_equipo='$tipo_equipo', 
  activo_fijo='$activo_fijo', ip_equipo='$ip_equipo', modelo='$modelo', fabricante='$fabricante', nom_equipo='$nom_equipo', nom_procesador='$nom_procesador', so='$so', ram='$ram', 
  slot='$slot', nombre='$nom_tec', componentes_add='$componentes_add'WHERE serial='$serial'";

  // Realizar la consulta para actualizar los campos en la tabla "disco"
  $sql_disco = "UPDATE disco SET puntero='$puntero', capacidad='$capacidad' WHERE serial_id='$serial'";
  
  //if (mysqli_query($conn, $sql)) {
  // Ejecutar las consultas SQL
  if (mysqli_query($conn, $sql_datos) && mysqli_query($conn, $sql_disco)) {
    // Generar una alerta
    $mensaje = "Los campos se actualizaron correctamente";
    echo '<script>alert("'. $mensaje . '");</script>';
    //echo "Los campos se actualizaron correctamente";
  } else {
    echo "Error al actualizar los campos: " . mysqli_error($conn);
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);
}
?>
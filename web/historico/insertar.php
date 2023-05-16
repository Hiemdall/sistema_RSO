<?php
 // Llamar a el archivo conexion.php para hacer la conexion a la base de datos
 include("conexion.php");

 // Definición de la constante
 //const EMPRESA = "Asecoem'g";
 //define("EMPRESA", "Asecoem'g");
 //define("UBICACION", "Calle 35 A norte # 2BN 160"); 
 //define("SECE", 1);  
 define("VISITA", 1); 

$empresa = $_POST['empresa'];
$sede = $_POST["sede"];
$departamento = $_POST["departamento"];
$serial = $_POST["serial"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$tipo_mant = $_POST["tipo_mant"];
$observacion = $_POST["observacion"];
$recomendaciones = $_POST["recomendaciones"];
$nom_tec = $_POST["nom_tec"];



// Insertar los datos en la base de datos

$sql = "INSERT INTO historial (empresa, sede, departamento, serial, fecha, hora, tipo_mant, visita, observacion, recomendaciones, nom_tec)
        VALUES ('$empresa', '$sede', '$departamento', '$serial', '$fecha', '$hora', '$tipo_mant', ".VISITA.", '$observacion', '$recomendaciones','$nom_tec')";        

if ($conn->query($sql) === TRUE) {
  
  // Generar una alerta
  $mensaje = "Los datos se insertaron correctamente.";
  echo '<script>alert("'. $mensaje . '");</script>';
 // echo "Los datos se insertaron correctamente.";
} else {
  echo "Error al insertar los datos: " . $conn->error;
}


mysqli_close($conn);

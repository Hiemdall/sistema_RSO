<?php
 // Llamar a el archivo conexion.php para hacer la conexion a la base de datos
 include("conexion.php");

// Recibir datos del formulario
//$search_term = "%" . $_POST['cedula'] . "%";
$search_term = $_POST['sede'];


// Preparar la consulta SQL
// $sql = "SELECT * FROM datos WHERE cedula LIKE ?";
/*
// Ejemplo de código SQL, datos y cargo son las tablas de esa base de datos
$sql = "SELECT datos.id_empleado, datos.ced_datos, datos.nom1_datos, datos.nom2_datos, datos.ape1_datos, datos.ape2_datos, datos.fec_ing_datos, cargo.nom_cargo, datos.sue_datos, datos.est_datos FROM datos
INNER JOIN cargo ON datos.cargo = cargo.id_cargo WHERE ced_datos LIKE ?";
*/

$sql = "SELECT serial, empresa, sede, departamento, fecha, hora, tipo_mant, observacion, recomendaciones, nom_tec  FROM historial WHERE sede = '$sede'";

// Preparar la sentencia
$stmt = mysqli_prepare($conn, $sql);

// Vincular los parámetros
mysqli_stmt_bind_param($stmt, "s", $search_term);

// Ejecutar la sentencia
mysqli_stmt_execute($stmt);

// Obtener resultados
$result = mysqli_stmt_get_result($stmt);

$fila = mysqli_fetch_assoc($result);

$fecha_actual = new DateTime('now', new DateTimeZone('America/Bogota'));
//$fecha_formateada = $fecha_actual->format('d/m/Y H:i:s');
$fecha_formateada = $fecha_actual->format('m/d/Y');
$meses1 = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$fecha_convertida2 = date("d", strtotime($fecha_formateada)) . " de " . $meses1[date("n", strtotime($fecha_formateada))-1] . " de " . date("Y", strtotime($fecha_formateada));

// Covertir el sueldo con el formato de moneda $
$sueldo = $fila["sue_datos"];
$sueldo_formateado = "$".number_format($sueldo, 2, ".", ",");

// Fecha inicio del esmpleado
$selectedDate = $fila["fec_ing_datos"];
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$fecha_convertida = date("d", strtotime($selectedDate)) . " de " . $meses[date("n", strtotime($selectedDate))-1] . " de " . date("Y", strtotime($selectedDate));

// Crear el objeto dompdf
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

// Creamos el HTML que se convertirá en PDF
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body{
    background-image: url(Fichatecnica.jpg);
    background-size: cover; 
    background-repeat: no-repeat;
    background-size: 100%;
    margin: 1px;
    }

    .fecha{
      position: absolute;
      margin: 0;
      top: 10px;
      left: 85%;
    }

    .hora{
      position: absolute;
      margin: 0;
      top: 30px;
      left: 85%;
    }

    .serial{
      position: absolute;
      margin: 0;
      top: 57px;
      left: 77%;
    }

    .sede{
      position: absolute;
      margin: 0;
      top: 142px;
      left: 8%;
    }

    .departamento{
      position: absolute;
      margin: 0;
      top: 142px;
      left: 61%;
    }

    .tecnico{
      position: absolute;
      margin: 0;
      top: 172px;
      left: 12%;
    }

    .usuario{
      position: absolute;
      margin: 0;
      top: 172px;
      left: 55%;
    }

    .cpu{
      position: absolute;
      margin: 0;
      top: 23%;
      left: 8%;
    }

    .ram{
      position: absolute;
      margin: 0;
      top: 23%;
      left: 57%;
    }

    .disco{
      position: absolute;
      margin: 0;
      top: 26%;
      left: 7%;
    }

    .so{
      position: absolute;
      margin: 0;
      top: 26%;
      left: 56%;
    }

    .dispositivos{
      position: absolute;
      top: 29%;
      left: 3%;
      width: 660px;
      overflow: hidden;
      word-wrap: break-word;
    }
    

  </style>
</head>
<body>
  <p class="fecha"></p>
  <p class="hora"></p>
  <p class="serial"> Serial:</p>
  <p class="sede"></p>
  <p class="departamento"></p>
  <p class="tecnico"></p>
  <p class="usuario"></p>
  <p class="cpu"></p>
  <p class="ram"></p>
  <p class="disco"></p>
  <p class="so"></p>
  <p class="dispositivos"></p>

</body>
</html>
';

$dompdf->setPaper('A4', 'portrait');
// Renderizar el contenido HTML en PDF
$dompdf->loadHtml($html);
$dompdf->render();


// Descargar el archivo PDF
// Nombre del archivo:
//$dompdf->stream("carta_de_trabajo.pdf");
$dompdf->stream("certificado_laboral_",[ "Attachment" => false]);




?>
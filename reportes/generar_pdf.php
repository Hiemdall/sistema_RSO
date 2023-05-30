<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtener el valor de la sede seleccionada
  $sede = $_POST['sede'];

  // Validar que se haya seleccionado una sede
  if (!empty($sede)) {
    // Llamar al archivo de conexión a la base de datos
    include("conexion.php");

    // Consulta en la base de datos
    $sql = "SELECT serial, empresa, sede, departamento, fecha, hora, tipo_mant, observacion, recomendaciones, nom_tec  FROM historial WHERE sede = '$sede'";
    $result = mysqli_query($conn, $sql);

    // Verificar si se encontraron resultados
    if (mysqli_num_rows($result) > 0) {
      // Crear instancia de Dompdf
      $dompdf = new Dompdf();

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
        <p class="fecha">'.$fecha.'</p>
        <p class="hora">'.$hora.'</p>
        <p class="serial"> Serial: '.$serial.'</p>
        <p class="sede">'.$sede.'</p>
        <p class="departamento">'.$departamento.'</p>
        <p class="tecnico">'.$tecnico.'</p>
        <p class="usuario">'.$usuario.'</p>
        <p class="cpu">'.$cpu.'</p>
        <p class="ram">'.$ram.'</p>
        <p class="disco">'.$disco.'</p>
        <p class="so">'.$so.'</p>
        <p class="dispositivos">'.$dispositivos.'</p>
      
      </body>
      </html>
      ';
      
      // Cargar el contenido HTML en Dompdf
      $dompdf->loadHtml($html);

      // (Opcional) Configurar opciones de Dompdf
      $dompdf->setPaper('A4', 'portrait');

      // Renderizar el HTML a PDF
      $dompdf->render();

      // Generar el archivo PDF y guardarlo en el servidor
      $output = $dompdf->output();
      file_put_contents('reporte.pdf', $output);

      echo 'Se ha generado el reporte en formato PDF.';
    } else {
      echo 'No se encontraron historiales para la sede seleccionada.';
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
  } else {
    echo 'Por favor, seleccione una sede.';
  }
}
?>

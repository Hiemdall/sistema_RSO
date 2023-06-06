<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$conexion = mysqli_connect("localhost", "root", "", "soporte_rso");


$resultado = mysqli_query($conexion, "SELECT * FROM historial");
$adi = "rgergjkj";
$visita = "999";


$html = '<html>';
$html = '<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<style>
body{
background-image: url(FichaHistorica.jpg);
background-size: cover; 
background-repeat: no-repeat;
background-size: 100%;
}

.empresa{
  position: absolute;
  margin: 0;
  top: 15px;
  left: 16%;
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
  top: 31px;
  left: 83%;
  font-size: 14px;
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

.tip_mant{
  position: absolute;
  margin: 0;
  top: 5.5%;
  left: 16%;
}

.observacion{
  position: absolute;
  margin: 0;
  top: 42%;
  left: 2%;
}

.recomendaciones{
  position: absolute;
  margin: 0;
  top: 58%;
  left: 2%;
}

.adi{
  position: absolute;
  margin: 0;
  top: 20%;
  left: 2%;
}

img{
  position: absolute;
  margin: 0;
  top: 79%;
  left: 65%;
}
.visita{
      position: absolute;
      margin: 0;
      top: 172px;
      left: 47%;
    }

.logo_form{
  width: 75px; 
  height: 75px;
  position: absolute;
      margin: 0;
      top: 1%;
      left: 2%;
}

</style>
</head>';

while ($fila = mysqli_fetch_assoc($resultado)) {
    $html .= '
    <body>
  <img src="logo_form.jpg" alt="" class="logo_form">
  <p class="empresa">'. $fila['empresa'] .'</p>
  <p class="sede">'. $fila['sede'] .'</p>
  <p class="fecha">'. $fila['fecha'] .'</p>
  <p class="hora">'. $fila['hora'] .'</p>
  <p class="serial"> Serial: '. $fila['serial'] .'</p>
  <p class="departamento">'. $fila['departamento'] .'</p>
  <p class="tip_mant">Tipo de Mantenimiento: '. $fila['tipo_mant'] .'</p>
  <p class="visita">N.visita: '.$fila['visita'].'</p>
  <p class="observacion"> Observaciones: '. $fila['observacion'] .'</p>
  <p class="recomendaciones"> Recomendaciones: '. $fila['recomendaciones'] .'</p>
  <p class="adi">Acepto utilizar este servicio únicamente para fines legales y de acuerdo con las leyes y regulaciones aplicables.
  Entiendo y acepto que toda la información proporcionada en este formulario es precisa y verídica.
  Reconozco que cualquier uso indebido o fraudulento de este servicio puede resultar en la cancelación de mi cuenta y posibles acciones legales.
  Acepto que la información proporcionada en este formulario puede ser utilizada y procesada de acuerdo con la política de privacidad.
  Entiendo se reserva el derecho de modificar o actualizar estos términos de servicio en cualquier momento y es mi responsabilidad revisarlos periódicamente.</p>
  <p class="tecnico">'. $fila['nom_tec'] .'</p>';

  $tecnico = $fila['nom_tec'];
  $imagenFirma = obtenerImagenFirma($tecnico);
 
  $html .= '<img src="' . $imagenFirma . '" alt="Firma del técnico" style="width: 150px; height: 75px;">';


  // Salta a la otra pagina si hay mas registros
  $html .= '<div style="page-break-after: always;"></div>';

  $html .= '</body>';
}

$html .= '</html>';

$dompdf->setPaper('A4', 'portrait');
// Renderizar el contenido HTML en PDF
$dompdf->loadHtml($html);
$dompdf->render();


// Descargar el archivo PDF
// Nombre del archivo:
//$dompdf->stream("carta_de_trabajo.pdf");
$dompdf->stream("Historico",[ "Attachment" => false]);

function obtenerImagenFirma($tecnico) {
  // Puedes implementar tu lógica para obtener la ruta de la imagen de firma según el técnico
  // Por ejemplo, puedes tener un array asociativo donde las claves sean los nombres de los técnicos y los valores sean las rutas de las imágenes
  $firmaTecnicos = array(
      'Heimdall Rojas' => 'firmas/heimdall.jpg',
      'Denyer Bastida' => 'firmas/denyer.jpg',
     
      // Agrega más técnicos y sus respectivas rutas de imagen aquí
  );

  // Verificar si el técnico tiene una firma definida
  if (isset($firmaTecnicos[$tecnico])) {
      return $firmaTecnicos[$tecnico];
  } else {
      // Si no hay una firma definida para el técnico, puedes retornar una imagen por defecto o una ruta genérica
      return 'ruta/a/la/imagen/firma_default.jpg';
  }
}
?>

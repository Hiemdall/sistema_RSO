<?php

$fecha = "21/05/2023";
$hora = "12:59";
$serial = "MXL7011DT7";
$sede = "Diamante";
$departamento = "Consultorio 100";
$tecnico = "Denyer Bastidas";
$usuario = "Yesica Barrios";
$cpu = "Intel core i5-3470S";
$ram = "8 Ram";
$disco = "900 GB";
$so = "Windows 10";
$dispositivos = "fwjkefiwefjwkbfjkwebnfjkwbnefkjlwenblfjweiwedfñkaksdfweoijfddlkdmlfdkWKEOJFDWEFJKLÑMFDKWEJFOWENFWEKNHFOWEFWKLEFNADFKJSE";


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

$dompdf->setPaper('A4', 'portrait');
// Renderizar el contenido HTML en PDF
$dompdf->loadHtml($html);
$dompdf->render();


// Descargar el archivo PDF
// Nombre del archivo:
//$dompdf->stream("carta_de_trabajo.pdf");
$dompdf->stream("Ficha_tecnica",[ "Attachment" => false]);




?>
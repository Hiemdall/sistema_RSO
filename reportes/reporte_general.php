<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();


// Llamar a el archivo conexion.php para hacer la conexion a la base de datos
include("conexion.php");

$resultado = mysqli_query($conexion, "SELECT * FROM sede");

$html = '<html>';
$html .= '<head>';
$html .= '<style>';
$html .= 'table { width: 100%; border-collapse: collapse; }';
$html .= 'caption { font-weight: bold; font-size: 20px; }';
$html .= 'th, td { padding: 10px; border: 1px solid #000; }';
$html .= '</style>';
$html .= '</head>';
$html .= '<body>';
$html .= '<table>';
$html .= '<caption>Equipos</caption>';
$html .= '<tr><th>Empresa</th><th>Sede</th><th>Hora</th></tr>';
while ($fila = mysqli_fetch_assoc($resultado)) {
    $html .= '<tr><td>' . $fila['empresa'] . '</td><td>' . $fila['sede'] . '</td>'. '<td>' . $fila['hora'] . '</td></tr>';
}
$html .= '</table>';
$html .= '</body>';
$html .= '</html>';

$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("reporte.pdf");
?>


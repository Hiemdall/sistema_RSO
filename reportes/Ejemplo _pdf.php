<?php
// incluye la clase dompdf
require_once 'dompdf/autoload.inc.php';

// crea una instancia de la clase dompdf
use Dompdf\Dompdf;
$dompdf = new Dompdf();

// genera el contenido HTML que deseas convertir en PDF
$html = '<h1>Ejemplo de PDF generado con dompdf y PHP</h1><p>Este es un párrafo de ejemplo.</p>';

// carga el contenido HTML en la instancia de dompdf
$dompdf->loadHtml($html);

// renderiza el contenido HTML en PDF
$dompdf->render();

// envía el PDF generado al navegador
$dompdf->stream('hospital.pdf');
?>
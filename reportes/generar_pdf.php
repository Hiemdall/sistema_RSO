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

      // Generar el contenido HTML de la tabla
      ob_start(); // Iniciar almacenamiento en búfer
      ?>
      <table>
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Departamento</th>
            <th>Serail</th>
            <th>Tipo de Mantenimiento</th>
            <th>Observación</th>
            <th>Recomendaciones</th>
            <th>Técnico</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Recorrer los resultados y mostrarlos en la tabla
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['fecha'] . '</td>';
            echo '<td>' . $row['hora'] . '</td>';
            echo '<td>' . $row['departamento'] . '</td>';
            echo '<td>' . $row['serial'] . '</td>';
            echo '<td>' . $row['tipo_mant'] . '</td>';
            echo '<td>' . $row['observacion'] . '</td>';
            echo '<td>' . $row['recomendaciones'] . '</td>';
            echo '<td>' . $row['nom_tec'] . '</td>';
            echo '</tr>';
          }
          ?>
        </tbody>
      </table>
      <?php
      $html = ob_get_clean(); // Obtener el contenido almacenado en búfer

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

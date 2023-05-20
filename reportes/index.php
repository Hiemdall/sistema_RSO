<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
</head>
<body>
<h1>Menú de Reportes</h1>
    <form method="post">

        <input type="submit" name="sede" value="Sede">
        <input type="submit" name="serial" value="Serial">
        <input type="submit" name="pdf" value="PDF">

    </form>
        <!-- Acciones de los botones -->
  <?php
  //Acciones de los submit
if (isset($_POST['sede'])) {
  // Código para manejar el registro
  //echo "Registro Guardado";
  include('reporte_sede.php');
    
} else if (isset($_POST['serial'])) {
  // Código para manejar la edición de un registro
   include('reporte_serial.php');
   //echo "Registro Editado";
   //include('modificar.php');

  } else if (isset($_POST['pdf'])) {
    // Código para manejar la edición de un registro
    include('Ejemplo _pdf.php');
    //echo "Registro Editado";
    //include('modificar.php');    


} else if (isset($_POST['eliminar'])) {
  // Código para manejar la eliminación de un registro
  echo "Registro eliminado";
 // include('eliminar.php');
}
?>
</body>
</html>
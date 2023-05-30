<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial del Equipo</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    

</head>
<body>
  <div class="content">
  
  
    
    <form method="post">
    <h1>Historial del Equipo</h1>
    
    <input type="text" id="serial" name="serial" placeholder="Serial">

    <input type="text" id="empresa" name="empresa" placeholder="Empresa">

    <input type="text" id="sede" name="sede" placeholder="Sede">

    <input type="text" id="departamento" name="departamento" placeholder="Departamento">

    <?php
        // Obtener la fecha actual
        $fechaActual = date('d/m/Y'); 
    ?>
    <label for="fecha">Fecha:</label>
    <input type="text" id="fecha" name="fecha" value="<?php echo $fechaActual; ?>">

    <?php
        // Establecer la zona horaria
        date_default_timezone_set('America/Bogota');
        // Obtener la hora actual
        $horaActual = date('H:i:s A'); 
    ?>
    <label for="hora">Hora:</label>
    <input type="text" id="hora" name="hora" value="<?php echo $horaActual; ?>">

    <label for="tipo_mant">Tipo de Mantenimiento:</label>
    <select id="tipo_mant" name="tipo_mant">
      <option value="">Tipo de Mantenimiento:</option>
      <option value="Diagnóstico">Diagnóstico</option>
      <option value="Preventivo">Preventivo</option>
      <option value="Correctivo">Correctivo</option>
      <option value="Remoto">Remoto</option>
    </select>

    <!--
    <label for="observacion">Observación:</label>
    <textarea id="observacion" rows="4" name="observacion" style="width: 762px;"></textarea>


    <label for="recomendaciones">Recomendaciones:</label>
    <textarea id="recomendaciones" rows="4" name="recomendaciones"></textarea>
<!--
    <label for="nom_tec">Nombre del Técnico:</label>
    <input type="text" id="nom_tec" name="nom_tec"> -->

    <select id="nom_tec" name="nom_tec">
      <option value="">Nombre del Técnico:</option>
      <option value="Denyer Bastida">Denyer Bastida</option>
      <option value="Michael Asprilla">Michael Asprilla</option>
      <option value="Steven Gomez">Steven Gomez</option>
      <option value="Andrés Agudelo">Andrés Agudelo</option>
      <option value="Heimdall Rojas">Heimdall Rojas</option>
    </select>


<!-- Botones-->
    <input type="submit" name="agregar" value="Guardar">
  
    
    
  </form>
<!-- Acciones de los botones -->
  <?php
  //Acciones de los submit
if (isset($_POST['agregar'])) {
  // Código para manejar el registro
  //echo "Registro Guardado";
  include('insertar.php');
    
} else if (isset($_POST['editar'])) {
  // Código para manejar la edición de un registro
   // include('actualizar.php');
  echo "Registro Editado";
   //include('modificar.php');


} else if (isset($_POST['eliminar'])) {
  // Código para manejar la eliminación de un registro
  echo "Registro eliminado";
 // include('eliminar.php');
}
?>

<!--Script para buscar en tiempo real la cedula, llamando el archivo buscar.php-->
<script>

// Ventana emergente descripción del soporte
document.getElementById('openPopup').addEventListener('click', function() {
 
 var popup = document.querySelector('.popup');
 popup.style.display = 'block';

 var popupTexts = popup.getElementsByTagName('p');
 for (var i = 0; i < popupTexts.length; i++) {
   popupTexts[i].addEventListener('click', function() {
     document.getElementById('text1').value = this.innerText;
     popup.style.display = 'none';
   });
 }

document.getElementById('cerrar').addEventListener('click', function() {
popup.style.display = 'none';
});

return false; // Evita que el formulario se envíe
});





//La infomación de la base de datos va a cada input del formulario
document.getElementById("serial").addEventListener("input", function() {
  var input = this.value;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "buscar.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      var response = JSON.parse(this.responseText);
      if (response.exists) {
        document.getElementById("empresa").value = response.empresa;
        document.getElementById("sede").value = response.sede;
        document.getElementById("departamento").value = response.departamento;
        
        
      }
    }
  };
  xhr.send("input=" + input);
});
</script>

</body>
</html>

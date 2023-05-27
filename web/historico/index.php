<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial del Equipo</title>
    <link rel="stylesheet" type="text/css" href="styles1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 </head>
<body>
    <h1>Historial del Equipo</h1>
    <form method="post">

    
    <label for="serial">Serial:</label>
    <input type="text" id="serial" name="serial">

    <label for="empresa">Empresa:</label>
    <input type="text" id="empresa" name="empresa">

    <label for="sede">Sede:</label>
    <input type="text" id="sede" name="sede">

    <label for="departamento">Departamento:</label>
    <input type="text" id="departamento" name="departamento">

    <?php
        // Obtener la fecha actual
        $fechaActual = date('d/m/Y'); 
    ?>
    <label for="fecha">Fecha:</label>
    <input type="text" id="fecha" name="fecha" value="<?php echo $fechaActual; ?>" readonly>

    <?php
        // Establecer la zona horaria
        date_default_timezone_set('America/Bogota');
        // Obtener la hora actual
        $horaActual = date('H:i:s A'); 
    ?>
    <label for="hora">Hora:</label>
    <input type="text" id="hora" name="hora" value="<?php echo $horaActual; ?>" readonly>

    <label for="tipo_mant">Tipo de Mantenimiento:</label>
    <select id="tipo_mant" name="tipo_mant">
      <option value="">Seleccione una opción</option>
      <option value="Diagnóstico">Diagnóstico</option>
      <option value="Preventivo">Preventivo</option>
      <option value="Correctivo">Correctivo</option>
      <option value="Remoto">Remoto</option>
    </select>

    <!--
    <label for="observacion">Observación:</label>
    <textarea id="observacion" rows="4" name="observacion" style="width: 762px;"></textarea>   -->

    
        <label for="text1">Descripción del soporte:</label>
        <textarea id="text1" rows="4" name="observacion" style="width: 762px;"></textarea>   
         
      
    
 


    <label for="recomendaciones">Recomendaciones:</label>
    <textarea id="recomendaciones" rows="4" name="recomendaciones" style="width: 762px;"></textarea>
<!--
    <label for="nom_tec">Nombre del Técnico:</label>
    <input type="text" id="nom_tec" name="nom_tec"> -->

    <label for="nom_tec">Nombre del Técnico:</label>
    <select id="nom_tec" name="nom_tec">
      <option value="">Seleccione una opción</option>
      <option value="Denyer Bastida">Denyer Bastida</option>
      <option value="Michael Asprilla">Michael Asprilla</option>
      <option value="Steven Gomez">Steven Gomez</option>
      <option value="Andrés Agudelo">Andrés Agudelo</option>
      <option value="Heimdall Rojas">Heimdall Rojas</option>
    </select>


<!-- Botones-->
    <input type="submit" name="agregar" value="Guardar">
   
     
  </form>
  <button class="help-button" id="openPopup" name="observacion"  title="Ayuda"><i class="fas fa-question"></i></button>

       <!-- Ventana Emergente -->
       <div class="popup">
      <h1>Ejemplos de descripciones para el informe</h1>
    <p>Realizamos una limpieza exhaustiva de todos los componentes internos y externos del equipo, incluyendo ventiladores, disipadores de calor y filtros de aire. Se eliminó todo el polvo y los residuos acumulados, lo que mejorará el flujo de aire y reducirá el riesgo de sobrecalentamiento. Se reemplazó la pasta térmica en el procesador para garantizar una disipación adecuada del calor. La nueva pasta térmica ayudará a mantener la temperatura del procesador en niveles óptimos y evitará problemas de sobrecalentamiento en el futuro.
       Verificamos todos los cables y conexiones para asegurarnos de que estuvieran correctamente enchufados y en buen estado de funcionamiento.</p>
       <h1>--------------------------------------------------------------------------------------</h1>
    <p>Limpieza de hardware: Se llevó a cabo una limpieza minuciosa de los componentes internos y externos del equipo, incluyendo ventiladores, disipadores de calor y componentes de almacenamiento. Esto eliminó el polvo y los residuos acumulados, mejorando el flujo de aire y evitando el sobrecalentamiento. Limpieza de software: Se eliminaron archivos temporales y basura acumulada, lo que liberó espacio en el disco y optimizó el sistema. Además, se desinstalaron programas innecesarios y se realizaron actualizaciones de sistema y controladores para garantizar un funcionamiento óptimo.</p>
       <h1>--------------------------------------------------------------------------------------</h1>
    <p>Cambio de disco duro: Reemplazamos su antiguo disco duro por uno de estado sólido (SSD). Esto ha mejorado significativamente lavelocidad de lectura y escritura de datos, lo que resultará en tiempos de carga más rápidos y una mayor capacidad de respuesta del sistema en general. Actualización de memoria RAM: Incrementamos la capacidad de la memoria RAM de su equipo, lo que permitirá un mejor manejo de múltiples tareas y una mayor velocidad de procesamiento. Con esta actualización, su equipo podrá ejecutar aplicaciones exigentes de manera más eficiente y sin problemas de rendimiento.</p>
    <button id="cerrar">Cerrar</button>  
    </div>


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

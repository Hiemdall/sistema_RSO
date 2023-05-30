<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial del Equipo</title>
    
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<!-- Template Stylesheet -->
<link rel="stylesheet" type="text/css" href="style.css">

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
    <input type="text" id="fecha" name="fecha" value="<?php echo $fechaActual; ?>">

    <?php
        // Establecer la zona horaria
        date_default_timezone_set('America/Bogota');
        // Obtener la hora actual
        $horaActual = date('H:i:s A'); 
    ?>
    <input type="text" id="hora" name="hora" value="<?php echo $horaActual; ?>">
    <select id="tipo_mant" name="tipo_mant">
      <option value="">Tipo de Mantenimiento:</option>
      <option value="Diagnóstico">Diagnóstico</option>
      <option value="Preventivo">Preventivo</option>
      <option value="Correctivo">Correctivo</option>
      <option value="Remoto">Remoto</option>
    </select>

    <label for="observacion">Observación:</label>
    <textarea id="observacion" rows="4" name="observacion"></textarea>


    <label for="recomendaciones">Recomendaciones:</label>
    <textarea id="recomendaciones" rows="4" name="recomendaciones"></textarea>
<!--
    <label for="nom_tec">Nombre del Técnico:</label>
    <input type="text" id="nom_tec" name="nom_tec">-->

    <select id="nom_tec" name="nom_tec">
      <option value="">Nombre del Técnico:</option>
      <option value="Denyer Bastida">Denyer Bastida</option>
      <option value="Michael Asprilla">Michael Asprilla</option>
      <option value="Steven Gomez">Steven Gomez</option>
      <option value="Andrés Agudelo">Andrés Agudelo</option>
      <option value="Heimdall Rojas">Heimdall Rojas</option>
    </select>


<!-- Botones-->
  <button type="submit" name="agregar" value="Guardar">Guardar</button>  
  
    
  
  </form>
  
  <button class="help-button" id="openPopup" title="Ayuda"><i class="fas fa-question"></i></button>
      
      <div class="popup">
          <h1>Ejemplos de descripciones para el informe</h1>
        <p>Realizamos una limpieza exhaustiva de todos los componentes internos y externos del equipo, incluyendo ventiladores, disipadores de calor y filtros de aire. Se eliminó todo el polvo y los residuos acumulados, lo que mejorará el flujo de aire y reducirá el riesgo de sobrecalentamiento. Se reemplazó la pasta térmica en el procesador para garantizar una disipación adecuada del calor. La nueva pasta térmica ayudará a mantener la temperatura del procesador en niveles óptimos y evitará problemas de sobrecalentamiento en el futuro.</p>
        
        <button id="cerrar">Cerrar</button>  
      </div>

     <script src="script.js"></script>

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

</Div>
<footer> 
      <p>Desarrollado por Integratic © 2023</p>
    </footer>
</body>
</html>

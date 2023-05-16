<!DOCTYPE html>
<html>
<head>
    <title>Registro de Ficha Técnica</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    
</head>
<body>
    <h1>Ficha Técnica del Equipo</h1>
    <form method="post">

        <label for="serial">Serial del Equipo:</label>
        <input class="input_serial" type="text" id="serial" name="serial" >

        <label for="datos_empresa">Nombre de la Empresa:</label>
        <input type="text" id="empresa" name="empresa">
        
        <label for="sede">Sede:</label>
        <input type="text" id="sede" name="sede" >
        
        <label for="departamento">Departamento:</label>
        <input type="text" id="departamento" name="departamento" >
        
        <label for="nom_usuario">Nombre de Usuario:</label>
        <input type="text" id="nom_usuario" name="nom_usuario" >

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
        
        <label for="tipo_equipo">Tipo de Equipo:</label>
        <select class="custom-select" id="tipo_equipo" name="tipo_equipo">
        <option value="">Seleccione una opción</option>
        <option value="Escritorio">Escritorio</option>
        <option value="Portátil">Portátil</option>
        </select>
        
        <label for="activo_fijo">Activo Fijo:</label>
        <input type="text" id="activo_fijo" name="activo_fijo" >
        
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" >
        
        <label for="fabricante">Fabricante:</label>
        <input type="text" id="fabricante" name="fabricante" >
        
        <label for="nom_equipo">Nombre de Equipo:</label>
        <input type="text" id="nom_equipo" name="nom_equipo" >
        
        <label for="nom_procesador">Nombre de Procesador:</label>
        <input type="text" id="nom_procesador" name="nom_procesador" >
        
        <label for="ram">RAM:</label>
        <input type="text" id="ram" name="ram" placeholder="8">
        
        <label for="slot">Slot:</label>
        <input type="text" id="slot" name="slot" placeholder="2">
        
        <label for="puntero">Puntero:</label>
        <input type="text" id="puntero" name="puntero" placeholder="C" >
        
        <label for="capacidad">Capacidad:</label>
        <input type="text" id="capacidad" name="capacidad" placeholder="500 GB">

        <label for="nom_tec">Nombre del Técnico:</label>
        <select class="custom-select" id="nom_tec" name="nom_tec">
        <option value="">Seleccione una opción</option>
        <option value="Denyer Bastida">Denyer Bastida</option>
        <option value="Michael Asprilla">Michael Asprilla</option>
        <option value="Steven Gomez">Steven Gomez</option>
        <option value="Andrés Agudelo">Andrés Agudelo</option>
        <option value="Heimdall Rojas">Heimdall Rojas</option>
        </select>
        
        <input type="submit" name="agregar" value="Guardar">
        <input type="submit" name="editar" value="Editar">
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
   include('modificar.php');
   //echo "Registro Editado";
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
        document.getElementById("nom_usuario").value = response.nom_usuario;
        document.getElementById("fecha").value = response.fecha;
        document.getElementById("hora").value = response.hora;
        document.getElementById("activo_fijo").value = response.activo_fijo;
        document.getElementById("modelo").value = response.modelo;
        document.getElementById("fabricante").value = response.fabricante;
        document.getElementById("nom_equipo").value = response.nom_equipo;
        document.getElementById("nom_procesador").value = response.nom_procesador;
        document.getElementById("ram").value = response.ram;
        document.getElementById("slot").value = response.slot;
        document.getElementById("puntero").value = response.puntero;
        document.getElementById("capacidad").value = response.capacidad;

        //**************************** Select tipo de equipo *************************** */
        // Este código se utiliza para cargar el combobox con los valores de la base de datos
        // Obtener el elemento select
        const selectElementTipoEquipo = document.getElementById("tipo_equipo");
       // Buscar si existe una opción con el valor de response.tipo_equipo
       let optionTipoEquipo = selectElementTipoEquipo.querySelector(`option[value="${response.tipo_equipo}"]`);
       if (!optionTipoEquipo) {
       // Si no existe la opción, agregar una nueva
       optionTipoEquipo = document.createElement("option");
       optionTipoEquipo.value = response.tipo_equipo;
       optionTipoEquipo.textContent = response.tipo_equipo;
       selectElementTipoEquipo.appendChild(optionTipoEquipo);
      }   
      // Establecer el atributo selected de la opción
      optionTipoEquipo.selected = true;

     //**************************** Select técnico *************************** */
     // Obtener el elemento select
     const selectElementNomTec = document.getElementById("nom_tec");
     // Buscar si existe una opción con el valor de response.nom_tec
     let optionNomTec = selectElementNomTec.querySelector(`option[value="${response.nom_tec}"]`);
     if (!optionNomTec) {
     // Si no existe la opción, agregar una nueva
     optionNomTec = document.createElement("option");
     optionNomTec.value = response.nom_tec;
     optionNomTec.textContent = response.nom_tec;
     selectElementNomTec.appendChild(optionNomTec);
    }
    // Establecer el atributo selected de la opción
    optionNomTec.selected = true;
        
      }
    }
  };
  xhr.send("input=" + input);
});
</script>
</body>
</html>

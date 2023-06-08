<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ficha Técnica</title>
    <link rel="stylesheet" type="text/css" href="form.css">
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>

<div class="container">

    <form method="post">
    
    <div class="logo">
  <img src="logo.png" alt="logo">
  <div class="fecha">

  <?php
$fechaActual = date('d-m-y');
?>
<label for="fecha">Fecha:</label>
<input type="text" id="fecha" name="fecha" value="<?php echo $fechaActual; ?>" class="no-border" readonly style="border: none;  background-color: transparent; outline: none; ">


    <?php
        // Establecer la zona horaria
        date_default_timezone_set('America/Bogota');
        // Obtener la hora actual
        $horaActual = date('H:i:s A'); 
    ?>
    <label for="hora">Hora:</label>
    <input type="text" id="hora" name="hora" value="<?php echo $horaActual; ?>" class="no-border" readonly style="border: none;  background-color: transparent; outline: none; ">

    </div>
  </div>



  <h1 class="form-title">Ficha Técnica del Equipo</h1>
  

  
    
    <div class="main-user-info">

    

        <div class="user-input-box" style="width: 100% !important; justify-content: start;">
        <label for="serial" style="margin: 5px;">Serial:</label>
        <input class="input_serial" type="text" id="serial" name="serial" placeholder="Serial del Equipo:" style="width: 28% !important; margin: 5px;">
        </div>

        <div class="user-input-box">
        <label for="empresa" style="margin: 5px;">Empresa:</label>
        <input type="text" id="empresa" name="empresa" placeholder="Nombre de la Empresa:">
        </div>

        <div class="user-input-box">
        <label for="sede" style="margin: 5px;">Sede:</label>
        <input type="text" id="sede" name="sede" placeholder="Sede:">
        </div>

        <div class="user-input-box">
        <label for="departamento" style="margin: 5px;">Departamento:</label>
        <input type="text" id="departamento" name="departamento" placeholder="Departamento:">
        </div>

        <div class="user-input-box">
        <label for="usuario" style="margin: 5px;">Usuario:</label>
        <input type="text" id="nom_usuario" name="nom_usuario" placeholder="Nombre de Usuario:">
        </div>

        <div class="user-input-box">
        <label for="activo" style="margin: 5px;">Activo Fijo:</label>
        <input type="text" id="activo_fijo" name="activo_fijo" placeholder="Activo Fijo:">
        </div>

        <div class="user-input-box">
        <label for="modelo" style="margin: 5px;">Modelo:</label>
        <input type="text" id="modelo" name="modelo" placeholder="Modelo:">
        </div>

        <div class="user-input-box">
        <label for="fabricante" style="margin: 5px;">Fabricante:</label>
        <input type="text" id="fabricante" name="fabricante" placeholder="Fabricante:">
        </div>

        <div class="user-input-box">
        <label for="n_equipo" style="margin: 5px;">Nombre de Equipo:</label>
        <input type="text" id="nom_equipo" name="nom_equipo" placeholder="Nombre de Equipo:">
        </div>

        <div class="user-input-box">
        <label for="IP" style="margin: 5px;">IP del Equipo:</label>
        <input type="text" id="ip_equipo" name="ip_equipo" placeholder="IP del Equipo:">
        </div>

        <div class="user-input-box">
        <label for="procesador" style="margin: 5px;">Procesador:</label>
        <input type="text" id="nom_procesador" name="nom_procesador" placeholder="Nombre de Procesador:">
        </div>

        <div class="user-input-box">
        <label for="" style="margin: 5px;">Sistema Operaivo:</label>
        <select class="custom-select" id="so" name="so">
        <option value="">Sistema Operaivo:</option>
        <option value="Windows 10">Windows 10</option>
        <option value="Windows 11">Windows 11</option>
        <option value="Windows 8">Windows 8</option>
        <option value="Windows 7">Windows 7</option>
        <option value="Linux">Linux</option>
        <option value="macOS">macOS</option>
        </select>
        </div>

        <div class="user-input-box">
        <label for="" style="margin: 5px;">Tipo de Equipo:</label>
        <select class="custom-select" id="tipo_equipo" name="tipo_equipo">
        <option value="">Tipo de Equipo:</option>
        <option value="Escritorio">Escritorio</option>
        <option value="Portátil">Portátil</option>
        </select>
        </div>
      



        


        <div class="user-input-box">
        <label for="ram">RAM:</label>
        <input type="text" id="ram" name="ram" placeholder="8">
        </div>

        <div class="user-input-box">
        <label for="slot">Slot:</label>
        <input type="text" id="slot" name="slot" placeholder="2">
        </div>

        <div class="user-input-box">
        <label for="capacidad">Disco:</label>
        <input type="text" id="capacidad" name="capacidad" placeholder="500 GB HDD">
        </div>

        <div class="user-input-box" style="width: 100% !important;">
        <label for="comp_add">Componentes Adicionales:</label>
        <textarea id="comp_add" rows="4" name="comp_add"></textarea>  
        </div>

        <div class="user-input-box">
        <label for="" style="margin: 5px;">Nombre del Técnico:</label>
        <select class="custom-select" id="nom_tec" name="nom_tec">
        <option value="">Nombre del Técnico:</option>
        <option value="Denyer Bastida">Denyer Bastida</option>
        <option value="Michael Asprilla">Michael Asprilla</option>
        <option value="Steven Gomez">Steven Gomez</option>
        <option value="Andrés Agudelo">Andrés Agudelo</option>
        <option value="Heimdall Rojas">Heimdall Rojas</option>
        </select>
        </div>


        <div class="form-submit-btn">
        <input type="submit" id="guardarBtn" name="agregar" value="Guardar"></input>
        <input type="submit" name="editar" value="Editar"></input>
        </div>
        

  </div>
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
        document.getElementById("ip_equipo").value = response.ip_equipo;
        document.getElementById("nom_procesador").value = response.nom_procesador;
        document.getElementById("ram").value = response.ram;
        document.getElementById("slot").value = response.slot;
        document.getElementById("puntero").value = response.puntero;
        document.getElementById("capacidad").value = response.capacidad;
        document.getElementById("comp_add").value = response.comp_add;

        //**************************** Select sistema operativo *************************** */
        // Este código se utiliza para cargar el combobox con los valores de la base de datos
        // Obtener el elemento select
        const selectElementSo = document.getElementById("so");
       // Buscar si existe una opción con el valor de response.tipo_equipo
       let optionSo = selectElementSo.querySelector(`option[value="${response.so}"]`);
       if (!optionSo) {
       // Si no existe la opción, agregar una nueva
       optionSo = document.createElement("option");
       optionSo.value = response.so;
       optionSo.textContent = response.so;
       selectElementSo.appendChild(optionSo);
      }   
      // Establecer el atributo selected de la opción
      optionSo.selected = true;

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
        // Deshabilitar el botón de guardar si el equipo existe
    
      }
    }
  };
  xhr.send("input=" + input);
});
</script>

</div>

<footer> 
      <p>Desarrollado por Integratic © 2023</p>
    </footer>
</body>
</html>

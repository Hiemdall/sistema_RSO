<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blockbl5_red_de_salud_oriente";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8mb4");
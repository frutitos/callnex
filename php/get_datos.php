<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "callnex";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos de la tabla curso
$sqlCurso = "SELECT anio, division FROM curso";
$resultCurso = $conn->query($sqlCurso);

$aniosDivisiones = array();
if ($resultCurso->num_rows > 0) {
    while ($row = $resultCurso->fetch_assoc()) {
        $aniosDivisiones[] = $row;
    }
}

// Obtener datos de la tabla grupo
$sqlGrupo = "SELECT nombre FROM grupo";
$resultGrupo = $conn->query($sqlGrupo);

$grupos = array();
if ($resultGrupo->num_rows > 0) {
    while ($row = $resultGrupo->fetch_assoc()) {
        $grupos[] = $row;
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode(array("aniosDivisiones" => $aniosDivisiones, "grupos" => $grupos));

$conn->close();
?>
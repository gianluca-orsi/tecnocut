<?php
// Datos para realizar la conexión
$servername = "localhost";
$username = "id17771584_sgp21";
$password = "96N>+LD-P@[Q~~a_";
$dbname = "id17771584_sgp";
// Crear la conexión con nuestra BD
$conn = new mysqli($servername, $username, $password, $dbname);
// Chequea la conexión
if ($conn->connect_error) {
die("Conexión fallida" . $conn->connect_error);
}
else
{
/* echo ("Conexión exitosa"); */
}
?>
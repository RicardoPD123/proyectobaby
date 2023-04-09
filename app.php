<?php

// Conexión a la base de datos
$servername = "localhost";
$username = "tu_nombre_de_usuario";
$password = "tu_contraseña";
$dbname = "baby_shower";

$conn = new mysqli($servername, $username, $password, $dbname);

// Función para insertar los datos en la tabla "invitaciones"
function insertInvitation($conn, $nombre, $correo, $telefono, $cantidad, $mensaje) {
  $sql = "INSERT INTO invitaciones (nombre, correo, telefono, cantidad, mensaje)
  VALUES ('$nombre', '$correo', '$telefono', '$cantidad', '$mensaje')";
  if ($conn->query($sql) === TRUE) {
    return array('success' => true, 'mensaje' => '¡Invitación enviada exitosamente!');
  } else {
    return array('success' => false, 'mensaje' => 'Error al enviar la invitación: ' . $conn->error);
  }
}

// Manejar la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Verificar que se hayan proporcionado los datos requeridos
  if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['cantidad'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $cantidad = $_POST['cantidad'];
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

    // Insertar los datos en la base de datos
    $result = insertInvitation($conn, $nombre, $correo, $telefono, $cantidad, $mensaje);

    // Devolver una respuesta JSON con el mensaje de éxito o fracaso
    header('Content-Type: application/json');
    echo json_encode($result);
  } else {
    header('HTTP/1.1 400 Bad Request');
    echo 'Faltan datos requeridos';
  }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

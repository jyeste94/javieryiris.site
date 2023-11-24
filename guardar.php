<?php


// Configuración de la base de datos
$host = 'localhost'; // o tu dirección IP del servidor
$usuario = 'root';
$contrasena = '';
$base_de_datos = 'irisyjavi';

// Conectar a la base de datos
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$asistencia = $_POST['asistencia'];
$nombre = $asistencia === 'si' ? $_POST['nombreSi'] : $_POST['nombreNo'];
$telefono = $asistencia === 'si' ? $_POST['telefonoSi'] : $_POST['telefonoNo'];
$email = $asistencia === 'si' ? $_POST['emailSi'] : $_POST['emailNo'];
$acompanante = isset($_POST['acompanante']) ? $_POST['nombre-acompanante'] : null;
$alergias = isset($_POST['alergias']) ? $_POST['alergias'] : null;
$comentarios = isset($_POST['comentarios']) ? $_POST['comentarios'] : null;

// Preparar la consulta SQL
$sql = "INSERT INTO invitaciones (asistencia, nombre, telefono, email, acompanante, alergias, comentarios) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $asistencia, $nombre, $telefono, $email, $acompanante, $alergias, $comentarios);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro guardado exitosamente";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
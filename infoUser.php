<?php
// Iniciar sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir el archivo de conexión a la base de datos
include_once("conexionbd.php");

// Inicializar variables
$nombrePuesto = "No disponible";

// Verificar si existe la sesión y el IdPuesto
if (isset($_SESSION['Puesto'])) {
    $idPuesto = $_SESSION['Puesto'];

    // Consulta SQL para obtener NombrePuesto
    $sql = "SELECT NombrePuesto FROM puesto WHERE IdPuesto = ?";
    $params = array($idPuesto);

    // Preparar y ejecutar la consulta
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt) {
        $result = sqlsrv_execute($stmt);

        if ($result) {
            if (sqlsrv_has_rows($stmt)) {
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $nombrePuesto = $row['NombrePuesto'];
            } else {
                $nombrePuesto = "Puesto no encontrado";
            }
        } else {
            die('<strong>Error en la ejecución:</strong><br>' . print_r(sqlsrv_errors(), true));
        }

        sqlsrv_free_stmt($stmt);
    } else {
        die('<strong>Error en la preparación:</strong><br>' . print_r(sqlsrv_errors(), true));
    }
} else {
    $nombrePuesto = "Puesto no disponible";
}

// Mostrar el nombre y el puesto del usuario
if (isset($_SESSION['Nombre']) && isset($_SESSION['Puesto'])) {
    echo $_SESSION['Nombre'] . " | " . $nombrePuesto;
} else {
    echo "Usuario no identificado";
}
?>

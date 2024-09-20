<?php
// Incluir el archivo de conexión a la base de datos
include_once("conexionbd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el valor del campo oculto
    $palabra = $_POST['palabra'];

    // Verificar si el valor no está vacío
    if (!empty($palabra)) {
        // Preparar la consulta SQL para insertar datos
        $sql = "INSERT INTO prueba (palabra) VALUES (?)";

        // Preparar la consulta
        $stmt = sqlsrv_prepare($conn, $sql, array($palabra));

        // Ejecutar la consulta
        if (sqlsrv_execute($stmt)) {
            echo "Datos guardados correctamente.";
        } else {
            die("Error en la ejecución: " . print_r(sqlsrv_errors(), true));
        }

        // Liberar recursos
        sqlsrv_free_stmt($stmt);
    } else {
        echo "El campo 'palabra' está vacío.";
    }
} else {
    echo "Método de solicitud no válido.";
}

// Cerrar la conexión
sqlsrv_close($conn);
?>

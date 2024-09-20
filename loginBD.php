<?php
session_start(); // Iniciar o reanudar la sesión

include_once("conexionbd.php");

// Inicializar variables para mensajes
$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar datos del formulario
    if (empty($_POST['IdNomina']) || empty($_POST['Pasword'])) {
        $error_message = "N° de Nómina y contraseña son requeridos";
    } else {
        // Escapar los datos del formulario
        $nomina = $_POST['IdNomina'];
        $contrasena = $_POST['Pasword'];

        // Preparar la consulta SQL
        $sql = "SELECT * FROM usuario WHERE IdNomina = ?";
        $params = array($nomina);

        // Preparar y ejecutar la consulta
        $stmt = sqlsrv_prepare($conn, $sql, $params);

        if ($stmt) {
            $result = sqlsrv_execute($stmt);

            if ($result) {
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

                if ($row) {
                    // Verificar la contraseña
                    if ($row['Pasword'] == $contrasena) {
                        // Inicio de sesión exitoso
                        $success_message = "Inicio de sesión exitoso";
                        
                        // Guardar el nombre, el puesto y la línea en la sesión
                        $_SESSION['Nombre'] = $row['Nombre']; 
                        $_SESSION['ApellidoPaterno']= $row['ApellidoPaterno'];
                        $_SESSION['Puesto'] = $row['Puesto']; 
                        $_SESSION['Linea'] = $row['Linea']; 
                        $_SESSION['Area'] = $row['Area']; 
                        $_SESSION['Turno'] = $row['Turno']; 

                        // Redirigir al usuario al inicio después de un inicio de sesión exitoso
                        header("Location: index.php");
                        exit(); 
                    } else {
                        // Contraseña incorrecta
                        $error_message = "Contraseña incorrecta";
                    }
                } else {
                    // El usuario no existe
                    $error_message = "El número de nómina no existe.";
                }
            } else {
                // Error en la ejecución
                die("Error en la consulta: " . print_r(sqlsrv_errors(), true));
            }

            sqlsrv_free_stmt($stmt);
        } else {
            // Error en la preparación
            die("Error en la preparación de la consulta: " . print_r(sqlsrv_errors(), true));
        }
    }
}

// Redirigir al usuario al inicio después de un inicio de sesión fallido
header("Location: login.html?error_message=" . urlencode($error_message));
exit();
?>

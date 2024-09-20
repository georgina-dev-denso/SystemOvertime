<?php
$serverName = "MXA3003\\SQLACPANEL";

// Configurar conexión con autenticación integrada de Windows
$connectionOptions = array(
    "Database" => "SistemaOvertime",
    "Uid" => "",
    "PWD" => ""
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die("Error en la conexión: " . print_r(sqlsrv_errors(), true));
}
?>

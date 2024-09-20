<?php
// Incluir el archivo de conexión
require 'conexionbd.php'; // Asegúrate de que la ruta sea correcta

// Verificar si la conexión se ha establecido
if ($conn === false) {
    die("Error en la conexión: " . print_r(sqlsrv_errors(), true));
}

// Recibir datos del formulario
$idIdentificacion = $_POST['idIdentificacion'];
$mes = $_POST['mes'];
$idArea = $_POST['idArea'];
$idLinea = $_POST['idLinea'];
$tiempoTotalHoras = $_POST['tiempoTotalHoras'];
$eficienciaReal = $_POST['eficienciaReal'];
$eficienciaMeta = $_POST['eficienciaMeta'];
$piezasPC = $_POST['piezasPC'];
$diasLaborales = $_POST['diasLaborales'];
$capacidadDiariaMeta = $_POST['capacidadDiariaMeta'];
$capacidadDiariaReal = $_POST['capacidadDiariaReal'];
$capacidadSemanal = $_POST['capacidadSemanal'];
$tiempoTrabajarLinea = $_POST['tiempoTrabajarLinea'];
$piezasTiempoExtra = $_POST['piezasTiempoExtra'];
$tiempoExtraDiario = $_POST['tiempoExtraDiario'];
$tiempoExtraMes = $_POST['tiempoExtraMes'];
$tt = $_POST['tt'];
$attMeta = $_POST['attMeta'];
$attReal = $_POST['attReal'];
$costo = $_POST['costo'];

// Preparar la consulta SQL
$sql = "INSERT INTO overtime_data (
    IdIdentificacion, mes, IdArea, IdLinea, tiempo_total_horas, eficiencia_real, eficiencia_meta, piezas_pc, dias_laborales, 
    capacidad_diaria_meta, capacidad_diaria_real, capacidad_semanal, tiempo_trabajar_linea, piezas_tiempo_extra, tiempo_extra_diario, 
    tiempo_extra_mes, tt, att_meta, att_real, costo
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Parámetros de la consulta
$params = [
    $idIdentificacion, $mes, $idArea, $idLinea, $tiempoTotalHoras, $eficienciaReal, $eficienciaMeta, $piezasPC, $diasLaborales,
    $capacidadDiariaMeta, $capacidadDiariaReal, $capacidadSemanal, $tiempoTrabajarLinea, $piezasTiempoExtra, $tiempoExtraDiario,
    $tiempoExtraMes, $tt, $attMeta, $attReal, $costo
];

// Ejecutar la consulta
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    // Mostrar errores de SQL Server
    die("Error en la consulta: " . print_r(sqlsrv_errors(), true));
} else {
    echo 'Datos guardados correctamente.';
}
?>

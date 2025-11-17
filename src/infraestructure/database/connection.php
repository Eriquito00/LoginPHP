<?php
/**
 * Crea una conexion con la base de datos
 *
 * @param [type] $host      Host al que se establece
 * @param [type] $user      Usuario para crear la db si no existe
 * @param [type] $password  Contraseña del usuario
 * @param [type] $dbName    Nombre de la db
 * @param [type] $schema    Ruta al fichero del schema.sql (desde este archivo al schema.sql)
 * @return void             Conexion de la db para empezar a darle duro
 */
function createConnection($host, $user, $password, $dbName, $schema){
    $tempCon = new PDO("mysql:host=$host;charset=utf8", $user, $password);
    $tempCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tempCon->exec(file_get_contents(__DIR__ . $schema));

    $con = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $con;
}
?>
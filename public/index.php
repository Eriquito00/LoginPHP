<?php
require_once __DIR__ . "/../src/infraestructure/database/connection.php";
$dbInfo = require_once __DIR__ . "/../src/infraestructure/config/dbconfig.php";

$dbConnection = createConnection($dbInfo["DBHOST"], $dbInfo["DBUSER"], $dbInfo["DBPASSWORD"], $dbInfo["DBNAME"], $dbInfo["DBSCHEMA"]);

require_once __DIR__ . "/../src/controller/controller.php";
?>
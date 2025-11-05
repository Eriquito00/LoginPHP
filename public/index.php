<?php
require_once __DIR__ . "/../app/databases/connections/connection.php";
$dbInfo = require_once __DIR__ . "/../app/config/dbconfig.php";

$dbConnection = createConnection($dbInfo["DBHOST"], $dbInfo["DBUSER"], $dbInfo["DBPASSWORD"], $dbInfo["DBNAME"], $dbInfo["DBSCHEMA"]);

require_once __DIR__ . "/../app/controllers/controller.php";
?>
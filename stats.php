<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProxyAPI - Stats</title>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: larger;
            text-align: center;
        }
    </style>
</head>
<body>
<?php

require("./lib/php/database.php");

$stmt = $pdo->prepare("SELECT * FROM ip_addresses_ps;");
$stmt->execute();
$totalCached = $stmt->rowCount();

echo "Total Cached: " . $totalCached  . "</br>";

$stmt = $pdo->prepare("SELECT DISTINCT country FROM ip_addresses_ps;");
$stmt->execute();
$countryCount = $stmt->rowCount();

echo "Countrys in Database: " . $countryCount  . "</br>";

$stmt = $pdo->prepare("SELECT DISTINCT org FROM ip_addresses_ps;");
$stmt->execute();
$orgCount = $stmt->rowCount();

echo "Orgs in Database: " . $orgCount  . "</br>";

$stmt = $pdo->prepare("SELECT DISTINCT isp FROM ip_addresses_ps;");
$stmt->execute();
$ispCount = $stmt->rowCount();

echo "ISPs in Database: " . $ispCount . "</br>";

?>
</body>
</html>
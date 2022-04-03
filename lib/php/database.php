<?php
$host = "127.0.0.1";
$name = "database_name";
$user = "mysql_username";
$passwort = "mysql_password";
try {
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $passwort);
} catch (PDOException $e) {
    echo "Ein Problem mit unserer Datenbank ist aufgetreten. Bitte versuche es in wenigen Minuten erneut.";
}

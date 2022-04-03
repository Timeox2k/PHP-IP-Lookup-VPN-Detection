<?php
require("./lib/php/database.php");

$createTable = "CREATE TABLE `ip_addresses_ps` (
	`id` INT(255) NOT NULL AUTO_INCREMENT,
	`ip` VARCHAR(255) NOT NULL,
	`city` VARCHAR(255) NOT NULL,
	`country` VARCHAR(255) NOT NULL,
	`asn` VARCHAR(255) NOT NULL,
	`isp` VARCHAR(255) NOT NULL,
	`vpn_result` VARCHAR(25) NOT NULL, 
    PRIMARY KEY (`id`)";

$stmt = $mysql->prepare($createTable);

echo "Done creating Table! </br>";
echo "Setup completed! </br>";

$stmt->execute();

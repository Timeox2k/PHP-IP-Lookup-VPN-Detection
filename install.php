<?php
require("./lib/php/database.php");

$table_ip_addresses_ps = "CREATE TABLE IF NOT EXISTS `ip_addresses_ps` (
	`id` INT(255) NOT NULL AUTO_INCREMENT,
	`ip` VARCHAR(255) NOT NULL,
	`city` VARCHAR(255) NOT NULL,
	`country` VARCHAR(255) NOT NULL,
	`asn` VARCHAR(255) NOT NULL,
	`isp` VARCHAR(255) NOT NULL,
	`vpn_result` VARCHAR(25) NOT NULL, 
    PRIMARY KEY (`id`)
	);";
	
$table_datacenter_asn = "CREATE TABLE IF NOT EXISTS `datacenter_asn` (
	`id` INT(255) NOT NULL AUTO_INCREMENT,
	`asn` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
	);";

$tables = [$table_ip_addresses_ps, $table_datacenter_asn];

echo "Creating tables... </br>";

foreach($tables as $t => $mysql)
{
	$stmt = $mysql->prepare($t);
	$stmt->execute();
}

echo "Done creating tables! </br>";
echo "Setup complete. </br>";

<?php
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');

if (isset($_GET["ip"]) && filter_var($_GET["ip"], FILTER_VALIDATE_IP)) {
    $ip = strip_tags(htmlspecialchars($_GET["ip"]));

    require("./vendor/autoload.php");
    $redis = new Predis\Client('tcp://127.0.0.1:6379');
    $cachedResult = $redis->get($ip);

    if ($cachedResult) {
        echo $cachedResult;
        exit;
    } else {
        require("./lib/php/database.php");
        $stmt = $pdo->prepare("SELECT * FROM ip_addresses_ps WHERE ip = :ip LIMIT 1");
        $stmt->bindParam(":ip", md5($ip));
        $stmt->execute();
        $ipcount = $stmt->rowCount();

        if ($ipcount == 0) {
            $urlIsVPN = "https://blackbox.ipinfo.app/lookup/" . $ip;
            $urlLookup = "http://ip-api.com/json/" . $ip;
            $json = file_get_contents($urlLookup);
            $json_data = json_decode($json, true);
            if (!isset($json_data["message"])) {
                $as = $json_data["as"];
                $city = $json_data["city"];
                $country = $json_data["country"];
                $lat = $json_data["lat"];
                $lon = $json_data["lon"];
                $isp = $json_data["isp"];
                $org = $json_data["org"];
                $vpn = file_get_contents($urlIsVPN);
                $manage['result'] = array(
                    'IP' => $ip,
                    'AS' => $as,
                    'City' => $city,
                    'Country' => $country,
                    'lat' => $lat,
                    'lon' => $lon,
                    'ISP' => $isp,
                    'org' => $org,
                    'VPN' => $vpn,
                );
            } else {
                echo "Invalid Request!";
                exit;
            }
            echo json_encode($manage);

            $stmt = $pdo->prepare("INSERT INTO ip_addresses_ps (IP,CITY,COUNTRY,LAT, LON, ASN,ISP, ORG, VPN_RESULT) VALUES (:ip, :city, :country, :lat, :lon, :asn, :isp, :org, :vpn_result);");
            $stmt->bindParam(":ip", md5($ip));
            $stmt->bindParam(":city", $city);
            $stmt->bindParam(":country", $country);
            $stmt->bindParam(":lat", $lat);
            $stmt->bindParam(":lon", $lon);
            $stmt->bindParam(":asn", $as);
            $stmt->bindParam(":isp", $isp);
            $stmt->bindParam(":vpn_result", $vpn);

            $stmt->execute();
        } else {
            $row = $stmt->fetch();

            $manage['result'] = array(
                'IP' => $ip,
                'AS' => $row["asn"],
                'City' => $row["city"],
                'Country' => $row["country"],
                'lat' => $row["lat"],
                'lon' => $row["lon"],
                'ISP' => $row["isp"],
                'org' => $row["org"],
                'VPN' => $row["vpn_result"]
            );
            echo json_encode($manage);
            $redis->set($ip, json_encode($manage));
            $redis->expire($ip, 300);
            exit;
        }
    }
} else {
    echo "IP not set.";
    exit();
}
# PHP-IP-Lookup-VPN-Detection
Lookup IPs (IPv4 + IPv6), store them in MySQL and Redis + check if the IP is a VPN/Proxy.

How to use it? 

Just upload it to your Webserver & open install.php with your Webbrowser.

After that, make sure to install Redis (https://github.com/redis/redis)

Then use Composer to retreive the needed packages.

Then open the index.php and add ?ip=1.1.1.1 to get the needed Informations of the IP as a JSON Response.

# PHP-IP-Lookup-VPN-Detection
Lookup IPs (IPv4 + IPv6), store them in MySQL and Redis + check if the IP is a VPN/Proxy.

## How to use it?
- Upload the files to your Webserver
- Open "install.php" in your Webbrowser
- Make sure to install [Redis](https://github.com/redis/redis)
- Retreive needed packages by using Composer
- open "index.php" in your Webbrowser
    - Add the getter "ip" in the url (e.g. https://your-url.io/?ip=1.1.1.1)
    - The IP Informations will be sent as a Response (JSON Response)

## Hint:
- Only non commercial use allowed
- Only 45 unique requests per minute from an IP address because of IP-API
    - if you go over the limit, your IP will get banned for 1 hour
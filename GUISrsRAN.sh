
sudo chmod -R 777 /var/www/html
sleep 1
echo "OK"

sudo cp epc.php error_ignore.php index.php style.css user.php /var/www/html
sleep 1

sudo chmod -R 777 /etc/srsran
sudo chmod -R 777 /var/www/html
sleep 1
echo "OK"

sudo systemctl start apache2
echo "Web GUI SrsRAN Berhasil diaktfifasi !"

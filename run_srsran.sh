#!/bin/bash

sudo systemctl start apache2
sleep 2
echo "===================================="
echo "webserver: Aktif"

sudo srsenb /etc/srsran/enb.conf > enb.log 2>&1 &
sleep 4
echo "SrsENB: Berjalan"

sudo srsepc /etc/srsran/epc.conf > epc.log 2>&1 &
echo "SrsEPC: Berjalan"
echo "===================================="

echo "Program SrsRAN Berjalan"
echo "Untuk melihat log jalankan perintah"
echo " -EPC: tail -f epc.log"
echo " -ENB: tail -f enb.log"

echo "============================================"
echo "untuk menghentikan SrsRAN jalankan perintah"
echo "./stop_srsran.sh"
echo "============================================"

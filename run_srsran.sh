#!/bin/bash

sudo systemctl start apache2
echo "============================================"
echo "WebGUISrsRan: Aktif"


sudo srsepc /etc/srsran/epc.conf > epc.log 2>&1 &
echo "SrsEPC: Berjalan"

sudo srsenb /etc/srsran/enb.conf > enb.log 2>&1 & 
echo "SrsENB: Berjalan"

echo "Program SrsRAN Berjalan"
echo "Tunggu sampai indikator USRP rx/tx antena menyala"
echo "============================================"
echo "Untuk melihat log jalankan perintah"
echo " -EPC: tail -f epc.log"
echo " -ENB: tail -f enb.log"

echo "============================================"
echo "untuk menghentikan SrsRAN jalankan perintah"
echo "./stop_srsran.sh"
echo "============================================"

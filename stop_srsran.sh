#!/bin/bash

echo "Menghentikan srsENB"
sudo pkill srsenb

echo "Menghentikan srsEPC"
sudo pkill srsepc

echo "Semua proses SrsRAN berhasil dihentikan"

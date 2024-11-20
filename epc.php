<?php

require "error_ignore.php";

$ok = false;

if (isset($_POST["submitEpc"])) {
    // mme
    $mme_mme_code = $_POST["mme_code"];
    $mme_mme_group = $_POST["mme_group"];
    $mme_tac = $_POST["tac"];
    $mme_mcc = $_POST["mcc"];
    $mme_mnc = $_POST["mnc"];
    $mme_mme_bind_addr = $_POST["mme_bind_addr"];
    $mme_apn = $_POST["apn"];
    $mme_dns_addr = $_POST["dns_addr"];
    $mme_encryption_algo = $_POST["encryption_algo"];
    $mme_integrity_algo = $_POST["integrity_algo"];
    $mme_paging_timer = $_POST["paging_timer"];
    $mme_request_imeisv = $_POST["request_imeisv"];
    $mme_lac = $_POST["lac"];
    $mme_full_net_name = $_POST["full_net_name"];

    // spgw
    $spgw_gtpu_bind_addr = $_POST["gtpu_bind_addr"];
    $spgw_sgi_if_addr = $_POST["sgi_if_addr"];
    $spgw_sgi_if_name = $_POST["sgi_if_name"];
    $spgw_max_paging_queue = $_POST["max_paging_queue"];

    $file = "/etc/srsran/epc.conf";
    $data = "[mme] \nmme_code = $mme_mme_code \nmme_group = $mme_mme_group \ntac = $mme_tac" . "\nmcc = " . $mme_mcc . "\nmnc = " . $mme_mnc . "\nmme_bind_addr = $mme_mme_bind_addr \napn = " .  $mme_apn . "\ndns_addr = $mme_dns_addr \nencryption_algo = $mme_encryption_algo \nintegrity_algo = $mme_integrity_algo \npaging_timer = $mme_paging_timer \nrequest_imeisv = $mme_request_imeisv \nlac = $mme_lac \nfull_net_name = $mme_full_net_name \n\n[hss] \ndb_file = /home/robsonema/.config/srsran/user_db.csv \n\n[spgw] \ngtpu_bind_addr = $spgw_gtpu_bind_addr \nsgi_if_addr = " . $spgw_sgi_if_addr . "\nsgi_if_name = $spgw_sgi_if_name \nmax_paging_queue = $spgw_max_paging_queue \n\n[pcap] \nenable = false \nfilename = /tmp/epc.pcap \n\n[log] \nall_level = debug \nall_hex_limit = 32 \nfilename = /tmp/epc.log";
    $handler = fopen($file, "w");
    if (file_exists($file)) {
        fwrite($handler, $data);
        fclose($handler);
        $ok = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPC Configuration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="link__container">
        <a href="index.php" class="link__item">ENB Configuration</a>
        <a href="epc.php" class="link__item" style="background-color: blue;">EPC Configuration</a>
        <a href="user.php" class="link__item">User Configuration</a>
    </div>
    <?php
    if ($ok) {
        echo "<p>Config berhasil</p>";
    }
    ?>
    <form action="" method="post" class="container">
        <h2>EPC Configuration</h2>
        <h3>MME</h3>
        <input type="text" placeholder="masukkan mme code" name="mme_code" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 0x1b</label>
        <br>
        <input type="text" placeholder="masukkan mme group" name="mme_group" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 0x0001</label>
        <br>
        <input type="text" placeholder="masukkan tac" name="tac" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 0x0008</label>
        <br>
        <input type="text" placeholder="masukkan mcc" name="mcc" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 510</label>
        <br>
        <input type="text" placeholder="masukkan mnc" name="mnc" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 95</label>
        <br>
        <input type="text" placeholder="masukkan mme bind address" class="input" name="mme_bind_addr" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 127.0.1.100</label>
        <br>
        <input type="text" placeholder="masukkan apn" name="apn" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: test</label>
        <br>
        <input type="text" placeholder="masukkan dns address" name="dns_addr" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 8.8.8.8</label>
        <br>
        <div class="flex">
            <label for="encryption_algo" class="input__label" style="width: 50%;">Encryption Algo</label>
            <select name="encryption_algo" class="input input__select" id="encryption_algo">
                <option value="EEA0">EEA0</option>
                <option value="EEA1">EEA1</option>
            </select>
        </div>
        <br>
        <div class="flex">
            <label for="integrity_algo" class="input__label" style="width: 50%;">Integrity Algo</label>
            <select name="integrity_algo" class="input input__select" id="integrity_algo">
                <option value="EIA1">EIA1</option>
            </select>
        </div>
        <br>
        <input type="text" placeholder="masukkan paging timer" name="paging_timer" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 2</label>
        <br>
        <div class="flex">
            <label for="request_imeisv" class="input__label" style="width: 50%;">request imeisv</label>
            <select name="request_imeisv" id="request_imeisv" class="input input__select" required>
                <option value="false">False</option>
                <option value="true">True</option>
            </select>
        </div>
        <br>
        <input type="text" placeholder="masukkan lac" name="lac" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 0x0009</label>
        <br>
        <input type="text" placeholder="masukkan nama network" name="full_net_name" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: SrsRANCell</label>
        <br><br>
        <h3>SPGW</h3>
        <input type="text" placeholder="masukkan gtpu bind address" name="gtpu_bind_addr" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 127.0.1.100</label>
        <br>
        <input type="text" placeholder="masukkan ip address" name="sgi_if_addr" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 172.15.0.1</label>
        <br>
        <input type="text" placeholder="masukkan sgi if name" name="sgi_if_name" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Default: srs_spgw_sgi</label>
        <br>
        <input type="text" placeholder="masukkan max paging queue" name="max_paging_queue" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Default: 100</label>
        <br><br>
        <button name="submitEpc" class="btn-submit">Submit</button>
    </form>
</body>

</html>

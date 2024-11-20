<?php

require "error_ignore.php";

$ok = false;

if (isset($_POST["submitEnb"])) {
    // enb
    $enb_id = $_POST["enb_id"];
    $mcc_enb = $_POST["mcc_enb"];
    $mnc_enb = $_POST["mnc_enb"];
    $enb_mme_addr = $_POST["mme_addr"];
    $enb_gtp_bind_addr = $_POST["gtp_bind_addr"];
    $enb_s1c_bind_addr = $_POST["s1c_bind_addr"];
    $enb_s1c_bind_port = $_POST["s1c_bind_port"];
    $n_prb = $_POST["n_prb"];
    $tm = $_POST["tm"];
    $nof_ports = $_POST["nof_ports"];

    //rf
    $rf_dl_earfcn = $_POST["dl_earfcn"];
    $rf_tx_gain = $_POST["tx_gain"];
    $rf_rx_gain = $_POST["rx_gain"];
    $rf_device_name = $_POST["device_name"];
    $rf_device_args = $_POST["device_args"];

    $gui_enabled = $_POST["enabled"];

    $args_data = "";

    if ($rf_device_args === "mimo") {
        $args_data = "num_recv_frames=64,num_send_frames=64,master_clock_rate=15.36e6";
    } else if ($rf_device_args === "25prb") {
        $args_data = "send_frame_size=512,recv_frame_size=512";
    }

    $enb_data = "[enb]\nenb_id = $enb_id\nmcc = $mcc_enb\nmnc = $mnc_enb\nmme_addr = $enb_mme_addr\ngtp_bind_addr = $enb_gtp_bind_addr\ns1c_bind_addr = $enb_s1c_bind_addr\ns1c_bind_port = $enb_s1c_bind_port\nn_prb = $n_prb\ntm = $tm\nnof_ports = $nof_ports\n\n[enb_files]\nsib_config = sib.conf\nrr_config  = rr.conf\nrb_config = rb.conf\n\n[rf]\ndl_earfcn = $rf_dl_earfcn\ntx_gain = $rf_tx_gain\nrx_gain = $rf_rx_gain\ndevice_name = $rf_device_name\n#device_args = $args_data \n\n[pcap]\n\n[log]\nall_level = debug\nall_hex_limit = 32\nfilename = /tmp/enb.log\nfile_max_size = -1\n\n[gui]\nenable = $gui_enabled";

    $file_enb = "/etc/srsran/enb.conf";
    $handler_enb = fopen($file_enb, "w");
    fwrite($handler_enb, $enb_data);
    fclose($handler_enb);
    $ok = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENB Configuration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="link__container">
        <a href="index.php" class="link__item" style="background-color: blue;">ENB Configuration</a>
        <a href="epc.php" class="link__item">EPC Configuration</a>
        <a href="user.php" class="link__item">User Configuration</a>
    </div>
    <?php
    if ($ok) {
        echo "<p>Config Berhasil</p>";
    }
    ?>
    <form action="" method="post" class="container">
        <h2>ENB Configuration</h2>
        <h3 class="subtitle-conf">ENB</h3>
        <input type="text" name="enb_id" id="enb_id" placeholder="masukkan enb id" class="input" required>
		<label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 0x19b</label>
		<br>
        <input type="text" name="mcc_enb" placeholder="masukkan mcc" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 510</label>
        <br>
        <input type="text" name="mnc_enb" placeholder="masukan mnc" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 95</label>
        <br>
        <input type="text" name="mme_addr" placeholder="masukkan mme address" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 127.0.1.100</label>
        <br>
        <input type="text" name="gtp_bind_addr" placeholder="masukkan gtp bind address" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 127.0.1.1</label>
        <br>
        <input type="text" name="s1c_bind_addr" placeholder="masukkan s1c bind address" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 127.0.1.1</label>
        <br>
        <input type="text" name="s1c_bind_port" placeholder="masukkan s1c bind port" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Default: 0</label>
        <br>
        <div class="flex">
            <label for="n_prb" class="input__label" style="width: 50%;">PRB : </label>
            <select name="n_prb" id="n_prb" class="input input__select" required>
                <option value="6">6</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="75">75</option>
            </select>
        </div>
        <br>
        <div class="flex">
            <label for="tm" class="input__label" style="width: 50%;">Transmision Mode : </label>
            <select name="tm" id="tm" class="input input__select" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <br>
        <div class="flex">
            <label for="nof_ports" class="input__label" style="width: 50%;">Number of TX Port : </label>
            <select name="nof_ports" id="nof_ports" class="input input__select" required>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>

        <h3>RF</h3>
        <input type="text" name="dl_earfcn" placeholder="masukkan dl earfcn" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 1575</label>
        <br>
        <input type="text" name="tx_gain" placeholder="masukkan tx gain" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 80</label>
        <br>
        <input type="text" name="rx_gain" placeholder="masukkan rx gain" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 40</label>
        <br>
        <div class="flex">
            <label for="device_name" class="input__label" style="width: 50%;">UHD Device Name</label>
            <select name="device_name" class="input input__select" id="device_name">
                <option value="uhd">uhd</option>
            </select>
        </div>
        <br>
      <!--  <div class="flex">
            <label for="device_args" class="input__label" style="width: 50%;">Device Args</label>
            <select name="device_args" class="input input__select" id="device_args">
                <option value="25prb">25 PRB</option>
                <option value="mimo">MIMO & (> 25 PRB)</option>
            </select>
        </div>
        <br>
	-->
        <h3>GUI</h3>
        <div class="flex">
            <label for="enabled" class="input__label" style="width: 50%;">Enabled : </label>
            <select name="enabled" id="enabled" class="input input__select" required>
                <option value="true">True</option>
                <option value="false">False</option>
            </select>
        </div>
        <br>
        <br>
        <button name="submitEnb" class="btn-submit">Submit</button>
    </form>

</body>

</html>

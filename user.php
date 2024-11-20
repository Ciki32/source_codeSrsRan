<?php

require "error_ignore.php";

$ok = false;

if (isset($_POST["submitUser"])) {
    $user = $_POST["name_user"];
    $auth = $_POST["auth_user"];
    $imsi = $_POST["imsi_user"];
    $key_user = $_POST["key_user"];
    $op_type_user = $_POST["op_type_user"];
    $opc = $_POST["opc"];
    $amf = $_POST["amf"];
    $sqn = $_POST["sqn"];
    $qci = $_POST["qci"];
    $ip_alloc = $_POST["ip_alloc"];

    $data = "\n$user,$auth,$imsi,$key_user,$op_type_user,$opc,$amf,$sqn,$qci,$ip_alloc";

    $user_file = "/etc/srsran/user_db.csv";

    file_put_contents($user_file, $data, FILE_APPEND);
    $ok = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Configuration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="link__container">
        <a href="index.php" class="link__item">ENB Configuration</a>
        <a href="epc.php" class="link__item">EPC Configuration</a>
        <a href="user.php" class="link__item" style="background-color: blue;">User Configuration</a>
    </div>
    <?php
    if ($ok) {
        echo "<p>User Berhasil Ditambahkan</p>";
    }
    ?>
    <form action="" method="post" class="container">
        <h2>Add User</h2>
        <input type="text" name="name_user" placeholder="masukkan nama user" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: ue5</label>
        <br>
        <input type="text" name="auth_user" placeholder="masukkan auth" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Opsi: mil,xor</label>
        <br>
        <input type="text" name="imsi_user" placeholder="masukkan IMSI" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 510950000000005</label>
        <br>
        <input type="text" name="key_user" placeholder="masukkan Key" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 00112233445566778899aabbccddeeff</label>
        <br>
        <input type="text" name="op_type_user" placeholder="masukkan Op Type User" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Default: opc</label>
        <br>
        <input type="text" name="opc" placeholder="masukkan OP/OPC" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 63bfa50ee6523365ff14c1f45f88737d</label>
        <br>
        <input type="text" name="amf" placeholder="masukkan AMF" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 9003</label>
        <br>
        <input type="text" name="sqn" placeholder="masukkan SQN" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 0000000018c2</label>
        <br>
        <input type="text" name="qci" placeholder="masukkan QCI" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*Contoh: 9</label>
        <br>
        <input type="text" name="ip_alloc" placeholder="masukkan ip alloc" class="input" required>
        <label style="text-align: left; display: block; font-size: 12px; font-style: italic;">*default: dynamic</label>
        <br><br>
        <button name="submitUser" class="btn-submit">Submit User</button>
    </form>
</body>

</html>

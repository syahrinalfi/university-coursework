<?php

include_once("../connect_db.php");
$result = mysqli_query($mysqli, "SELECT * FROM responden ORDER BY id_responden ASC");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Responden</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1300px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container a {
            display: inline-block;
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #ebebeb;
            color: #333333;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        .container a:hover {
            background-color: #cccccc;
        }

        .container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .container th,
        .container td {
            padding: 10px;
            text-align: left;
            border: 1px solid #cccccc;
        }

        .container th {
            background-color: #ebebeb;
            font-weight: bold;
        }

        .container tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .container h2{
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="admin.php">Kembali</a>
        <a href="edit_responden_all.php">Ganti ID Survei (Semua)</a>
        <a href="kirim_link_survei.php">Kirim Link Survei ke Semua Responden</a>
        <h2>Data Responden</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Responden</th>
                <th>Alamat Email</th>
                <th>Nomor Telepon</th>
                <th>ID Survei yang Akan Diisi</th>
                <th>Update</th>
            </tr>
            <?php
            while ($data_responden = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $data_responden['id_responden'] . "</td>";
                echo "<td>" . $data_responden['nama_responden'] . "</td>";
                echo "<td>" . $data_responden['email_responden'] . "</td>";
                echo "<td>" . $data_responden['telepon_responden'] . "</td>";
                echo "<td>" . $data_responden['id_survei'] . "</td>";
                echo "<td><a href='edit_responden.php?id_responden=$data_responden[id_responden]'>Edit</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

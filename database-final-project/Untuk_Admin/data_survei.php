<?php

include_once("../connect_db.php");
$result = mysqli_query($mysqli, "SELECT * FROM survei ORDER BY id_survei ASC");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Survei</title>
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
        .container h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="admin.php">Kembali</a>
        <h2>Data Survei</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Judul Survei</th>
                <th>Tanggal Pembuatan</th>
                <th>Data</th>
            </tr>
            <?php
            while ($survei_data = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $survei_data['id_survei'] . "</td>";
                echo "<td>" . $survei_data['judul_survei'] . "</td>";
                echo "<td>" . $survei_data['tanggal_pembuatan'] . "</td>";
                echo "<td><a href='data_pertanyaan.php?id_survei=$survei_data[id_survei]'>Lihat Pertanyaan</a> | <a href='data_jawaban.php?id_survei=$survei_data[id_survei]'>Lihat Jawaban Responden</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

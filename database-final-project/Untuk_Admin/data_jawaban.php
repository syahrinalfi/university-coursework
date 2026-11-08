<?php

include_once("../connect_db.php");
$id_survei = $_GET['id_survei'];
$result = mysqli_query($mysqli, "SELECT * FROM jawaban WHERE id_survei='$id_survei'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Jawaban</title>
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
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="data_survei.php">Kembali</a>
        <h2>Data Jawaban</h2>
        <table>
            <tr>
                <th>ID Responden</th>
                <th>Pertanyaan 1</th>
                <th>Pertanyaan 2</th>
                <th>Pertanyaan 3</th>
                <th>Pertanyaan 4</th>
                <th>Pertanyaan 5</th>
                <th>Pertanyaan 6</th>
            </tr>
            <?php
            while ($data_jawaban = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $data_jawaban['id_responden'] . "</td>";
                echo "<td>" . $data_jawaban['q1'] . "</td>";
                echo "<td>" . $data_jawaban['q2'] . "</td>";
                echo "<td>" . $data_jawaban['q3'] . "</td>";
                echo "<td>" . $data_jawaban['q4'] . "</td>";
                echo "<td>" . $data_jawaban['q5'] . "</td>";
                echo "<td>" . $data_jawaban['q6'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

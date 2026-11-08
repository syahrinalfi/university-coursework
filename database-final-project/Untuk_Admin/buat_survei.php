<?php
    include_once("../connect_db.php");

    if(isset($_POST["submit"])) {
        $tanggal = date("Y-m-d");

        $judul = $_POST["judul"];
        $q1 = $_POST["q1"];
        $q2 = $_POST["q2"];
        $q3 = $_POST["q3"];
        $q4 = $_POST["q4"];
        $q5 = $_POST["q5"];
        $q6 = $_POST["q6"];

        $result = mysqli_query($mysqli, "INSERT INTO survei(judul_survei, tanggal_pembuatan) VALUES('$judul', '$tanggal')");
        $id_result = mysqli_query($mysqli, "SELECT id_survei FROM survei WHERE judul_survei='$judul'");
        $row = mysqli_fetch_assoc($id_result);
        $id = $row['id_survei'];
        $result = mysqli_query($mysqli, "INSERT INTO pertanyaan(id_survei, q1, q2, q3, q4, q5, q6) VALUES('$id', '$q1', '$q2', '$q3', '$q4', '$q5', '$q6')");
        header("Location: admin.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Buat Survei</title>
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
            width: 80%;
            max-width: 800px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }
        
        .container a {
            display: block;
            margin-bottom: 10px;
            padding: 10px 15px;
            background-color: #ebebeb;
            color: #333333;
            text-decoration: none;
            border-radius: 3px;
            transition: background-color 0.3s ease;
            text-align: center;
            font-size: 16px;
        }
        
        .container a:hover {
            background-color: #cccccc;
        }

        .container h2 {
            margin-bottom: 20px;
        }

        .container form label {
            display: block;
            margin-top: 10px;
        }

        .container form input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 3px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .container form .form-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .container form input[type="submit"] {
            padding: 10px 15px;
            background-color: #333333;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        .container form input[type="submit"]:hover {
            background-color: #555555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pembuatan Survei</h2>
        <form action="buat_survei.php" method="post">

            <label for="judul">Judul Survei</label>
            <input type="text" name="judul" id="judul" required>
            
            <label for="q1">Pertanyaan 1:</label>
            <input type="text" name="q1" id="q1" required>

            <label for="q2">Pertanyaan 2:</label>
            <input type="text" name="q2" id="q2" required>

            <label for="q3">Pertanyaan 3:</label>
            <input type="text" name="q3" id="q3" required>

            <label for="q4">Pertanyaan 4:</label>
            <input type="text" name="q4" id="q4" required>

            <label for="q5">Pertanyaan 5:</label>
            <input type="text" name="q5" id="q5" required>

            <label for="q6">Pertanyaan 6:</label>
            <input type="text" name="q6" id="q6" required>

            <div class="form-buttons">
                <a href="admin.php">Kembali</a>
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>

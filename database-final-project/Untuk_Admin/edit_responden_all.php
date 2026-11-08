<?php

    include_once("../connect_db.php");
    $responden = mysqli_query($mysqli, "SELECT * FROM responden ORDER BY id_responden ASC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit</title>
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
            max-width: 400px;
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
        }

        .container a:hover {
            background-color: #cccccc;
        }

        .container form {
            margin-top: 20px;
        }

        .container label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        .container input[type="text"] {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .container .submit-btn {
            text-align: center;
            margin-top: 20px;
        }

        .container input[type="submit"] {
            background-color: #000000;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container input[type="submit"]:hover {
            background-color: #333333;
        }
    </style>
</head>

<body>
    <div class="container">
        <form class="" action="edit_responden_all.php" method="post">
            <label for="">Masukkan ID Survei</label>
            <input type="text" name="id" required>
            <div class="submit-btn">
                <a href="data_responden.php">Kembali</a>
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            while ($user_data = mysqli_fetch_array($responden)) {
                $result = mysqli_query($mysqli, "UPDATE responden SET id_survei='$id'");
            }
            header("Location: data_responden.php");
        }
        ?>
    </div>
</body>

</html>
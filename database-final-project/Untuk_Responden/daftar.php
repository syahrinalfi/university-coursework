<?php
    include_once("../connect_db.php");

    if(isset($_POST["submit"])) {
        $nama = $_POST["nama"];
        $telepon = $_POST["telepon"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $cek = mysqli_query($mysqli, "SELECT * FROM responden WHERE email_responden='$email'");
        if(mysqli_num_rows($cek) > 0){
            header("Location: daftar.php");
            echo "Email Sudah Terdaftar";
        }
        else{
            $result = mysqli_query($mysqli, "INSERT INTO responden(nama_responden, email_responden, password_responden, telepon_responden, id_survei) VALUES('$nama', '$email', '$password', '$telepon', '1')");
            header("Location: ../welcome.php");
        }
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
            max-width: 600px;
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
            text-align: center;
        }

        .container form label {
            font-weight: bold;
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

        .container form input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 3px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .container form input[type="password"] {
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
        <h2>Sign Up</h2>
        <form action="daftar.php" method="post">

            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" required>
            
            <label for="telepon">Nomor Telepon</label>
            <input type="text" name="telepon" id="telepon" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">


            <div class="form-buttons">
                <a href="../welcome.php">Kembali</a>
                <input type="submit" name="submit" value="Daftar">
            </div>
        </form>
    </div>
</body>
</html>

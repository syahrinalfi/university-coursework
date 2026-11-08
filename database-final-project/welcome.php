<?php
    include_once("connect_db.php");
    $result = mysqli_query($mysqli, "SELECT * FROM responden ORDER BY id_responden ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Masuk</title>
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
            width: 400px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .container label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            margin-left: 10px;
            text-align: left;
        }

        .container input[type="email"] {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 16px;
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
        <h2>Log In</h2>
        <form class="" action="welcome.php" method="post">
            <label for="">Email</label>
            <input type="email" name="email" value="" required><br>
            <label for="">Password</label>
            <input type="password" name="password" required><br><br>
            <input type="submit" name="submit" value="Masuk">
        </form>
        <br>
        <td>Belum Punya Akun? <a href="Untuk_Responden/daftar.php">Daftar</a></td>
        <?php
            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                while ($user_data = mysqli_fetch_array($result)) {
                    if($user_data['email_responden'] == $email && $user_data['password_responden'] == $password) {
                        if($user_data['id_responden'] == '1'){
                            header("Location: Untuk_Admin/admin.php");
                        }
                        else {
                        header("Location: Untuk_Responden/survei.php?id_responden=$user_data[id_responden]");
                        }
                    }
                }
            }
        ?>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
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

        .container a {
            display: block;
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #ebebeb;
            color: #333333;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .container a:hover {
            background-color: #cccccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href='data_responden.php'>Data Responden</a>
        <a href='data_survei.php'>Data Survei</a>
        <a href='buat_survei.php'>Buat Survei</a>
        <a href='../welcome.php'>Keluar</a>
    </div>
</body>
</html>

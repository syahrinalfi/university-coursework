<?php
    include_once("../connect_db.php");

    if (isset($_POST["update"]))
    {
        $id = $_POST['id'];
        $survei = $_POST['id_survei'];
        $result = mysqli_query($mysqli, "UPDATE responden SET id_survei='$survei' WHERE id_responden=$id");
        header("Location: data_responden.php");
    }
?>

<?php
    $id_responden = $_GET["id_responden"];
    $result = mysqli_query($mysqli, "SELECT * FROM responden WHERE id_responden=$id_responden");

    while ($data_responden = mysqli_fetch_array($result))
    {
        $nama = $data_responden["nama_responden"];
        $email = $data_responden["email_responden"];
        $telepon = $data_responden["telepon_responden"];
        $id_survei = $data_responden["id_survei"];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>EDIT DATA RESPONDEN</title>
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
            width: 500px;
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

        .container table {
            width: 100%;
        }

        .container td {
            padding: 10px;
        }

        .container input[type="text"] {
            width: 100%;
            padding: 10px;
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
        <form name="update_responden" method="post" action="edit_responden.php">
            <table>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id_responden ?>">
                    <td>Nama</td>
                    <td><input type="text" name="name" value="<?php echo $nama; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="<?php echo $email; ?>" readonly></td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td><input type="text" name="telepon" value="<?php echo $telepon; ?>" readonly></td>
                </tr>
                <tr>
                    <td>ID Survei</td>
                    <td><input type="text" name="id_survei" value="<?php echo $id_survei; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="data_responden.php">Kembali</a>
                        <input type="submit" name="update" value="Update" style="float: right;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>

<?php
    $id_responden = $_GET['id_responden'];
    include_once("../connect_db.php");
    $responden = mysqli_query($mysqli, "SELECT * FROM responden ORDER BY id_responden ASC");
    $survei = mysqli_query($mysqli, "SELECT * FROM survei ORDER BY id_survei ASC");
    $pertanyaan = mysqli_query($mysqli, "SELECT * FROM pertanyaan ORDER BY id_survei ASC");
    $jawaban = mysqli_query($mysqli, "SELECT * FROM jawaban ORDER BY id_jawaban ASC");

    while($data_responden = mysqli_fetch_array($responden)) {
        if($data_responden['id_responden'] == $id_responden) {
            //Mengambil Nama Responden dan Mengambil ID Survei
            $nama = $data_responden['nama_responden'];
            $id_survei = $data_responden['id_survei'];
            //Mengambil Nama Survei
            while($data_survei = mysqli_fetch_array($survei)){
                if($data_survei['id_survei'] == $id_survei){
                    $nama_survei = $data_survei['judul_survei'];
                    break;
                }
            }
            while($data_pertanyaan = mysqli_fetch_array($pertanyaan)){
                if($data_pertanyaan['id_survei'] == $id_survei){
                    $id_pertanyaan = $data_pertanyaan['id_pertanyaan'];
                    $q1 = $data_pertanyaan['q1'];
                    $q2 = $data_pertanyaan['q2'];
                    $q3 = $data_pertanyaan['q3'];
                    $q4 = $data_pertanyaan['q4'];
                    $q5 = $data_pertanyaan['q5'];
                    $q6 = $data_pertanyaan['q6'];
                    break;
                }
            }

            while($data_jawaban = mysqli_fetch_array($jawaban)){
                if($data_jawaban['id_responden'] == $id_responden){
                    if($data_jawaban['id_survei'] == $id_survei){
                        header("Location: survei_done.php");
                    }
                }
            }
            break;
        } 
    }
?>

<?php
    if (isset($_POST['submit'])) {
        $j1 = $_POST['q1'];
        $j2 = $_POST['q2'];
        $j3 = $_POST['q3'];
        $j4 = $_POST['q4'];
        $j5 = $_POST['q5'];
        $j6 = $_POST['q6'];
        $id_responden = $_POST['id_responden'];
        $id_survei = $_POST['id_survei'];

        $result = mysqli_query($mysqli, "INSERT INTO jawaban(id_responden,id_survei,q1,q2,q3,q4,q5,q6) VALUES('$id_responden','$id_survei','$j1','$j2','$j3','$j4','$j5','$j6')");
        header("Location: survei_done.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Survei</title>
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
        }

        .container h2,
        .container h3 {
            margin-bottom: 20px;
            color: #333333;
        }

        .container form label {
            display: block;
            margin-top: 10px;
            color: #333333;
        }

        .container form input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 3px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .form-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        }

        .form-buttons .back-button {
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
        
        .form-buttons .back-button:hover {
            background-color: #cccccc;
        }

        .form-buttons .submit-button {
            padding: 10px 15px;
            background-color: #333333;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .form-buttons .submit-button:hover {
            background-color: #555555;
        }

        .container form input[type="submit"] {
            padding: 10px 15px;
            background-color: #333333;
            color: #ffffff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .container form input[type="submit"]:hover {
            background-color: #555555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Survei: <?php echo $nama_survei; ?></h2>
        <h3>Nama Responden: <?php echo $nama; ?></h3>

        <form action="survei.php" method="post">
            <input type="hidden" name="id_responden" value="<?php echo $id_responden; ?>">
            <input type="hidden" name="id_survei" value="<?php echo $id_survei; ?>">
            <input type="hidden" name="id_pertanyaan" value="<?php echo $id_pertanyaan; ?>">

            <label for="q1"><?php echo $q1; ?></label>
            <input type="text" name="q1" id="q1" required>

            <label for="q2"><?php echo $q2; ?></label>
            <input type="text" name="q2" id="q2" required>

            <label for="q3"><?php echo $q3; ?></label>
            <input type="text" name="q3" id="q3" required>

            <label for="q4"><?php echo $q4; ?></label>
            <input type="text" name="q4" id="q4" required>

            <label for="q5"><?php echo $q5; ?></label>
            <input type="text" name="q5" id="q5" required>

            <label for="q6"><?php echo $q6; ?></label>
            <input type="text" name="q6" id="q6" required>

            <div class="form-buttons">
                <a href="../welcome.php" class="back-button">Log Out</a>
                <input type="submit" name="submit" value="Submit" class="submit-button">
            </div>

        </form>
    </div>
</body>
</html>


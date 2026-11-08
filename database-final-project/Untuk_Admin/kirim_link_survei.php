<?php
include_once("../connect_db.php");

// Mendapatkan data responden
$result = mysqli_query($mysqli, "SELECT * FROM responden");

// Mengirim email ke setiap responden
while ($data_responden = mysqli_fetch_array($result)) {
    $to = $data_responden['email_responden']; // Alamat email responden
    $subject = "Survei Baru"; // Subjek email
    $message = "Halo " . $data_responden['nama_responden'] . ",\n\nSilakan isi survei dengan mengklik tautan berikut: [TAUTAN_SURVEI]"; // Isi email, ganti [MASUKKAN_TAUTAN_SURVEI] dengan tautan survei yang sesuai

    // Mengirim email
    $headers = "From: your_email@example.com"; // Ganti dengan alamat email Anda
    mail($to, $subject, $message, $headers);
}

echo "Email survei telah berhasil dikirim ke semua responden.";
?>
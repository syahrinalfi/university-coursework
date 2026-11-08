<?php
    session_start();
    $databaseHost = 'localhost';
    $username = 'root';
    $password = '';
    $databaseName = 'tugas_besar';

    $mysqli = mysqli_connect($databaseHost, $username, $password, $databaseName);

?>
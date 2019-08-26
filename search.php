<?php

$idParkir = $_GET['idParkir'];

$file = file_get_contents('database.json');
$data = json_decode($file, TRUE);

foreach ($data as $d) {
    if ($d['id'] === $idParkir) {
        session_start();
        $_SESSION['idDataParkir'] = $idParkir;
        $_SESSION['jamMasukDataParkir'] = $d['jamMasuk'];
    }
}

header('location: index.php');

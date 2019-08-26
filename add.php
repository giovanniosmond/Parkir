<?php

$file = file_get_contents('database.json');
$data = json_decode($file, TRUE);
date_default_timezone_set('Asia/Jakarta');

$id = uniqid();
$jamMasuk = date("H:i:s");

$input = array(
    'id' => $id,
    'jamMasuk' => $jamMasuk,
    'platNo' => "0",
    'jamKeluar' => "0",
    'biaya' => "0"
);

$data[] = $input;
//encode back to json
$jsonfile = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('database.json', $jsonfile);

session_start();
$_SESSION['id'] = $id;
$_SESSION['jamMasuk'] = $jamMasuk;

header('location: index.php');

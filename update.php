<?php

$idParkir = $_GET['idDataParkir'];
$jamMasukParkir = $_GET['jamMasukDataParkir'];
$jamKeluarParkir = $_GET['jamKeluarDataParkir'];
$platNo = $_GET['platNo'];

$time = $jamKeluarParkir - $jamMasukParkir;
if ($time <= 2 && $time > 0) {
    $price = 2000;
} elseif ($time <0) {
    $time = (24 - $jamMasukParkir) + $jamKeluarParkir ;
    $price = 2000 + ($time*500);
    echo $time;
}else {
    $time = $time - 2;
    $price = 2000 + ($time*500);
}

$file = file_get_contents('database.json');
$data = json_decode($file, TRUE);
session_start();

foreach ($data as $key => $d) {
    if ($d['id'] === $idParkir) {        
        $data[$key]['platNo'] = $platNo;        
        $data[$key]['jamMasuk'] = $jamMasukParkir;
        $data[$key]['jamKeluar'] = $jamKeluarParkir;
        $data[$key]['biaya'] = $price;
        
        $_SESSION['plat'] = $platNo;
    }
}

$jsonfile = json_encode($data, JSON_PRETTY_PRINT);
$file = file_put_contents('database.json', $jsonfile);


$_SESSION['time'] = $time;
$_SESSION['price'] = $price;

header('location: index.php');
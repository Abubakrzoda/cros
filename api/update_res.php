<?php

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'web2606_petruhin';

$link = mysqli_connect(
    $DB_HOST,
    $DB_USER,
    $DB_PASS,
    $DB_NAME
);

$sql = "UPDATE results SET CROSS_WIN={$data['cross']}, ZERO_WIN={$data['zero']} WHERE ID={$data['id']};";

$result = mysqli_query($link, $sql);

var_dump(mysqli_error($link));

$res = [];

if($result){
    $res['success'] = true;
}
else{
    $res['success'] = false;
    $res['error'] = 'Обновить результаты не удалось!';
}

mysqli_close($link);

die(json_encode($res));
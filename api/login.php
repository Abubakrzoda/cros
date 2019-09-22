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

$sql = "SELECT * FROM users WHERE LOGIN='{$data['login']}' AND PASSWORD='{$data['password']}';";

$result = mysqli_query($link, $sql);

$results = [];

if($user = mysqli_fetch_assoc($result)){
    $sql = "SELECT * FROM results WHERE USER_ID={$user['ID']};";

    $result = mysqli_query($link, $sql);

    if($res = mysqli_fetch_assoc($result)){

        $results['cross'] = $res['CROSS_WIN'];
        $results['zero'] = $res['ZERO_WIN'];
        $results['res_id'] = $res['ID'];
    }
    else{
        $results['error'] = 'Результаты не найдены!';
    }
}
else{
    $results['error'] = 'Пользователь не найден!';
}

mysqli_close($link);

die(json_encode($results));
<?php
    require_once ('helpers.php');
    require_once ('function.php');
    require_once ('init.php');

//    $detail_lot = include_template('lot.php' ,[
//        'lots' => lot_list($con)
//    ]);
$nav = include_template('categoriya.php',['categories' => category_list($con)]);
$get_id = $_GET['id'] ?? -1;


$lots = lot_detail($con, $get_id);

if (http_response_code() === 404) {
    $detail_lot = include_template('404.php',['nav' => $nav]);
}else{
    $detail_lot = include_template('lot.php', ['nav' => $nav,
    'lots' => $lots]);
}

$detail_lot = print(include_template('layout.php', [
    'title' => $lots['name_lot'],
    'nav' => $nav,
    'main' => $detail_lot]));

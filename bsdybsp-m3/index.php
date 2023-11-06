<?php
    require_once ('helpers.php');
    require_once ('function.php');
    require_once ('init.php');

    $lot_list = lot_list($con);
    $category_list = category_list($con);
    $nav = include_template('categoriya.php',['categories' => $category_list]);
    $main = include_template('main.php', [
        'lots' => $lot_list,
        'categories' => $category_list
    ]);

    print($layout = include_template('layout.php', [
        'title' => 'Главная',
        'nav' => $nav,
        'lots' => $lot_list,
        'main' => $main
    ]));


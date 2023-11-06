<?php
require_once ('helpers.php');
require_once ('function.php');
require_once ('init.php');
$category_list = category_list($con);
$nav = include_template('categoriya.php',['categories' => $category_list]);
const OFFSET_ONE = 1;
const LIMIT = 3;
if(!empty($_GET)){
    $searchs = trim($_GET['search']);
    $search_str = isset($_GET['search']) ? $_GET['search'] : "";
    $count_lot = search_lot_count($searchs, $con);
    
    $count_pages = ceil($count_lot/LIMIT);
    $curr_page =  isset($_GET['page']) ? $_GET['page'] : 1;
    
    $offset = ($curr_page - OFFSET_ONE) * LIMIT;
    $search_lot = search_lot($searchs, $con, LIMIT, $offset);
}


$main = include_template('search.php', [
    'nav' => $nav,
    'lots' => $search_lot,
    'search_str' => $search_str,
    'count_page' => $count_pages,
    'curr_page' => $curr_page
]);

print($layout = include_template('layout.php', [
    'title' => 'Поиск',
    'nav' => $nav,
    'main' => $main
]));
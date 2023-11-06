<?php

require_once ('helpers.php');
require_once ('function.php');
require_once ('init.php');

session_start();
if(!isset($_SESSION['user'])){
    $nav = include_template('categoriya.php',['categories' => category_list($con)]);
    $detail_lot = include_template('403.php',['nav' => $nav]);
    $detail_lot = print(include_template('layout.php', [
        'title' => 'Ошибка 403',
        'nav' => $nav,
        'main' => $detail_lot]));
        exit();
}

$category_list = category_list($con);


$nav = include_template('categoriya.php',['categories' => $category_list]);




const MIN_NAME = 3;
const MAX_NAME = 100;
const MIN_MESSAGE = 3;
const MAX_MESSAGE = 500;
$errors = [];
$required_fields =['lot-name','category','message','lot-rate','lot-step','lot-date'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {  

        foreach ($required_fields as $field) {
            if (!isset($_POST[$field])) {
                $errors[$field] = 'Поле не заполнено';
            }
        }

        if(!isset($errors['category'])) {
            $category_ids = [];

            foreach($category_list as $category_item)
            {
                array_push($category_ids, $category_item["id"]);
            }

            if(!in_array($_POST['category'], $category_ids)){
                $errors['category'] = 'Введите категорию!';
            };
        }

        if(!isset($errors['lot-date'])) {
            if((!is_date_valid($_POST['lot-date']) || time() >= strtotime($_POST['lot-date']))){
                $errors['lot-date'] = 'Дата должна быть корректной';
            }
        }

        if(!isset($errors['lot-rate'])){
            if(!filter_var($_POST['lot-rate'], FILTER_VALIDATE_INT)){
                $errors['lot-rate'] = 'Цена должна быть корректной';
            }elseif($_POST['lot-rate'] <= 0){
                $errors['lot-rate'] = 'Цена должна быть корректной';
            }
        }

        if(!isset($errors['lot-step'])){
            if(!filter_var($_POST['lot-step'], FILTER_VALIDATE_INT)){
                $errors['lot-step'] = 'Шаг ставки должен быть корректным';
            }elseif($_POST['lot-step'] <= 0){
                $errors['lot-step'] = 'Шаг ставки должен быть корректным';
            }
        }
    

        if(!isset($errors['lot-name'])){
            $len = strlen($_POST['lot-name']);
            
            if ($len < MIN_NAME or $len > MAX_NAME) {
                $errors['lot-name'] = "Значение должно быть от " .MIN_NAME. " до " .MAX_NAME. " символов";
            }
        }
        if(!isset($errors['message'])){
            $len = strlen($_POST['message']);
            
            if ($len < MIN_MESSAGE or $len > MAX_MESSAGE) {
                $errors['message'] = "Значение должно быть от " .MIN_MESSAGE. " до " .MAX_MESSAGE. " символов";
            }
        }


        if($_FILES){
            if($_FILES['picture']['tmp_name'] !== ""){
                $file_name = $_FILES['picture']['tmp_name']; 
                $time_img =time();
                $file_type = ['image/png', 'image/jpeg'];
                if (!in_array(mime_content_type($file_name), $file_type)){
                    $errors['picture'] = 'Изображение должно иметь формат .jpg/.jpeg/.png';
                }else{
                    $file_name = $_FILES['picture']['name']; 
                    $file_path = __DIR__ . '/uploads/';
                    $file_url = '/uploads/' .$time_img. $file_name;
                    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path .$time_img. $file_name);
                }
            }else{
                $errors['picture'] = 'Загрузите картинку!';
            }
        }

        if(!$errors){
            $lot_name = $_POST['lot-name'];
            $category= $_POST['category'];
            $message = $_POST['message'];
            $picture = $file_url; 
            $lotRate = $_POST['lot-rate'];
            $lotStep = $_POST['lot-step'];
            $endDate = $_POST['lot-date'];
            $lotAdd = add_lot($lot_name,  $category,  $message,  $picture,  $lotRate,  $lotStep,  $endDate, $con);
            $lots = lot_detail($con, $lotAdd);
            if (http_response_code() === 404) {
                $detail_lot = include_template('404.php',['nav' => $nav]);
            }else{
                $detail_lot = header('Location: /lot.php?id=' . $lotAdd);
            }
            
        $detail_lot = print(include_template('layout.php', [
            'is_auth' => $is_auth,
            'user_name' => $user_name,
            'title' => 'Подробнее',
            'nav' => $nav,
            'main' => $detail_lot]));

            }

        
    }

function getPostVal($name):string{
    return $_POST[$name] ?? "";
}


$add_content = include_template('add-lot.php',['nav' => $nav, 'errors' => $errors, 'categories' => $category_list]);
$detail_lot = print(include_template('layout.php', [
    'title' => 'Добавление',
    'main' => $add_content,
    'nav' => $nav
]));
    
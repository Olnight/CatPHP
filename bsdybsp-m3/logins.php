<?php
require_once ('helpers.php');
require_once ('function.php');
require_once ('init.php');
$category_list = category_list($con);
$nav = include_template('categoriya.php',['categories' => $category_list]);

if(isset($_SESSION['user'])){
    $detail_lot = include_template('403.php',['nav' => $nav]);
    $detail_lot = print(include_template('layout.php', [
        'title' => 'Ошибка 403',
        'nav' => $nav,
        'main' => $detail_lot]));
        exit();
}

$errors = [];
$required_fields =['email','password'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Поле не заполнено';
        }
    }
    if(!isset($errors['email']) && !isset($errors['password'])){
        $user_get = get_user($_POST['email'], $con);
        if($user_get){
            if(!password_verify($_POST['password'],$user_get['password'])){
                $errors['password'] = 'Пароль введен неверно';
            }else{
                $_SESSION['user'] = [
                    "id" => $user_get['id'],
                    "username" => $user_get['name'],
                    "auth" => 1
                ];

                $detail_lot = header('Location: /');
            }
        }else{
            $errors['email'] = 'Еmail введен неверно';
        }

    }
}

function getPostVal($name):string{
    return $_POST[$name] ?? "";
}
    $add_content = include_template('login.php',['nav' => $nav, 'errors' => $errors]);
$detail_lot = print(include_template('layout.php', [
    'title' => 'Вход',
    'main' => $add_content,
    'nav' => $nav
]));
?>

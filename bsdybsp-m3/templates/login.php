<?php
session_start();
if(isset($_SESSION['user'])){
    $detail_lot = include_template('403.php',['nav' => $nav]);
    $detail_lot = print(include_template('layout.php', [
        'title' => 'Ошибка 403',
        'nav' => $nav,
        'main' => $detail_lot]));
}
?>

<main>
    <?=$nav?>
    <form class="form container <?php if ($errors):?>form--invalid<?php endif; ?>" action="logins.php" method="post"> <!-- form--invalid -->
        <h2>Вход</h2>
        <div class="form__item <?php if (isset($errors['email'])):?>form__item--invalid<?php endif; ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail <sup>*</sup></label>
            <input value="<?=getPostVal('email'); ?>" id="email" type="text" name="email" placeholder="Введите e-mail">
            <span class="form__error"><?=$errors['email']?></span>
        </div>
        <div class="form__item <?php if (isset($errors['password'])):?>form__item--invalid<?php endif; ?>  form__item--last">
            <label for="password">Пароль <sup>*</sup></label>
            <input value="<?=getPostVal('password'); ?>" id="password" type="password" name="password" placeholder="Введите пароль">
            <span class="form__error"><?=$errors['password']?></span>
        </div>
        <button type="submit" class="button">Войти</button>
    </form>
</main>

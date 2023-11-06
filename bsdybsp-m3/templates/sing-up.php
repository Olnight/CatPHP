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
    <form class="form container <?php if ($errors):?>form--invalid<?php endif; ?>" action="sing-ups.php" method="post" autocomplete="off"> <!-- form
        --invalid -->
        <h2>Регистрация нового аккаунта</h2>
        <div class="form__item <?php if (isset($errors['email'])):?>form__item--invalid<?php endif; ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail <sup>*</sup></label>
            <input value="<?=getPostVal('email'); ?>" id="email" type="text" name="email" placeholder="Введите e-mail">
            <span class="form__error"><?=$errors['email']?></span>
        </div>
        <div class="form__item <?php if (isset($errors['password'])):?>form__item--invalid<?php endif; ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input value="<?=getPostVal('password'); ?>" id="password" type="password" name="password" placeholder="Введите пароль">
            <span class="form__error"><?=$errors['password']?></span>
        </div>
        <div class="form__item <?php if (isset($errors['name'])):?>form__item--invalid<?php endif; ?>">
            <label for="name">Имя <sup>*</sup></label>
            <input value="<?=getPostVal('name'); ?>" id="name" type="text" name="name" placeholder="Введите имя">
            <span class="form__error"><?=$errors['name']?></span>
        </div>
        <div class="form__item <?php if (isset($errors['message'])):?>form__item--invalid<?php endif; ?>">
            <label for="message">Контактные данные <sup>*</sup></label>
            <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?=getPostVal('message'); ?></textarea>
            <span class="form__error"><?=$errors['message']?></span>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Зарегистрироваться</button>
        <a class="text-link" href="/logins.php">Уже есть аккаунт</a>
    </form>
</main>

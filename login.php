<?php
  include '../php/show_errors.php';
  // include '../php/show_info.php';
  if($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
    include '../php/db_connect-local.php';
  } else {
    include '../php/db_connect-game.php';
  }
  include '../php/session.php';
?>
<!DOCTYPE html>
<html lang="ru-en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Игра, Game">
    <meta name="description" content="Игра, Game">
    <title>MyGames</title>
    <link rel="stylesheet" href="style/login.css">
    <script src="https://kit.fontawesome.com/418d1ec454.js" crossorigin="anonymous"></script>
  </head>
  <body>

    <?php include 'include/header.php'; ?>

    <main class="main">

      <div class="login-content">

        <form class="login-form d-none" action="index.php" method="post">
          <div class="">
            <p>Введите логин (email):</p>
            <input type="email" name="login" value="" placeholder="Логин (email)">
          </div>
          <div class="">
            <p>Введите пароль:</p>
            <input type="password" name="pass" value="" placeholder="Пароль">
          </div>
          <div class="">
            <input type="submit" name="enter" value="Войти">
          </div>
          <div class="">
            <a href="#">Зарегистрироваться</a>
          </div>
        </form>

        <form class="registration-form d-flex" action="index.php" method="post">
          <div class="">
            <p>Введите логин (email):</p>
            <input type="email" name="login" value="" placeholder="Логин (email)">
          </div>
          <div class="">
            <p>Введите пароль:</p>
            <input type="password" name="pass" value="" placeholder="Пароль">
          </div>
          <div class="">
            <p>Повторите пароль:</p>
            <input type="password" name="pass-repeat" value="" placeholder="Повторите пароль">
          </div>
          <div class="">
            <p>Продолжая регистрацию, вы соглашаетесь с <a href="privacy.php">Политикой обработки персональных данных</a></p>
          </div>
          <div class="">
            <input type="submit" name="registration" value="Зарегистрироваться">
          </div>
        </form>

      </div>

    </main>

    <?php include 'include/footer.php'; ?>

  </body>
</html>

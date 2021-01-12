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
    <link rel="stylesheet" href="style/index.css">
    <script src="https://kit.fontawesome.com/418d1ec454.js" crossorigin="anonymous"></script>
  </head>
  <body>

    <?php include 'include/header.php'; ?>

    <main class="main">

      <div class="main-content">

        <div class="game-card" title="Угадай песню по картинкам">
          <a class="game-image" href="game-1.php">
            <img src="image/game-1.jpg" alt="game-1">
          </a>
          <h2 class="game-name"><a href="game-1.php">Game 1</a></h2>
        </div>

        <!--<div class="game-card" title="Тестим Яндекс поиск">
          <a class="game-image" href="game-2.php">
            <img src="image/game-2.jpg" alt="game-2">
          </a>
          <h2 class="game-name"><a href="game-2.php">Game 1</a></h2>
        </div>-->

      </div>

    </main>

    <?php include 'include/footer.php'; ?>

    <script src="script/index.js"></script>
  </body>
</html>

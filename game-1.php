<?php
  include '../php/show_errors.php';
  // include '../php/show_info.php';
  if($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
    include '../php/db_connect-local.php';
  } else {
    include '../php/db_connect-game.php';
  }
?>
<!DOCTYPE html>
<html lang="ru-en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Игра, Game">
    <meta name="description" content="Игра, Game">
    <title>Угадай песню по картинкам</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/game-1.css">
    <script src="https://kit.fontawesome.com/418d1ec454.js" crossorigin="anonymous"></script>
  </head>
  <body>

    <header class="header">
      <div class="header-content">
        <h1><a href="index.php">MyGames</a></h1>
        <div class="">
          <i class="fas fa-user"></i>
        </div>
      </div>
    </header>

    <main class="main-game-1">

      <div class="main-content">
        <h1>Угадай песню по картинкам</h1>
        <?php
          // запрашиваем данные песни
          $STH = $DBC->prepare("SELECT * FROM game_songs ORDER BY RAND() LIMIT 1");
          $STH->execute();
          $song = $STH->fetch(PDO::FETCH_ASSOC);
          print_r($song);
          echo '<h2 class="name" id="name">'. $song['name'] .'</h2>';
          echo '<h2 class="author" id="author">'. $song['author'] .'</h2>';
          echo '<h2>Текст песни:</h2>';
          echo '<p class="text" id="text">';
          $song_content = json_decode($song['content']);
          echo '</p>';
          echo '<div class="image d-flex" id="image">';
          echo '<i class="fas fa-play-circle" id="start"></i>';
          foreach($song_content as $value){
            // print_r($value);
            $id = explode("+", $value->id);
            // print_r($id);
            foreach($id as $id_val){
              $STH = $DBC->prepare("SELECT * FROM game_words LEFT JOIN game_images ON game_words.id=game_images.word_id WHERE game_words.id=:id");
              $data = array('id' => $id_val);
              $STH->execute($data);
              $word = $STH->fetch(PDO::FETCH_ASSOC);
              echo '<div class="d-none">';
                echo '<img class="" src="'. $word['src'] .'" alt="image:'. $word['src'] .'">';
                echo '<div class="word d-none">'. $word['name'] .'</div>';
                echo '<div class="change-img"><i class="fas fa-sync-alt"></i></div>';
              echo '</div>';
            }
          }
          echo '</div>';
          // итоговое меню игры
          echo '<div class="game-menu d-none" id="game-menu">';
          echo '<div class="game-option" id="option-1">Повторить</div>';
          echo '<div class="game-option" id="option-2">Повторить со словами</div>';
          echo '<div class="game-option" id="option-3">Выбрать ответ</div>';
          echo '</div>';
          // варианты ответов
          echo '<div class="game-answers d-none" id="game-answers">';
          echo '<div class="answer" id="true">Вариант 1</div>';
          echo '<div class="answer">Вариант 2</div>';
          echo '<div class="answer">Вариант 3</div>';
          echo '<div class="answer">Вариант 4</div>';
          echo '</div>';
        ?>
      </div>

    </main>

    <footer class="footer">
      <div class="footer-content">
        <a href="#"><i class="fas fa-info-circle"></i></a>
      </div>
    </footer>

    <script src="script/game-1.js"></script>
  </body>
</html>

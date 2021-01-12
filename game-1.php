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
    <title>Угадай песню по картинкам</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/game-1.css">
    <script src="https://kit.fontawesome.com/418d1ec454.js" crossorigin="anonymous"></script>
  </head>
  <body>

    <?php include 'include/header.php'; ?>

    <main class="main-game-1">

      <div class="main-content">
        <h1>Угадай песню по картинкам</h1>
        <?php
          // запрашиваем произвольную песню
          $STH = $DBC->prepare("SELECT * FROM game_songs ORDER BY RAND() LIMIT 1");
          $STH->execute();
          $song = $STH->fetch(PDO::FETCH_ASSOC);
          // print_r($song);
          // подготовка пести - разбивка по словам и удаление ненужных символов
          $song_content =  $song['content'];
          // перевод в нижний регистр
          $song_content = mb_strtolower($song_content);
          // замена спецсимволов
          $replace = array(",", ".", "!", "\"", ";", ":");
          $song_content = str_replace($replace, "", $song_content);
          // удаление лишних пробелов в начале и конце строки
          $song_content = trim($song_content);
          // удаление сдвоенныъ пробелов и знаков -
          $patterns = array ('/\s\s+/', '/(\-)|(\s\-\s)/');
          $song_content = preg_replace($patterns, ' ', $song_content);
          // преобразование строки в массив со словами
          $song_content = explode(" ", $song_content);
          // print_r($song_content);
          echo '<br>';
          echo '<h2 class="name" id="name">'. $song['name'] .'</h2>';
          echo '<h2 class="author" id="author">'. $song['author'] .'</h2>';
          echo '<h2>Текст песни:</h2>';
          echo '<p class="text" id="text"></p>';
          echo '<div class="image d-flex" id="image">';
          echo '<i class="fas fa-play-circle" id="start"></i>';
          foreach($song_content as $value){
            // echo $value;
            $STH = $DBC->prepare("SELECT * FROM game_words LEFT JOIN game_images ON game_words.id=game_images.word_id WHERE game_words.name=:name");
            $data = array('name' => $value);
            $STH->execute($data);
            $word = $STH->fetch(PDO::FETCH_ASSOC);
            echo '<div class="d-none">';
              echo '<img class="" src="'. $word['src'] .'" alt="image:'. $word['src'] .'">';
              echo '<div class="word d-none">'. $word['name'] .'</div>';
              echo '<div class="change-img"><i class="fas fa-sync-alt"></i></div>';
            echo '</div>';
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
          // выбираем еще 3 случайных варианта из БД
          $STH = $DBC->prepare("SELECT name FROM game_songs WHERE id!=:id ORDER BY RAND() LIMIT 3");
          $data = array('id' => $song['id']);
          $STH->execute($data);
          $songs  = $STH->fetchAll(PDO::FETCH_ASSOC);
          $songs[] = array('name' => $song['name']);
          shuffle($songs);
          foreach($songs as $answer){
            if($answer['name'] == $song['name']) {
              echo '<div class="answer" id="true">'. $answer['name'] .'</div>';
            } else {
              echo '<div class="answer">'. $answer['name'] .'</div>';
            }
          }
          echo '</div>';
        ?>
      </div>

    </main>

    <?php include 'include/footer.php'; ?>

    <script src="script/game-1.js"></script>
  </body>
</html>

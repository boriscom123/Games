<?php
  /** включаем отображение всех возможных ошибок **/
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  /** Подключение к базе данных **/
  $dblocation="ailike.mysql"; /** Хост нашей БД **/
  $dbuser="ailike_b";  /** Пользователь нашей БД **/
  $dbpassword="+R+b+c+e+m+k+r+f+123+";  /** Пароль пользователя нашей БД **/
  $dbname="ailike_wp";  /** Имя нашей БД **/
  $dbcharset="charset=utf8mb4"; /** SET NAMES utf8 **/
  $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4');
  try {
    $DBC=new PDO("mysql:host=$dblocation; dbname=$dbname; $dbcharset", $dbuser, $dbpassword, $opt);  /** Запрос на подключение к нашей БД через PDO **/
  } catch (PDOException $e) { /** Если произошла ошибка - записываем в файл **/
    $connect_exeption = $e->getMessage(); $handle = fopen("connect.txt", "a"); fwrite($handle, $connect_exeption); fclose($handle);
  } finally {
    /** В переменной $DBC находится запрос на подключение к БД **/
    if (isset($DBC) and $DBC==true) {$go = 'go';} else {$go = 'нет подключения к базе'; $err_m = $connect_exeption;}
  }

  end:
?>
<!DOCTYPE html>
<html lang="ru-en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Угадай песню по картинкам</title>
    <link rel="stylesheet" href="style/index.css">
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
          // заправшиваем данные песни
          $STH = $DBC->prepare("SELECT * FROM game_songs");
          // $data = array('user_cookie_hash' => $_POST['user_cookie_hash'],'product_id' => $_POST['product_id'], 'product_meta_id' => $_POST['meta_id']);
          $STH->execute();
          $song = $STH->fetch(PDO::FETCH_ASSOC);
          echo '<h2 class="name" id="name">'. $song['name'] .'</h2>';
          echo '<h2 class="author" id="author">'. $song['author'] .'</h2>';
          echo '<h2>Текст песни:</h2>';
          echo '<p class="text" id="text">';
          $song_content = json_decode($song['content']);
          foreach($song_content as $value){
            // print_r($value);
            $id = explode("+", $value->id);
            // print_r($id);
            foreach($id as $id_val){
              $STH = $DBC->prepare("SELECT * FROM game_words LEFT JOIN game_images ON game_words.id=game_images.word_id WHERE game_words.id=:id");
              $data = array('id' => $id_val);
              $STH->execute($data);
              $word = $STH->fetch(PDO::FETCH_ASSOC);
              print_r($word['name']);
              echo ' ';
            }
            echo "<br>";
          }
          echo '</p>';
          echo '<div class="image" id="image">';
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
              echo '<img class="d-none" src="'. $word['src'] .'" alt="'. $word['name'] .'">';
            }
          }
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

<!DOCTYPE html>
<html lang="ru-en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MyGames</title>
    <link rel="stylesheet" href="style/index.css">
    <script src="https://kit.fontawesome.com/418d1ec454.js" crossorigin="anonymous"></script>
  </head>
  <body>

    <header class="header">
      <div class="header-content">
        <h1><a href="index.html">MyGames</a></h1>
        <div class="">
          <i class="fas fa-user"></i>
        </div>
      </div>
    </header>

    <main class="main-game-1">

      <div class="main-content">
        <?php
        $user =  'boriscom123';
        $user_key = '03.29226454:f29521f129bf5e18ed800264d5e1046e';
        $query = '&l10n=ru&sortby=tm.order%3Dascending&filter=strict&groupby=attr%3D%22%22.mode%3Dflat.groups-on-page%3D10.docs-in-group%3D1';
        $ya_query = "http://xmlsearch.yandex.ru/xmlsearch" . "/?user=" . $user . "&key=" . $user_key;
        echo $ya_query;
        $xml_data = file_get_contents($ya_query);
        print_r($xml_data);
        echo "запрос отсатка лимитов: <br>";
        $url = 'https://yandex.ru/search/xml';
        $action = 'action=limits-info';
        $query_key = '03.29226454:f29521f129bf5e18ed800264d5e1046e';
        $limit_query = $url. "?". $action . "&user=". $user ."&key=" . $query_key;
        echo $limit_query;
        $xml_data = file_get_contents($limit_query);
        print_r($xml_data);
        ?>
        <p>Текст песни:</p>
        <h3>Земляне</h3>
        <h3>Трава у дома</h3>
        <p id="text">
          Земля в иллюминаторе
        </p>

      </div>

    </main>

    <footer class="footer">
      <div class="footer-content">
        <a href="#"><i class="fas fa-info-circle"></i></a>
      </div>
    </footer>

  </body>
</html>

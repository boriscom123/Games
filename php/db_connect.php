<?php
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

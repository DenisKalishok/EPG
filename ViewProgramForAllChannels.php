<?php
require ('file_func_request.php'); //подключаем к файлу функции)
$db = new SQLite3("sqlite/epg.db", SQLITE3_OPEN_READONLY);
$date = $_POST['date'];
$beg = $_POST['start'];
$kolChannels=$_POST['kolChannels'];
$schedule=$_POST['schedule'];

get_table_schedule($db,$beg,$kolChannels,$date,$schedule);
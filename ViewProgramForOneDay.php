<?php
require ('file_func_request.php');
//подключение к базе
$db = new SQLite3("sqlite/epg.db", SQLITE3_OPEN_READONLY);
//берем инфу для выборки из базы
$date =  $_POST['date'];
$id = $_POST['id'];
$schedule = $_POST['schedule'];

//получаем div шапку списка программ которая включает логотип и наз канала
get_title_channel($db,$id);
echo '<hr>';
//получаем таблица расписания 2 столбца (время/наз программы)
get_program_list($db,$id,$date,$schedule);
echo '<hr>';


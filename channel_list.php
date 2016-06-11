<?php
require ('file_func_request.php'); //подключаем к файлу функции)
//подключение к базе
$db = new SQLite3("sqlite/epg.db", SQLITE3_OPEN_READONLY);

get_table_channel_list($db);


<?php
include_once ('module/db.php');

// Установка параметров, подключение к БД, запуск сессии.
startdb();

// Кодировка.
header('Content-type: text/html; charset=utf-8');

// Вывод в шаблон.
include('template/view.php');

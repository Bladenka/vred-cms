<?php
include("moduls/db.php");//ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ

//МОДУЛЬ МЕНЮ
include("moduls/menu.php");
$menu = menu();//Вывод результата функции в переменную	
//МОДУЛЬ МЕНЮ

//МОДУЛЬ ОТЗЫВОВ
include("moduls/reviews.php");
if(!isset($error_reviews))$error_reviews = "";
$content2 = reviews($error_reviews);//Вывод результата функции в переменную
//МОДУЛЬ ОТЗЫВОВ

include("templates/index.html");//Подключение шаблона
?>
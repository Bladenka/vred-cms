<?php
//ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ (БД)
include("moduls/db.php");
//ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ (БД)

//ЗАЩИТА GET ПЕРЕМЕННОЙ - page (Часть постраничной навигации)
if(isset($_GET['page']))//Определяю, существует ли глобальная переменная GET, если ДА...
{
    $pn = $_GET['page'];//...Заношу её содержимое в переменную
    if(!preg_match("/^[0-9]+$/",$pn))//Регулярное выражение проверяет переменную на наличие только числа
    {//если в переменной был передан символ или буква...
        header("location: sold.php");//...пользователя перенаправит на первую страницу новостей
        exit;
    }
    if(preg_match("/^[0]+$/",$pn))//Регулярное выражение проверяет переменную на наличие только числа
    {//если в переменной был передан символ или буква...
        header("location: sold.php");//...пользователя перенаправит на первую страницу новостей
        exit;
    }
}
if(!isset($pn))$pn = 1;
//ЗАЩИТА GET ПЕРЕМЕННОЙ - page (Часть постраничной навигации)

//МОДУЛЬ ПРОДАННЫЕ АККАУНТЫ
include("moduls/sold.php");
$content2 = acc_sold();//Заношу результат функций в переменную главного шаблона
//МОДУЛЬ ПРОДАННЫЕ АККАУНТЫ

//МОДУЛЬ МЕНЮ
include("moduls/menu.php");
$menu = menu();//Заношу результат функций в переменную главного шаблона
//МОДУЛЬ МЕНЮ

include("templates/index.html");//Подключение шаблона
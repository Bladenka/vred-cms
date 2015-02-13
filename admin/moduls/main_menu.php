<?php
function main_menu()//Функция вывода главного блока навигации
{
    $templates = file("templates/main_menu.html");//Подключаю шаблон
    $templates = implode("",$templates);//Склеивание массива, возвращенного функцией file()
    $count_menu = mysql_query("SELECT COUNT(*) FROM menu");//Вывод количества пунктов пользовательского меню
    $count_menu = mysql_fetch_array($count_menu);
    $templates = str_replace("[_countMENU]",$count_menu[0],$templates);

    $count_news = mysql_query("SELECT COUNT(*) FROM news");//Вывод количества новостных статей
    $count_news = mysql_fetch_array($count_news);
    $templates = str_replace("[_countNEWS]",$count_news[0],$templates);

    $count_new = mysql_query("SELECT COUNT(*) FROM accounts WHERE status='0'");//Вывод количества новых аккаунтов
    $count_new = mysql_fetch_array($count_new);
    $templates = str_replace("[_countNEW]",$count_new[0],$templates);

    $count_sale = mysql_query("SELECT COUNT(*) FROM accounts WHERE status='1'");//Вывод количества одобренных аккаунтов
    $count_sale = mysql_fetch_array($count_sale);
    $templates = str_replace("[_countSALE]",$count_sale[0],$templates);

    $count_sold = mysql_query("SELECT COUNT(*) FROM accounts WHERE status='2'");//Вывод количества проданных аккаунтов
    $count_sold = mysql_fetch_array($count_sold);
    $templates = str_replace("[_countSOLD]",$count_sold[0],$templates);

    $count_unverified = mysql_query("SELECT COUNT(*) FROM reviews WHERE status='0'");//Вывод количества новых отзывов
    $count_unverified = mysql_fetch_array($count_unverified);
    $templates = str_replace("[_countUNVERIFIED]",$count_unverified[0],$templates);

    $count_verified = mysql_query("SELECT COUNT(*) FROM reviews WHERE status='1'");//Вывод количества одобренных отзывов
    $count_verified = mysql_fetch_array($count_verified);
    $templates = str_replace("[_countVERIFIED]",$count_verified[0],$templates);
    return $templates;//Вывод сгенерированного html кода
}
<?php
//ОБРАБОТЧИК ДОБАВЛЕНИЯ ПУНКТОВ МЕНЮ
if(isset($_POST['addname_p']))$addname_p = $_POST['addname_p'];
if(isset($_POST['addhref_p']))$addhref_p = $_POST['addhref_p'];
if(isset($addname_p) AND isset($addhref_p))
{	
    $result_index = mysql_query("SELECT COUNT(*) FROM menu");//Вывожу из БД количество пунктов меню
    $myrow_index = mysql_fetch_array($result_index);
    $col = $myrow_index[0];
    $col++;
    $result_add_menu = mysql_query ("INSERT INTO menu (name,href,position) VALUES ('$addname_p','$addhref_p','$col')");
    header("location: ?page=menu_list");//Перенаправление к списку пунктов меню
    exit;
}
//ОБРАБОТЧИК ДОБАВЛЕНИЯ ПУНКТОВ МЕНЮ

function menu_add()//Функция вывода формы редактирования меню
{
    $sm_read = file("templates/menu_add.html");//Подключаю шаблон
    $sm_read = implode("",$sm_read);//Т.к. функция file() возвращает массив, его нужно склеить
    return $sm_read;//Вывод сгенерированного html кода
}
?>
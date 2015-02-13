<?php
@$result_meta = mysql_query("SELECT * FROM page WHERE id='1'"); //Запрос на вывод системных данных (заголовок сайта, метатеги, ключивые слова)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "") //Если результат запроса имеет данные...
{
    $meta_title = 'Проданные аккаунты DarkOrbit';
    $header_title = $meta_title." - ".$myrow_meta[title];//Заголовок страницы (Имя аккаунта - имя сайта)
    $header_metaD = $myrow_meta[meta_d]; //метатеги
    $header_metaK = $myrow_meta[meta_k]; //ключивые слова
}

function acc_sold()//Функция вывода проданных аккаунтов
{
    global $pn; //Переменная постраничной навигации
    include("moduls/sold_navigation.php"); //Модуль навигации
    $limit = sold_navigation(10,$pn); //Количество выводимых тем на одну страницу
    $links = $limit[2];

    $result_index = mysql_query("SELECT * FROM accounts WHERE status = '2' ORDER BY sold_date DESC LIMIT $limit[0], $limit[1]");//Вывод из главной БД все записи со статусом "В продаже"
    $myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//Если результат запроса имеет данные...
    {
        $templates = file("templates/sold.html");//Подключаю шаблон
        $templates = implode("",$templates);//Склеивание массива, возвращенного функцией file()
        preg_match("/\[_div_sold\](.*?)\[_div_sold\]/s",$templates,$div_content);//Регулярное выражение, позволяющее вырезать из шаблона только ту часть, которая должна повторяться (Результат заносится в $div_content)
        do
        {
            $change_ids = $div_content[1];/*Так как ниже придется править шаблон(заменить идентификаторы на информацию из запроса), сохраню его(шаблон) в отдельную переменную,
				иначе придется пользоваться функцией file() чаще чем 1 раз, а это дополнительная нагрузка на сервер*/
            //Замена идентификаторов в шаблоне на переменные из БД
            $change_ids = str_replace("[_id]",$myrow_index[id],$change_ids);//ид
            $change_ids = str_replace("[_title]",$myrow_index[title],$change_ids);//Заголовок
            $change_ids = str_replace("[_preview_ship]",$myrow_index[preview_ship],$change_ids);//Предпросмотр корабля
            $change_ids = str_replace("[_server]",$myrow_index[server],$change_ids);//Сервер
            $change_ids = str_replace("[_sold_date]",$myrow_index[sold_date],$change_ids);//Дата продажи
            $change_ids = str_replace("[_price]",number_format($myrow_index[price],0,'','.'),$change_ids);//Цена
            $acc_sold .= $change_ids;//Склею весь сгенерированный код в одну переменную
        }
        while($myrow_index = mysql_fetch_array($result_index));
        $acc_sold = preg_replace("/\[_div_sold\].*?\[_div_sold\]/s",$acc_sold,$templates);//Вместо [_div_sold]...[_div_sold] вклеивается сгенерированный html код из $acc_sold
        if($links > 1)$acc_sold .= listnav($links,$pn,4);//Вывод ссылок на страницы (4 - это количество ссылок в центральной части панели навигации)
        return $acc_sold;
    }
    else
    {
        $templates = file("templates/error.html"); //Подключение шаблона ошибки
        $templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
        $title = 'Проданные аккаунты';//Заголовок ошибки
        $message = 'Страница не существует либо нет проданных аккаунтов'; //Выводимое сообщение
        $templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
        $templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
        $acc_sold .= $templates; //Склею весь сгенерированный код в одну переменную
    }
    return $acc_sold;//Вывод сгенерированного html кода
}
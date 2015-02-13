<?php
@$result_meta = mysql_query("SELECT title FROM page WHERE id='1'");//Запрос на вывод системных данных (заголовок сайта)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "")
{
    $result_meta_news = mysql_query("SELECT title,meta_d,meta_k FROM news WHERE id='$topic'");//Запрос на вывод заголовка выбранной статьи
    $meta_news = mysql_fetch_array($result_meta_news);
    if($meta_news[title] != "") $header_title = $meta_news[title]." - ".$myrow_meta[title];//Заголовок страницы (Имя аккаунта - имя сайта)
    else $header_title = $meta_news[title];//Заголовок страницы (Имя аккаунта - имя сайта)
    $header_metaD = $myrow_meta[meta_d]; //метатеги
    $header_metaK = $myrow_meta[meta_k]; //ключивые слова
}

function news_topic($topic)//Функция вывода детального описания аккаунта
{
    $result_index = mysql_query("SELECT * FROM news WHERE id = '$topic'");//Вывожу из БД выбранную пользователем новость
    $myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//Если результат запроса имеет данные...
    {
        $templates = file("templates/news_topic.html");//Подключаю шаблон
        $templates = implode("",$templates);//Склеивание массива, возвращенного функцией file()

        $templates = str_replace("[_title]",$myrow_index[title],$templates);//Название статьи
        $templates = str_replace("[_text]",$myrow_index[text],$templates);//Текст
        $templates = str_replace("[_publisher]",$myrow_index[publisher],$templates);//Автор статьи
        $templates = str_replace("[_date_pub]",$myrow_index[date_pub],$templates);//Дата размещения
        $news_topic .= $templates;//Склею весь сгенерированный код в одну переменную
    }
    else //Если результат запроса данных не имеет (пустой)...
    {
        $templates = file("templates/error.html");//Подключение шаблона ошибки
        $templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
        $title = 'Сообщение сайта'; //Заголовок ошибки
        $message = 'Тема не существует или не указан идентификатор (номер). Если вы уверены, что использовали правильную ссылку, свяжитесь с администрацией'; //Выводимое сообщение
        $templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
        $templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
        $news_topic .= $templates; //Склею весь сгенерированный код в одну переменную
    }
    return $news_topic;//Вывод сгенерированного html кода
}
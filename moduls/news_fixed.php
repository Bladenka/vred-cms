<?php
function news_fixed()//Функция вывода закрепленного поста
{
    $result_index = mysql_query("SELECT title,text FROM news WHERE block='1'");//Вывожу из БД пост, где колонка block равна единице, т.е. "закреплен"
    $myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//Если результат запроса имеет данные...
    {
        $templates = file("templates/news_topic.html");//Подключаю шаблон
        $templates = implode("",$templates);//Т.к. функция file() возвращает массив, его нужно склеить
		$templates = str_replace("[_title]",$myrow_index[title],$templates);//Замена идентификаторов в шаблоне на заголовок закрепленного поста
        $templates = str_replace("[_text]",$myrow_index[text],$templates);//Замена идентификаторов в шаблоне на текст закрепленного поста
        return $templates;//Вывод сгенерированного html кода
    }
    else return "";//...если нет - результатом функции будет пустота
}
?>
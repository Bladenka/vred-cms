<?php
//УДАЛЕНИЕ
if($_GET['del_post'])$del_post = $_GET['del_post'];//Объявляю GET-переменную содержащею ID удаляемого отзыва
if($del_post)//Если переменная существует...
{
    $result_del_post = mysql_query ("DELETE FROM reviews WHERE id='$del_post'");//Удаляю запись в которой id равен GET-переменной
    header("location: ?page=reviews_verified");//Перенаправление к списку одобреных отзывов
    exit;
}
//УДАЛЕНИЕ

//------ОБРАБОТЧИК РЕДАКТИРОВАНИЯ ОТЗЫВА
//Объявляю переменные, если форма была отправлена (sumbit на форме редактирования данных)
if($_POST['post_id'])$post_id = $_POST['post_id'];//ID
if($_POST['post_status'])$post_status = $_POST['post_status'];//Статус отзыва
if($_POST['post_author'])$post_author = $_POST['post_author'];//Подпись Автора отзыва
if($_POST['post_title'])$post_title = $_POST['post_title'];//Заголовок
if($_POST['post_user_text'])$post_user_text = $_POST['post_user_text'];//Отзыв
if($_POST['post_admin_text'])$post_admin_text = $_POST['post_admin_text'];//Ответ Администратора
//Объявляю переменные, если форма была отправлена (sumbit на форме редактирования данных)

if($post_author & $post_title & $post_user_text)//Если посланные переменные определены как существующие...
{
    //Замена символа (') на спец символ
    $post_status = str_replace("'","&#039",$post_status);
    $post_author = str_replace("'","&#039",$post_author);
    $post_title = str_replace("'","&#039",$post_title);
    $post_user_text = str_replace("'","&#039",$post_user_text);
    $post_admin_text = str_replace("'","&#039",$post_admin_text);
    //Замена символа (') на спец символ

    $edd_blog = mysql_query ("UPDATE reviews SET status='$post_status', author='$post_author', title='$post_title', user_text='$post_user_text', admin_text='$post_admin_text' WHERE id='$post_id'");//обновляю данные в БД
    header("location: ?page=reviews_verified");//Перенаправление на страницу с одобренными отзывами
    exit;
}
//------ОБРАБОТЧИК РЕДАКТИРОВАНИЯ ОТЗЫВА

function reviews_verified()//Функция вывода списка одобренных отзывов
{
    $result_index = mysql_query("SELECT * FROM reviews WHERE status = '1' ORDER BY post_date DESC");//Вывожу из таблицы "reviews(отзывы)" все записи со статусом "1 = Опубликован" (сортировка по Убыванию)
    $myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//Проверка, на существоавние в таблице записей...
    { //Если хоть одна запись есть..
        $templates = file("templates/reviews_verified.html");//Подключаю шаблон
        $templates = implode("",$templates);//Т.к. функция file() возвращает массив, его нужно склеить
        preg_match("/\[_while\](.*?)\[_while\]/s",$templates,$tamp_while);//Регулярное выражение, позволяющее вырезать из шаблона только ту часть, которая должна повторяться
        do
        {
            $copy_tamp = $tamp_while[1];/*Так как ниже придется править шаблон(заменить идентификаторы на информацию из запроса), сохраню его(шаблон) в отдельную переменную,
					иначе придется пользоваться функцией file() чаще чем 1 раз, а это дополнительная нагрузка на сервер*/

            //Замена идентификаторов на информацию из запроса
            $copy_tamp = str_replace("[_id]",$myrow_index[id],$copy_tamp);//ID
            $copy_tamp = str_replace("[_title]",$myrow_index[title],$copy_tamp);//Заголовок
            $copy_tamp = str_replace("[_user_text]",$myrow_index[user_text],$copy_tamp);//Отзыв
            $copy_tamp = str_replace("[_author]",$myrow_index[author],$copy_tamp);//Подпись Автора отзыва
            $copy_tamp = str_replace("[_admin_text]",$myrow_index[admin_text],$copy_tamp);//Ответ Администратора
            $copy_tamp = str_replace("[_post_date]",$myrow_index[post_date],$copy_tamp);//Дата размещения
            $list .= $copy_tamp;//Склею весь сгенерированный код в одну переменную
        }
        while($myrow_index = mysql_fetch_array($result_index));
        $templates = preg_replace("/\[_while\].*?\[_while\]/s",$list,$templates);//Вместо [_while]...[_while] вклеивается сгенерированный html код из $list
    }
    else
    {//Если записей нет, вывести сообщение...
        $templates = file("templates/error.html"); //Подключение шаблона
        $templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
        $title = 'Одобренные отзывы'; //Заголовок ошибки
        $message = 'Нет записей в базе данных'; //Выводимое сообщение
        $templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
        $templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
    }
    return $templates;//Вывод сгенерированного html кода
}

function reviews_update($id)//Функция вывода выбранного отзыва
{
    $result_index = mysql_query("SELECT * FROM reviews WHERE id='$id'");//Вывожу из таблицы "reviews(отзывы)" запись с определённым id
    $myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//Если результат запроса имеет данные...
    {
        $templates = file("templates/reviews_update.html");//Подключаю шаблон
        $templates = implode("",$templates);//Т.к. функция file() возвращает массив, его нужно склеить

        $text_post = str_replace("<BR>","",$myrow_index[user_text]);//Замена тега <br> на пустоту
        //Замена идентификаторов на информацию из запроса
        $templates = str_replace("[_id]",$myrow_index[id],$templates);//ID
        $templates = str_replace("[_title]",$myrow_index[title],$templates);//Заголовок
        $templates = str_replace("[_user_text]",$text_post,$templates);//Отзыв
        $templates = str_replace("[_author]",$myrow_index[author],$templates);//Подпись Автора отзыва
        $templates = str_replace("[_admin_text]",$myrow_index[admin_text],$templates);//Ответ Администратора
        $templates = str_replace("[_date_comm]",$myrow_index[post_date],$templates);//Дата размещения
    }
    else
    {//Если результат запроса данных не имеет (пустой)...
        $templates = file("templates/error.html"); //Подключение шаблона
        $templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
        $title = 'Ошибка'; //Заголовок ошибки
        $message = 'Указан несуществующий идентификатор отзыва'; //Выводимое сообщение
        $templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов в шаблоне на заголовок ошибки
        $templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов в шаблоне на выводимое сообщение
    }
    return $templates;//Вывод сгенерированного html кода
}
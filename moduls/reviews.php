<?php
@$result_meta = mysql_query("SELECT * FROM page WHERE id='1'"); //Запрос на вывод системных данных (заголовок сайта, метатеги, ключивые слова)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "") //Если результат запроса имеет данные...
{
    $meta_title = 'Пользовательские отзывы';
    $header_title = $meta_title." - ".$myrow_meta[title];//Заголовок страницы (Имя аккаунта - имя сайта)
    $header_metaD = $myrow_meta[meta_d]; //метатеги
    $header_metaK = $myrow_meta[meta_k]; //ключивые слова
}

//------ОБРАБОТЧИК ОТПРАВКИ ОТЗЫВОВ
//Определяю существование посланных переменных из формы отправки отзыва
if(isset($_POST['post_title']))$post_title = $_POST['post_title'];//Заголовок
if(isset($_POST['post_user_text']))$post_user_text = $_POST['post_user_text'];//Отзыв
if(isset($_POST['post_author']))$post_author = $_POST['post_author'];//Подпись Автора отзыва
if(isset($_POST['post_id']))$post_id = $_POST['post_id'];

if($post_title & $post_user_text & $post_author)//Если посланные переменные определены как существующие...
{
    //Функция "htmlspecialchars" преобразует html теги (если таковые были введены пользователем) в спец символы
    $post_title = htmlspecialchars($post_title);
    $post_user_text = htmlspecialchars($post_user_text);
    //Функция "htmlspecialchars" преобразует html теги (если таковые были введены пользователем) в спец символы

    //Проверка кода капчи
    if($post_id != "")//Если поле было заполнено
    {
        session_start();//Открываю сессию
        if(md5($post_id) != $_SESSION['code'])$error_reviews = "Выбранное Вами изображение не соответсвует заданному!";//Если код неправельный
        unset($_SESSION['code']);//Уничтожаю код
        session_destroy();//Уничтожаю сессию
    }

    if(!isset($error_reviews))
    {
        //Замена символа (') на спец символ
        $post_title = str_replace("'","&#039",$post_title);
        $post_user_text = str_replace("'","&#039",$post_user_text);
        $post_author = str_replace("'","&#039",$post_author);
        //Замена символа (') на спец символ

        $post_user_text = str_replace("\n","<br>",$post_user_text);//Замена переноса строки пользователского текста на тег <br>

        $result_add_comm = mysql_query ("INSERT INTO reviews (status,author,post_date,title,user_text) VALUES ('0','$post_author',NOW(),'$post_title','$post_user_text')");//Запись данных в БД
        header("location: reviews.php");//Перенаправление пользователя после отправки сообщения
        exit;
    }
}
//------ОБРАБОТЧИК ОТПРАВКИ ОТЗЫВОВ

function reviews($error)//Функция вывода одобренных отзывов
{
    $result_index = mysql_query("SELECT * FROM reviews WHERE status = '1' ORDER BY id DESC");//Вывожу из таблицы "reviews(отзывы)" все записи со статусом "1 = Опубликован" (сортировка по Убыванию)
    $myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//Проверка, на существоавние в таблице записей...
    { //Если хоть одна запись есть...
        $templates = file("templates/reviews.html");//Подключаю шаблон
        $templates = implode("",$templates);//Т.к. функция file() возвращает массив, его нужно склеить
        do
        {
            $change_ids = $templates;/*Так как ниже придется править шаблон(заменить идентификаторы на информацию из запроса), сохраню его(шаблон) в отдельную переменную,
					иначе придется пользоваться функцией file() чаще чем 1 раз, а это дополнительная нагрузка на сервер*/

            //Замена идентификаторов на информацию из запроса
            $change_ids = str_replace("[_author]",$myrow_index[author],$change_ids);//Подпись Автора отзыва
            $change_ids = str_replace("[_post_date]",$myrow_index[post_date],$change_ids);//Дата размещения
            $change_ids = str_replace("[_title]",$myrow_index[title],$change_ids);//Заголовок
            $change_ids = str_replace("[_user_text]",$myrow_index[user_text],$change_ids);//Отзыв
            $change_ids = str_replace("[_admin_text]",$myrow_index[admin_text],$change_ids);//Ответ Администратора
            $comm .= $change_ids; //Склею весь сгенерированный код в одну переменную
        }
        while($myrow_index = mysql_fetch_array($result_index));
    }
    else
    {//Если записей нет, вывести сообщение...
        $templates = file("templates/error.html"); //Подключение шаблона
        $templates = implode("",$templates); //Склеивание массива, возвращенного функцией file()
        $title = 'Сообщение сайта'; //Заголовок ошибки
        $message = 'Ещё никто не писал отзыв о нашем сервисе. Помогите другим сделать свой выбор!'; //Выводимое сообщение
        $templates = preg_replace("[err_title]",$title,$templates);//Замена идентификаторов на заголовок ошибки
        $templates = preg_replace("[err_message]",$message,$templates);//Замена идентификаторов на выводимое сообщение
        $comm .= $templates; //Склею весь сгенерированный код в одну переменную
    }
    $form = file("templates/reviews_form.html");//Подключаю шаблон с формой
    $form = implode("",$form);//Т.к. функция file() возвращает массив, его нужно склеитьо

    //Вывод ошибки
    if($error != "")//Если есть ошибки
    {
        $echoMESSAGE = '<font color="red"><strong>'.$error.'</strong></font>';//Ошибки
        $form = str_replace("[_error]",$echoMESSAGE,$form);//Вывод ошибок на экран
    }
    else $form = str_replace("[_error]","",$form);//Если ошибок нет, то кодовое слово заменяется на пустоту
    //Вывод ошибки

    //Капча
    include ("moduls/capcha.php");
    $cods = capcha();
    for($i=0;$i<4;$i++)
    {
        $form = str_replace("[_code".$i."]",$cods[$i][1],$form);//В форму помещается 4 кода
        $form = str_replace("[_img".$i."]",$cods[$i][3],$form);//В форму помещается 4 изображения
        if($cods[$i][5] == "true")$form = str_replace("[_q]",$cods[$i][4],$form);//Помещаю вопрос в форму
    }
    //Капча

    $form .= $comm;
    return $form;//Вывод сгенерированного html кода
}
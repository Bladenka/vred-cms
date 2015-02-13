<?php
include("moduls/db.php");//ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ

//АВТОРИЗАЦИЯ
//Уничтожаются переменные логин/пароля вводённые админом в форму
if (isset ($_GET['loginDB'])) {$loginDB = $_GET['loginDB'];unset($loginDB);}
if (isset ($_GET['passwordDB'])) {$passwordDB = $_GET['passwordDB'];unset($passwordDB);}

//Получение введённых данных после отправки формы
if (isset ($_POST['loginDB'])) {$loginDB = $_POST['loginDB'];}
if (isset ($_POST['passwordDB'])) {$passwordDB = $_POST['passwordDB'];}

if(isset($loginDB) AND isset($passwordDB))//если существуют логин и пароль
{
    if(preg_match("/^[a-zA-Z0-9_-]+$/s",$loginDB) AND preg_match("/^[a-zA-Z0-9]+$/s",$passwordDB))//Данные проверяются на корректность
    {
        $prov = getenv('HTTP_REFERER');//Определение страницы с которой пришел запрос
        $prov = str_replace("www.","",$prov);//www удаляется, если оно есть
        preg_match("/(http\:\/\/[-a-z0-9_.]+\/)/",$prov,$prov_pm);//с помощью данного условия регулярного выражения очищается строка от лишнего до: http://xxxx.ru
        $prov = $prov_pm[1];//Чистый адрес заносится в отдельную переменную
        $server_root = str_replace("www.","",$server_root);//www удаляется, если оно есть

        if($server_root == $prov)//Если адрес моего сайта и адрес страницы с которой был прислан запос одинаковы, то
        {
            $passwordDB = md5($passwordDB);//Введенный пароль шифруется
            $resultlp = mysql_query("SELECT login,password FROM user WHERE login='$loginDB'");//Получаю данные из БД (логин и пароль)
            $log_and_pass = mysql_fetch_array($resultlp);
            if($log_and_pass != "")//Проверка, на существоавние данной записи в БД...
            {
                if($loginDB == $log_and_pass[login] AND $passwordDB == $log_and_pass[password])//Если введенная информация совпадает с информацией БД
                {
                    session_start();//старт сессии
                    $_SESSION['$logSESS'] = $log_and_pass[login];//создаем глобальную переменную
                    header("location: index.php");//Перенаправление на главную страницу
                    exit;
                }
                else//Если введенная информация НЕ совпадает с информацией БД
                {
                    header("location: login.php");//Перенаправление на форму авторизации
                    exit;
                }
            }
            else//Если записей нет...
            {
                header("location: login.php");//Перенаправление на форму авторизации
                exit;
            }
        }
        else//если запрос был послан с другого адреса
        {
            header("location: login.php");//Перенаправление на форму авторизации
            exit;
        }
    }
    else//если введены не корректный логин и пароль
    {
        header("location: login.php");//переносим на форму авторизации
        exit;
    }
}
//АВТОРИЗАЦИЯ

//мета теги
$header_title = "Авторизация";
$header_metaD = "Авторизация";
$header_metaK = "Авторизация";
//мета теги

function form_author()//функция вывода формы авторизации
{
    $sm_read = file("templates/login.html");//Подключение шаблона
    $sm_read = implode("",$sm_read);
    return $sm_read;//Вывод результата
}

$content = form_author();//Вызов функции
include("templates/index.html");//главный шаблон
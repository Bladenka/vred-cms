<?
$header_title = "Панель Администратора";
$header_metaD = "";
$header_metaK = "";

include("moduls/db.php");//ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ

//СКРИПТ ПРОВЕРКИ АВТОРИЗАЦИИ
if(isset($_GET['logSESS'])) {$logSESS = $_GET['logSESS'];unset($logSESS);}
if(isset($_POST['logSESS'])) {$logSESS = $_POST['logSESS'];unset($logSESS);}
session_start();
$logSESS = $_SESSION['$logSESS'];
if(!isset($logSESS))
{
	header("location: login.php");
	exit;  
}
//СКРИПТ ПРОВЕРКИ АВТОРИЗАЦИИ

if($_GET['id'])$id = $_GET['id'];
if($_GET['page'])$page = $_GET['page'];//Определяю страницу, которая сейчас открыта
else $page = "index";//Если переменной не существует, значит открыта главная страница

//ГЛАВНОЕ СТРАНИЦА
if($page == "index")//Если открыта главная страница
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
}
//ГЛАВНОЕ СТРАНИЦА

//---------------------------ПОЛЬЗОВАТЕЛЬСКОЕ МЕНЮ
//ДОБАВЛЕНИЕ ПУНКТА ПОЛЬЗОВАТЕЛЬСКОГО МЕНЮ
if($page == "menu_add")
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
	include("moduls/menu_add.php");
	$content = menu_add();
}
//ДОБАВЛЕНИЕ ПУНКТА ПОЛЬЗОВАТЕЛЬСКОГО МЕНЮ
//РЕДАКТОР ПОЛЬЗОВАТЕЛЬСКОГО МЕНЮ
if($page == "menu_list" || $page == "menu_update")
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
	include("moduls/menu_list.php");//Подключение модуля
	if($page == "menu_list")$content = menu_list();
	if($page == "menu_update")$content = menu_update($id);
}
//РЕДАКТОР ПОЛЬЗОВАТЕЛЬСКОГО МЕНЮ
//---------------------------ПОЛЬЗОВАТЕЛЬСКОЕ МЕНЮ

//---------------------------НОВОСТИ
//ДОБАВЛЕНИЕ НОВОСТЕЙ
if($page == "news_add")//Если открыта страница добавления новостей
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
	include("moduls/news_add.php");//Подключение модуля
	$content = news_add();//Помещаю html код шаблона в переменную
}
//ДОБАВЛЕНИЕ НОВОСТЕЙ
//РЕДАКТОР И ВЫВОД НОВОСТЕЙ
if($page == "news_list" || $page == "news_update")
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
	include("moduls/news_list.php");//Подключение модуля
	if($page == "news_list")$content = news_list();//Если новость еще НЕ выбрана для редактирования
	if($page == "news_update")$content = news_update($id);//Если новость выбрана
}
//РЕДАКТОР И ВЫВОД НОВОСТЕЙ
//НАСТРОЙКА НОВОСТНЫХ СТАТЕЙ
if($page == "news_config")
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
	include("moduls/news_config.php");//Подключение модуля
	$content = news_config($id);
}
//НАСТРОЙКА НОВОСТНЫХ СТАТЕЙ
//---------------------------НОВОСТИ

//---------------------------КАТАЛОГ АККАУНТОВ
//РЕДАКТОР КАТАЛОГА АККАУНТОВ
if($page == "accs_unverified" || $page == "accs_verified" || $page == "accs_sold" || $page == "accs_update")
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
	include("moduls/accs_list.php");//Подключение модуля
	if($page == "accs_unverified")$content = accs_unverified();//Страница с новыми аккаунтами
	if($page == "accs_verified")$content = accs_verified();//Страница с одобренными аккаунтами
	if($page == "accs_sold")$content = accs_sold();//Список проданных
	if($page == "accs_update")$content = accs_update($id);//Редактирование информации
}
//РЕДАКТОР КАТАЛОГА АККАУНТОВ
//НАСТРОЙКА КАТАЛОГА АККАУНТОВ
if($page == "accs_config")
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
	include("moduls/accs_config.php");//Подключение модуля
	if($page == "accs_config")$content = accs_config($id);//Если новость выбрана
}
//НАСТРОЙКА КАТАЛОГА АККАУНТОВ
//---------------------------КАТАЛОГ АККАУНТОВ

//---------------------------ОТЗЫВЫ
//РЕДАКТОР ОТЗЫВОВ
if($page == "reviews_verified" || $page == "reviews_update")
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
	include("moduls/reviews_verified.php");//Подключаем наш модуль
	if($page == "reviews_verified")$content = reviews_verified();//Если отзыв еще НЕ выбран для редактирования
	if($page == "reviews_update")$content = reviews_update($id);//Если отзыв выбран
}
//РЕДАКТОР ОТЗЫВОВ
//МОДЕРАЦИЯ ОТЗЫВОВ
if($page == "reviews_unverified")
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
	include("moduls/reviews_unverified.php");
	$content = reviews_unverified();
}
//МОДЕРАЦИЯ ОТЗЫВОВ
//---------------------------ОТЗЫВЫ

//---------------------------НАСТРОЙКИ САЙТА
if($page == "config")
{
	include("moduls/main_menu.php");//Подключение модуля
	$main_menu = main_menu();//Помещаю html код шаблона в переменную
	include("moduls/global_config.php");//подключаем модуль
	$content = global_config();
}
//---------------------------НАСТРОЙКИ САЙТА
include("templates/index.html");//Вывод главного шаблона на экран
?>
<?php
//ОБРАБОТЧИК
if(isset($_POST['cfgtitle']))$cfgtitle = $_POST['cfgtitle'];
if(isset($_POST['cfgmetaD']))$cfgmetaD = $_POST['cfgmetaD'];
if(isset($_POST['cfgmetaK']))$cfgmetaK = $_POST['cfgmetaK'];
if(isset($_POST['cfglogin']))$cfglogin = $_POST['cfglogin'];
if(isset($_POST['cfgpassD']))$cfgpassD = $_POST['cfgpassD'];
if(isset($_POST['cfgskype']))$cfgskype = $_POST['cfgskype'];
if(isset($_POST['cfgicq']))$cfgicq = $_POST['cfgicq'];
if(isset($_POST['cfgmail']))$cfgmail = $_POST['cfgmail'];
if(isset($_POST['cfgnote']))$cfgnote = $_POST['cfgnote'];

if(isset($cfglogin) AND $cfglogin != "" AND isset($cfgpassD) AND isset($cfgtitle) AND isset($cfgmetaD) AND isset($cfgmetaK) AND isset($cfgskype) AND isset($cfgicq) AND isset($cfgmail) AND isset($cfgnote))
{
    $newCONFIGpage = mysql_query ("UPDATE page SET title='$cfgtitle',meta_d='$cfgmetaD',meta_k='$cfgmetaK' WHERE id='1'");//обнавление настроек
    $cfgnote = str_replace("\n","<br>",$cfgnote);//Замена переноса строки на тег <BR>
    //ОБНОВЛЕНИЕ ЛИЧНЫХ ДАННЫХ
    if($cfgpassD != "")//Если поле пароль не пустое
    {		
        $newpass = md5($cfgpassD);//Шифруем новый пароль
        $sql = "UPDATE user SET login='$cfglogin',password='$newpass',skype='$cfgskype',icq='$cfgicq',mail='$cfgmail',note='$cfgnote' WHERE id='1'";
    }
    else 
	{//Если пароль пустой
		$sql = "UPDATE user SET login='$cfglogin',skype='$cfgskype',icq='$cfgicq',mail='$cfgmail',note='$cfgnote' WHERE id='1'";
    }     
    $newCONFIGuser = mysql_query ($sql);//Обновление личных данных
    //ОБНОВЛЕНИЕ ЛИЧНЫХ ДАННЫХ
    header("location: ?page=config");//Переносим пользовотеля на страницу со списком настроек
    exit;
}
//ОБРАБОТЧИК

function global_config()//Функция вывода списка настроек
{
    $result_page = mysql_query("SELECT * FROM page WHERE id='1'");//Вывод данных из первой строки таблицы с системными данными сайта
    $myrow_page = mysql_fetch_array($result_page);
	
	$result_user = mysql_query("SELECT * FROM user WHERE id='1'");//Вывод данных из первой строки таблицы личных данных администратора
    $myrow_user = mysql_fetch_array($result_user);
        
    $sm_read = file("templates/global_config.html");//Подключаю шаблон
    $sm_read = implode("",$sm_read);//Склеивание массива, возвращенного функцией file()
	$cfgnote = str_replace("<br>","",$myrow_user[note]);//заменяем br в тексте на пустоту
    //Замена код-слов
    $sm_read = str_replace("[_title]",$myrow_page['title'],$sm_read);//Заголовок
    $sm_read = str_replace("[_metaD]",$myrow_page['meta_d'],$sm_read);//описание сайта
    $sm_read = str_replace("[_metaK]",$myrow_page['meta_k'],$sm_read);//Ключевые слова
	$sm_read = str_replace("[_login]",$myrow_user['login'],$sm_read);//логин
	$sm_read = str_replace("[_skype]",$myrow_user['skype'],$sm_read);//Скайп
    $sm_read = str_replace("[_icq]",$myrow_user['icq'],$sm_read);//Аська
    $sm_read = str_replace("[_mail]",$myrow_user['mail'],$sm_read);//Майл
	$sm_read = str_replace("[_note]",$cfgnote,$sm_read);//Доп.инфа
    return $sm_read;//Вывод сгенерированного html кода
}
?>
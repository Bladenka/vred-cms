<?php
if(isset($_GET['step']))$step = $_GET['step']; else $step = 1;

if(isset($_POST['nameDB']))$nameDB = $_POST['nameDB'];
if(isset($_POST['nameSERVER']))$nameSERVER = $_POST['nameSERVER'];
if(isset($_POST['nameUSER']))$nameUSER = $_POST['nameUSER'];
if(isset($_POST['passUSER']))$passUSER = $_POST['passUSER'];
if(isset($_POST['server_root']))$server_root = $_POST['server_root'];

if(isset($nameDB) & isset($nameSERVER) & isset($nameUSER) & isset($passUSER) & isset($server_root))
{
    $dbNEW = "<?php
\$nameDB = \"".$nameDB."\";//Название БД
\$nameSERVER = \"".$nameSERVER."\";//Сервер
\$nameUSER = \"".$nameUSER."\";//Имя пользователя БД
\$passUSER = \"".$passUSER."\";//Пароль пользователя БД
mysql_select_db(\$nameDB, mysql_connect(\$nameSERVER,\$nameUSER,\$passUSER));

mysql_query(\"set character_set_client='cp1251'\");
mysql_query(\"set character_set_results='cp1251'\");
mysql_query(\"set collation_connection='cp1251_general_ci'\");

if(isset(\$_GET[\"server_root\"])){\$server_root = \$_GET[\"server_root\"];unset(\$server_root);}
if(isset(\$_POST[\"server_root\"])){\$server_root = \$_POST[\"server_root\"];unset(\$server_root);}

\$server_root = \"".$server_root."\";
?>";

    $DBfileUser = fopen("moduls/db.php", "w+");
    fwrite($DBfileUser,$dbNEW);
    fclose($DBfileUser);

    $DBfileAdmin = fopen("admin/moduls/db.php", "w+");
    fwrite($DBfileAdmin,$dbNEW);
    fclose($DBfileAdmin);

//ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ (БД)
    include("moduls/db.php");
//ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ (БД)

    $accounts = "CREATE TABLE IF NOT EXISTS accounts
(
	id int(10) NOT NULL AUTO_INCREMENT,
	status int(1) NOT NULL,
	sold_date datetime NOT NULL,
	id_acc varchar(10) NOT NULL,
	preview_ship varchar(255) NOT NULL,
	title varchar(255) NOT NULL,
	server varchar(255) NOT NULL,
	corp varchar(3) NOT NULL,
	level varchar(2) NOT NULL,
	exp varchar(15) NOT NULL,
	honor varchar(15) NOT NULL,
	rank varchar(15) NOT NULL,
	uri varchar(15) NOT NULL,
	cr varchar(15) NOT NULL,
	jackpot varchar(5) NOT NULL,
	hangar varchar(2) NOT NULL,
	tech varchar(1) NOT NULL,
	prog varchar(2) NOT NULL,
	drones varchar(10) NOT NULL,
	lf3 varchar(10) NOT NULL,
	lf4 varchar(10) NOT NULL,
	g3n7900 varchar(10) NOT NULL,
	sg3nb02 varchar(10) NOT NULL,
	mcb25 varchar(10) NOT NULL,
	mcb50 varchar(10) NOT NULL,
	sab50 varchar(10) NOT NULL,
	ucb100 varchar(10) NOT NULL,
	rsb75 varchar(10) NOT NULL,
	cbo100 varchar(10) NOT NULL,
	job100 varchar(10) NOT NULL,
	plt2021 varchar(10) NOT NULL,
	plt3030 varchar(10) NOT NULL,
	dcr250 varchar(10) NOT NULL,
	hstrm01 varchar(10) NOT NULL,
	ubr100 varchar(10) NOT NULL,
	sar02 varchar(10) NOT NULL,
	cbr varchar(10) NOT NULL,
	acm1 varchar(10) NOT NULL,
	empm01 varchar(10) NOT NULL,
	subm01 varchar(10) NOT NULL,
	ddm01 varchar(10) NOT NULL,
	slm01 varchar(10) NOT NULL,
	emp01 varchar(10) NOT NULL,
	more text NOT NULL,
	admin_text text NOT NULL,
	login_acc varchar(20) NOT NULL,
	pass_acc varchar(45) NOT NULL,
	mail varchar(255) NOT NULL,
	mail_pass varchar(255) NOT NULL,
	price int(6) NOT NULL,
	wallet varchar(255) NOT NULL,
	payout int(1) NOT NULL,
	PRIMARY KEY (id)
)
ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;";

    $menu = "CREATE TABLE IF NOT EXISTS menu
(
	id int(10) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	href varchar(255) NOT NULL,
	position int(2) NOT NULL,
	PRIMARY KEY (id)
)
ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;";

    $news = "CREATE TABLE IF NOT EXISTS news
(
	id int(10) NOT NULL AUTO_INCREMENT,
	block	int(1) NOT NULL,
	status int(1) NOT NULL,
	title	varchar(255) NOT NULL,
	text text NOT NULL,
	date_pub varchar(255) NOT NULL,
	meta_d varchar(255) NOT NULL,
	meta_k varchar(255) NOT NULL,
	PRIMARY KEY (id)
)
ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;";

    $page = "CREATE TABLE IF NOT EXISTS page
(
	id int(1) NOT NULL AUTO_INCREMENT,
	title varchar(255) NOT NULL,
	meta_d text NOT NULL,
	meta_k text NOT NULL,
	PRIMARY KEY (id)
)
ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;";

    $reviews = "CREATE TABLE IF NOT EXISTS reviews
(
	id int(10) NOT NULL AUTO_INCREMENT,
	status int(1) NOT NULL,
	author varchar(255) NOT NULL,
	post_date datetime NOT NULL,
	title varchar(255) NOT NULL,
	user_text text NOT NULL,
	admin_text text NOT NULL,
	PRIMARY KEY (id)
)
ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;";

    $user = "CREATE TABLE IF NOT EXISTS user
(
	id int(10) NOT NULL AUTO_INCREMENT,
	login varchar(16) NOT NULL,
	password varchar(100) NOT NULL,
	skype	varchar(32) NOT NULL,
	icq varchar(32) NOT NULL,
	mail varchar(32) NOT NULL,
	note varchar(255) NOT NULL,
	PRIMARY KEY (id)
)
ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;";

    mysql_query($accounts);
    mysql_query($menu);
    mysql_query($news);
    mysql_query($page);
    mysql_query($reviews);
    mysql_query($user);

    $title1 = "Порядок покупки игрового аккаунта";
    $text1 = '<p style="text-align: center;"><span style="font-size: 12pt; color: #99cc00;"><strong>Порядок покупки игрового аккаунта*</strong></span></p>
<ol style="list-style-type: upper-roman;">
<li>Свяжитесь с Администратором, контактные данные указаны в <a href="../buy.php">Каталоге</a> и сообщите ему id желаемого лота (пример: #123).</li>
<li>Оплатите игровой аккаунт электронными деньгами Webmoney или Яндекс.Деньги по представленным ниже реквизитам.</li>
<li>После оплаты, предоставьте Администратору электронную почту для перевода на нее игрового аккаунта.</li>
<li>В течении одного рабочего дня Вы получите логин и пароль от приобретённого игрового аккаунта.</li>
</ol>
<p style="text-align: center;"><strong><span style="color: #ff0000;">Остерегайтесь мошенничества!</span></strong></p>
<p style="text-align: center;"><strong><span style="color: #ff0000;">При оплате игрового акаунта электронными деньгами счет на который вы оплачиваете должен быть:</span></strong></p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><span style="color: #99cc00;"><strong>Яндекс-Деньги:</strong></span></p>
<p style="text-align: center;"><span style="color: #99cc00;"><strong>Webmoney:</strong></span></p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><strong><span style="color: #ff0000;">Если он отличается ни в коем случае не переводите!</span></strong></p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">Не забудьте оставить свой <a href="../reviews.php">отзыв</a> о работе нашего игрового портала.</p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #99cc00;"><strong>Благодарим за покупку!</strong></span></p>
<p style="text-align: center;">&nbsp;</p>
<p><span style="font-size: 8pt; color: #333333;">* претензии после покупки игровых аккаунтов принимаются в течении 4 дней, возврат денежных средств по истечении этого времени не производится.</span></p>';

    $title2 = "Добро пожаловать в CMS V-Red";
    $text2 = '<p style="text-align: center;"><strong>Добро пожаловать, Администратор!</strong></p>
<p style="text-align: center;"><strong>&nbsp;</strong></p>
<p style="text-align: center;"><strong>Если Вы видите это сообщение, значит скрипт сайта полностью настроен и готов к работе.</strong></p>
<p style="text-align: center;"><strong>Попасть в панель Администратора, Вы можете перейдя по ссылке, или набрав в адресной строке браузера:</strong></p>
<p style="text-align: center;"><strong><a target="_blank" href="'.$server_root.'admin/">'.$server_root.'admin/</a></strong></p>';

    $add_post = mysql_query("INSERT INTO news (block,status,title,text,date_pub) VALUES ('0','0','$title1','$text1',NOW()), ('0','1','$title2','$text2',NOW())");
    $add_main_menu = mysql_query("INSERT INTO menu (name,href,position)
VALUES ('Новости','index.php','1'),('Купить','buy.php','2'),('Продать','sell.php','3'),('Проданные','sold.php','4'),('Отзывы','reviews.php','5')");
    header("location: installer.php?step=2");
    exit;
}

//Сохраняем данных присланные из второй формы
if(isset($_POST['titleSITE']))$titleSITE = $_POST['titleSITE'];
if(isset($_POST['discSITE']))$discSITE = $_POST['discSITE'];
if(isset($_POST['keySITE']))$keySITE = $_POST['keySITE'];
if(isset($_POST['nameADMIN']))$nameADMIN = $_POST['nameADMIN'];
if(isset($_POST['passADMIN']))$passADMIN = $_POST['passADMIN'];
//Сохраняем данных присланные из второй формы

//Если был послан запрос из второй формы
if(isset($titleSITE) & isset($discSITE) & isset($keySITE) & isset($nameADMIN) & isset($passADMIN))
{
//ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ (БД)
    include("moduls/db.php");
//ПОДКЛЮЧЕНИЕ К БАЗЕ ДАННЫХ (БД)

    $passADMIN = md5($passADMIN);//Зашифровываем пароль через функцию md5

    $confIndex = mysql_query("INSERT INTO page (title,meta_d,meta_k) VALUES ('$titleSITE','$discSITE','$keySITE')");//Создаем запись в таблице page. Этим самым мы определим мета теги сайта
    $addADMIN = mysql_query("INSERT INTO user (login,password) VALUES ('$nameADMIN','$passADMIN')");//Создаем аккаунт администратора

    header("location: installer.php?step=3");//Пересылаем пользователя на третий шаг
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Установка CMS V-Red</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <link rel="stylesheet" type="text/css" href="/admin/templates/style.css">
    <link rel="shortcut icon" href="/templates/img/body/myicon.ico" type="image/x-icon">
</head>
<body>
<div class="div_body_center">
    <table width="700px" height="100%" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
            <td class="left_top" width="22px" height="22px"></td>
            <td class="top_reap"></td>
            <td class="right_top" width="22px" height="22px"></td>
        </tr>
        <tr>
            <td class="left" width="22px"></td>
            <td class="center" valign="top">
                <table width="100%" border="0" cellpadding="10" cellspacing="0">
                    <tr>
                        <td valign="top">
                            <p align="center" style="font-size:13pt;">Добро пожаловать на установку CMS V-Red!</p>

                            <!-- ШАГ 1 -->
                            <?php if($step == 1){ ?>
                                <form action="installer.php" method="post" name="conf_DB">
                                    <table width="400" border="0" cellpadding="5" cellspacing="0" align="center" style="margin-top:50px;margin-bottom:50px;" >
                                        <tr>
                                            <td colspan="2" align="center"><strong>Шаг 1 - Подключение к БД</strong></td>
                                        </tr>
                                        <tr>
                                            <td width="180px">Введите имя БД</td>
                                            <td><input style="width:220px;" type="text" name="nameDB"/></td>
                                        </tr>
                                        <tr>
                                            <td width="180px">Имя сервера</td>
                                            <td><input style="width:220px;" type="text" name="nameSERVER" value="localhost"/></td>
                                        </tr>
                                        <tr>
                                            <td width="180px">Доменное имя</td>
                                            <td><input style="width:220px;" type="text" name="server_root" value="http://имя.ru/"/></td>
                                        </tr>
                                        <tr>
                                            <td width="180px">Логин БД</td>
                                            <td><input style="width:220px;" type="text" name="nameUSER"/></td>
                                        </tr>
                                        <tr>
                                            <td width="180px">Пароль БД</td>
                                            <td><input style="width:220px;" type="password" name="passUSER"/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center"><input class="button" type="submit" value="Далее"/></td>
                                        </tr>
                                    </table>
                                </form>
                            <?php } ?>
                            <!-- ШАГ 1 -->

                            <!-- ШАГ 2 -->
                            <?php if($step == 2){ ?>
                                <form action="installer.php?step=2" method="post" name="conf_DB">
                                    <table width="400" border="0" cellpadding="5" cellspacing="0" align="center" style="margin-top:50px;margin-bottom:50px;" >
                                        <tr>
                                            <td colspan="2" align="center"><strong>Шаг 2 - Сбор данных</strong></td>
                                        </tr>
                                        <tr>
                                            <td width="180px">Название сайта</td>
                                            <td><input style="width:220px;" type="text" name="titleSITE"/></td>
                                        </tr>
                                        <tr>
                                            <td width="180px">Описание сайта</td>
                                            <td><input style="width:220px;" type="text" name="discSITE" value=""/></td>
                                        </tr>
                                        <tr>
                                            <td width="180px">Ключевые слова сайта</td>
                                            <td><input style="width:220px;" type="text" name="keySITE" value=""/></td>
                                        </tr>
                                        <tr>
                                            <td width="180px">Логин администратора</td>
                                            <td><input style="width:220px;" type="text" name="nameADMIN" value="admin"/></td>
                                        </tr>
                                        <tr>
                                            <td width="180px">Пароль администратора</td>
                                            <td><input style="width:220px;" type="password" name="passADMIN"/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center"><input class="button" type="submit" value="Далее" /></td>
                                        </tr>
                                    </table>
                                </form>
                            <?php } ?>
                            <!-- ШАГ 2 -->

                            <!-- ШАГ 3 -->
                            <?php if($step == 3){ ?>
                                <table width="400" border="0" cellpadding="5" cellspacing="0" align="center" style="margin-top:50px;margin-bottom:50px;" >
                                    <tr>
                                        <td colspan="2" align="center"><strong>Установка прошла успешно!</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><p style="color:red;font-size:15px;">Удалите файл installer.php из корня сайта</p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><a href="index.php">На главную</a></td>
                                    </tr>
                                </table>
                            <?php } ?>
                            <!-- ШАГ 3 -->
                        </td>
                    </tr>
                </table>
            </td>
            <td class="right" width="22px"></td>
        </tr>
        <tr>
            <td class="left_bottom" width="22px" height="22px"></td>
            <td class="bottom_reap"></td>
            <td class="right_bottom" width="22px" height="22px"></td>
        </tr>
    </table>
</div>
</body>
</html>
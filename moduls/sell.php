<?php
@$result_meta = mysql_query("SELECT * FROM page WHERE id='1'"); //Запрос на вывод системных данных (заголовок сайта, метатеги, ключивые слова)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "") //Если результат запроса имеет данные...
{
    $header_title = "Продать DarkOrbit - ".$myrow_meta[title];//Заголовок страницы (Имя аккаунта - имя сайта)
    $header_metaD = $myrow_meta[meta_d]; //метатеги
    $header_metaK = $myrow_meta[meta_k]; //ключивые слова
}

//------ОБРАБОТЧИК ОТПРАВКИ ОТЗЫВОВ
//Определяю существование посланных переменных из формы отправки отзыва
//--------Основное--------
if(isset($_POST['post_preview_ship']))$post_preview_ship = $_POST['post_preview_ship'];//Превью корабля
if(isset($_POST['post_title']))$post_title = $_POST['post_title'];//Заголовок
if(isset($_POST['post_id']))$post_id = $_POST['post_id'];//id аккаунта
if(isset($_POST['post_server']))$post_server = $_POST['post_server'];
if(isset($_POST['post_corp']))$post_corp = $_POST['post_corp'];
if(isset($_POST['post_level']))$post_level = $_POST['post_level'];
if(isset($_POST['post_exp']))$post_exp = $_POST['post_exp'];
if(isset($_POST['post_honor']))$post_honor = $_POST['post_honor'];
if(isset($_POST['post_rank']))$post_rank = $_POST['post_rank'];
if(isset($_POST['post_uri']))$post_uri = $_POST['post_uri'];
if(isset($_POST['post_cr']))$post_cr = $_POST['post_cr'];
if(isset($_POST['post_jackpot']))$post_jackpot = $_POST['post_jackpot'];
if(isset($_POST['post_hangar']))$post_hangar = $_POST['post_hangar'];
if(isset($_POST['post_tech']))$post_tech = $_POST['post_tech'];
if(isset($_POST['post_prog']))$post_prog = $_POST['post_prog'];
//--------Основное--------

//--------Дроиды--------
if(isset($_POST['post_drone1']))$post_drone1 = $_POST['post_drone1'];
if(isset($_POST['post_drone2']))$post_drone2 = $_POST['post_drone2'];
if(isset($_POST['post_drone3']))$post_drone3 = $_POST['post_drone3'];
if(isset($_POST['post_drone4']))$post_drone4 = $_POST['post_drone4'];
if(isset($_POST['post_drone5']))$post_drone5 = $_POST['post_drone5'];
if(isset($_POST['post_drone6']))$post_drone6 = $_POST['post_drone6'];
if(isset($_POST['post_drone7']))$post_drone7 = $_POST['post_drone7'];
if(isset($_POST['post_drone8']))$post_drone8 = $_POST['post_drone8'];
if(isset($_POST['post_drone9']))$post_drone9 = $_POST['post_drone9'];
if(isset($_POST['post_drone10']))$post_drone10 = $_POST['post_drone10'];
//--------Дроиды--------

//--------Оружие/Генераторы--------
if(isset($_POST['post_lf3']))$post_lf3 = $_POST['post_lf3'];
if(isset($_POST['post_lf4']))$post_lf4 = $_POST['post_lf4'];
if(isset($_POST['post_g3n7900']))$post_g3n7900 = $_POST['post_g3n7900'];
if(isset($_POST['post_sg3nb02']))$post_sg3nb02 = $_POST['post_sg3nb02'];
//--------Оружие/Генераторы--------

//--------Боеприпасы--------
if(isset($_POST['post_mcb25']))$post_mcb25 = $_POST['post_mcb25'];
if(isset($_POST['post_mcb50']))$post_mcb50 = $_POST['post_mcb50'];
if(isset($_POST['post_sab50']))$post_sab50 = $_POST['post_sab50'];
if(isset($_POST['post_ucb100']))$post_ucb100 = $_POST['post_ucb100'];
if(isset($_POST['post_rsb75']))$post_rsb75 = $_POST['post_rsb75'];
if(isset($_POST['post_cbo100']))$post_cbo100 = $_POST['post_cbo100'];
if(isset($_POST['post_job100']))$post_job100 = $_POST['post_job100'];
if(isset($_POST['post_plt2021']))$post_plt2021 = $_POST['post_plt2021'];
if(isset($_POST['post_plt3030']))$post_plt3030 = $_POST['post_plt3030'];
if(isset($_POST['post_dcr250']))$post_dcr250 = $_POST['post_dcr250'];
if(isset($_POST['post_hstrm01']))$post_hstrm01 = $_POST['post_hstrm01'];
if(isset($_POST['post_ubr100']))$post_ubr100 = $_POST['post_ubr100'];
if(isset($_POST['post_sar02']))$post_sar02 = $_POST['post_sar02'];
if(isset($_POST['post_cbr']))$post_cbr = $_POST['post_cbr'];
if(isset($_POST['post_acm1']))$post_acm1 = $_POST['post_acm1'];
if(isset($_POST['post_empm01']))$post_empm01 = $_POST['post_empm01'];
if(isset($_POST['post_subm01']))$post_subm01 = $_POST['post_subm01'];
if(isset($_POST['post_ddm01']))$post_ddm01 = $_POST['post_ddm01'];
if(isset($_POST['post_slm01']))$post_slm01 = $_POST['post_slm01'];
if(isset($_POST['post_emp01']))$post_emp01 = $_POST['post_emp01'];
//--------Боеприпасы--------

if(isset($_POST['post_more']))$post_more = $_POST['post_more']; //Дополнительное описание

//--------Личные данные--------
if(isset($_POST['post_login_acc']))$post_login_acc = $_POST['post_login_acc'];
if(isset($_POST['post_pass_acc']))$post_pass_acc = $_POST['post_pass_acc'];
if(isset($_POST['post_mail']))$post_mail = $_POST['post_mail'];
if(isset($_POST['post_mail_pass']))$post_mail_pass = $_POST['post_mail_pass'];
if(isset($_POST['post_price']))$post_price = $_POST['post_price'];
if(isset($_POST['post_wallet']))$post_wallet = $_POST['post_wallet'];
if(isset($_POST['post_wallet_type']))$post_wallet_type = $_POST['post_wallet_type'];
//--------Личные данные--------

if($post_title & $post_id & $post_server & $post_corp & $post_level & $post_uri & $post_cr & $post_login_acc & $post_pass_acc & $post_mail & $post_mail_pass & $post_price & $post_wallet & $post_wallet_type)//Если посланные переменные определены как существующие...
{
    if($post_preview_ship == 'spearhead' OR $post_preview_ship == 'citadel' OR $post_preview_ship == 'aegis')
    {
        $post_preview_ship .= '_'.$post_corp; //Корабли, с цветом корпорации
    }
    $post_drones = $post_drone1.$post_drone2.$post_drone3.$post_drone4.$post_drone5.$post_drone6.$post_drone7.$post_drone8.$post_drone9.$post_drone10;//Дроиды

    //Функция "htmlspecialchars" преобразует html теги (если таковые были введены пользователем) в спец символы
    $post_preview_ship = htmlspecialchars($post_preview_ship);/*--*/$post_preview_ship = str_replace("'","&#039",$post_preview_ship);
    $post_title = htmlspecialchars($post_title);/*--*/$post_title = str_replace("'","&#039",$post_title);
    $post_id = htmlspecialchars($post_id);/*--*/$post_id = str_replace("'","&#039",$post_id);
    $post_server = htmlspecialchars($post_server);/*--*/$post_server = str_replace("'","&#039",$post_server);
    $post_corp = htmlspecialchars($post_corp);/*--*/$post_corp = str_replace("'","&#039",$post_corp);
    $post_level = htmlspecialchars($post_level);/*--*/$post_level = str_replace("'","&#039",$post_level);
    $post_exp = htmlspecialchars($post_exp);/*--*/$post_exp = str_replace("'","&#039",$post_exp);
    $post_honor = htmlspecialchars($post_honor);/*--*/$post_honor = str_replace("'","&#039",$post_honor);
    $post_rank = htmlspecialchars($post_rank);/*--*/$post_rank = str_replace("'","&#039",$post_rank);
    $post_uri = htmlspecialchars($post_uri);/*--*/$post_uri = str_replace("'","&#039",$post_uri);
    $post_cr = htmlspecialchars($post_cr);/*--*/$post_cr = str_replace("'","&#039",$post_cr);
    $post_jackpot = htmlspecialchars($post_jackpot);/*--*/$post_jackpot = str_replace("'","&#039",$post_jackpot);
    $post_hangar = htmlspecialchars($post_hangar);/*--*/$post_hangar = str_replace("'","&#039",$post_hangar);
    $post_tech = htmlspecialchars($post_tech);/*--*/$post_tech = str_replace("'","&#039",$post_tech);
    $post_prog = htmlspecialchars($post_prog);/*--*/$post_prog = str_replace("'","&#039",$post_prog);
    $post_drones = htmlspecialchars($post_drones);/*--*/$post_drones = str_replace("'","&#039",$post_drones);
    $post_lf3 = htmlspecialchars($post_lf3);/*--*/$post_lf3 = str_replace("'","&#039",$post_lf3);
    $post_lf4 = htmlspecialchars($post_lf4);/*--*/$post_lf4 = str_replace("'","&#039",$post_lf4);
    $post_g3n7900 = htmlspecialchars($post_g3n7900);/*--*/$post_g3n7900 = str_replace("'","&#039",$post_g3n7900);
    $post_sg3nb02 = htmlspecialchars($post_sg3nb02);/*--*/$post_sg3nb02 = str_replace("'","&#039",$post_sg3nb02);
    $post_mcb25 = htmlspecialchars($post_mcb25);/*--*/$post_mcb25 = str_replace("'","&#039",$post_mcb25);
    $post_mcb50 = htmlspecialchars($post_mcb50);/*--*/$post_mcb50 = str_replace("'","&#039",$post_mcb50);
    $post_sab50 = htmlspecialchars($post_sab50);/*--*/$post_sab50 = str_replace("'","&#039",$post_sab50);
    $post_ucb100 = htmlspecialchars($post_ucb100);/*--*/$post_ucb100 = str_replace("'","&#039",$post_ucb100);
    $post_rsb75 = htmlspecialchars($post_rsb75);/*--*/$post_rsb75 = str_replace("'","&#039",$post_rsb75);
    $post_cbo100 = htmlspecialchars($post_cbo100);/*--*/$post_cbo100 = str_replace("'","&#039",$post_cbo100);
    $post_job100 = htmlspecialchars($post_job100);/*--*/$post_job100 = str_replace("'","&#039",$post_job100);
    $post_plt2021 = htmlspecialchars($post_plt2021);/*--*/$post_plt2021 = str_replace("'","&#039",$post_plt2021);
    $post_plt3030 = htmlspecialchars($post_plt3030);/*--*/$post_plt3030 = str_replace("'","&#039",$post_plt3030);
    $post_dcr250 = htmlspecialchars($post_dcr250);/*--*/$post_dcr250 = str_replace("'","&#039",$post_dcr250);
    $post_hstrm01 = htmlspecialchars($post_hstrm01);/*--*/$post_hstrm01 = str_replace("'","&#039",$post_hstrm01);
    $post_ubr100 = htmlspecialchars($post_ubr100);/*--*/$post_ubr100 = str_replace("'","&#039",$post_ubr100);
    $post_sar02 = htmlspecialchars($post_sar02);/*--*/$post_sar02 = str_replace("'","&#039",$post_sar02);
    $post_cbr = htmlspecialchars($post_cbr);/*--*/$post_cbr = str_replace("'","&#039",$post_cbr);
    $post_acm1 = htmlspecialchars($post_acm1);/*--*/$post_acm1 = str_replace("'","&#039",$post_acm1);
    $post_empm01 = htmlspecialchars($post_empm01);/*--*/$post_empm01 = str_replace("'","&#039",$post_empm01);
    $post_subm01 = htmlspecialchars($post_subm01);/*--*/$post_subm01 = str_replace("'","&#039",$post_subm01);
    $post_ddm01 = htmlspecialchars($post_ddm01);/*--*/$post_ddm01 = str_replace("'","&#039",$post_ddm01);
    $post_slm01 = htmlspecialchars($post_slm01);/*--*/$post_slm01 = str_replace("'","&#039",$post_slm01);
    $post_emp01 = htmlspecialchars($post_emp01);/*--*/$post_emp01 = str_replace("'","&#039",$post_emp01);
    $post_more = htmlspecialchars($post_more);/*--*/$post_more = str_replace("'","&#039",$post_more);
    $post_login_acc = htmlspecialchars($post_login_acc);/*--*/$post_login_acc = str_replace("'","&#039",$post_login_acc);
    $post_pass_acc = htmlspecialchars($post_pass_acc);/*--*/$post_pass_acc = str_replace("'","&#039",$post_pass_acc);
    $post_mail = htmlspecialchars($post_mail);/*--*/$post_mail = str_replace("'","&#039",$post_mail);
    $post_mail_pass = htmlspecialchars($post_mail_pass);/*--*/$post_mail_pass = str_replace("'","&#039",$post_mail_pass);
    $post_price = htmlspecialchars($post_price);/*--*/$post_price = str_replace("'","&#039",$post_price);
    $post_wallet = htmlspecialchars($post_wallet);/*--*/$post_wallet = str_replace("'","&#039",$post_wallet);
    $post_wallet_type = htmlspecialchars($post_wallet_type);/*--*/$post_wallet_type = str_replace("'","&#039",$post_wallet_type);
    //Функция "htmlspecialchars" преобразует html теги (если таковые были введены пользователем) в спец символы

    $post_more = str_replace("\n","<br>",$post_more);//Замена переноса строки пользователского текста на тег <br>

    $result = mysql_query ("
	INSERT INTO accounts (status,id_acc,preview_ship,title,server,corp,level,exp,honor,rank,uri,cr,jackpot,hangar,tech,prog,drones,lf3,lf4,g3n7900,sg3nb02,mcb25,mcb50,sab50,ucb100,rsb75,cbo100,job100,plt2021,plt3030,dcr250,hstrm01,ubr100,sar02,cbr,acm1,empm01,subm01,ddm01,slm01,emp01,more,admin_text,login_acc,pass_acc,mail,mail_pass,price,wallet,wallet_type,payout)
	VALUES ('0','$post_id','$post_preview_ship','$post_title','$post_server','$post_corp','$post_level','$post_exp','$post_honor','$post_rank','$post_uri','$post_cr','$post_jackpot','$post_hangar','$post_tech','$post_prog',
	'$post_drones','$post_lf3','$post_lf4','$post_g3n7900','$post_sg3nb02','$post_mcb25','$post_mcb50','$post_sab50','$post_ucb100','$post_rsb75','$post_cbo100','$post_job100','$post_plt2021','$post_plt3030','$post_dcr250',
	'$post_hstrm01','$post_ubr100','$post_sar02','$post_cbr','$post_acm1','$post_empm01','$post_subm01','$post_ddm01','$post_slm01','$post_emp01','$post_more','Аккаунт находится в очереди на проверку соответствия описанию','$post_login_acc','$post_pass_acc','$post_mail',
	'$post_mail_pass','$post_price','$post_wallet','$post_wallet_type','0')");//Запись данных в БД
    $id = mysql_insert_id();//Возвращает идентификатор, сгенерированный колонкой с AUTO_INCREMENT последним запросом
    header("location: buy.php?id=$id");//Перенаправление пользователя после отправки сообщения
    exit;
}
function sell()//Функция вывода одобренных отзывов
{
    $sm_read = file("templates/sell.html");//Подключаю шаблон
    $sm_read = implode("",$sm_read);//Т.к. функция file() возвращает массив, его нужно склеить
    return $sm_read;//Вывод сгенерированного html кода
}
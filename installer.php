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
\$nameDB = \"".$nameDB."\";//�������� ��
\$nameSERVER = \"".$nameSERVER."\";//������
\$nameUSER = \"".$nameUSER."\";//��� ������������ ��
\$passUSER = \"".$passUSER."\";//������ ������������ ��
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
	
//����������� � ���� ������ (��)
include("moduls/db.php");
//����������� � ���� ������ (��)

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

$title1 = "������� ������� �������� ��������";
$text1 = '<p style="text-align: center;"><span style="font-size: 12pt; color: #99cc00;"><strong>������� ������� �������� ��������*</strong></span></p>
<ol style="list-style-type: upper-roman;">
<li>��������� � ���������������, ���������� ������ ������� � <a href="../buy.php">��������</a> � �������� ��� id ��������� ���� (������: #123).</li>
<li>�������� ������� ������� ������������ �������� Webmoney ��� ������.������ �� �������������� ���� ����������.</li>
<li>����� ������, ������������ �������������� ����������� ����� ��� �������� �� ��� �������� ��������.</li>
<li>� ������� ������ �������� ��� �� �������� ����� � ������ �� ������������� �������� ��������.</li>
</ol>
<p style="text-align: center;"><strong><span style="color: #ff0000;">������������� �������������!</span></strong></p>
<p style="text-align: center;"><strong><span style="color: #ff0000;">��� ������ �������� ������� ������������ �������� ���� �� ������� �� ����������� ������ ����:</span></strong></p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><span style="color: #99cc00;"><strong>������-������:</strong></span></p>
<p style="text-align: center;"><span style="color: #99cc00;"><strong>Webmoney:</strong></span></p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;"><strong><span style="color: #ff0000;">���� �� ���������� �� � ���� ������ �� ����������!</span></strong></p>
<p style="text-align: center;">&nbsp;</p>
<p style="text-align: center;">�� �������� �������� ���� <a href="../reviews.php">�����</a> � ������ ������ �������� �������.</p>
<p style="text-align: center;"><span style="font-size: 12pt; color: #99cc00;"><strong>���������� �� �������!</strong></span></p>
<p style="text-align: center;">&nbsp;</p>
<p><span style="font-size: 8pt; color: #333333;">* ��������� ����� ������� ������� ��������� ����������� � ������� 4 ����, ������� �������� ������� �� ��������� ����� ������� �� ������������.</span></p>';

$title2 = "����� ���������� � CMS V-Red";
$text2 = '<p style="text-align: center;"><strong>����� ����������, �������������!</strong></p>
<p style="text-align: center;"><strong>&nbsp;</strong></p>
<p style="text-align: center;"><strong>���� �� ������ ��� ���������, ������ ������ ����� ��������� �������� � ����� � ������.</strong></p>
<p style="text-align: center;"><strong>������� � ������ ��������������, �� ������ ������� �� ������, ��� ������ � �������� ������ ��������:</strong></p>
<p style="text-align: center;"><strong><a target="_blank" href="'.$server_root.'admin/">'.$server_root.'admin/</a></strong></p>';

$add_post = mysql_query("INSERT INTO news (block,status,title,text,date_pub) VALUES ('0','0','$title1','$text1',NOW()), ('0','1','$title2','$text2',NOW())");
$add_main_menu = mysql_query("INSERT INTO menu (name,href,position) 
VALUES ('�������','index.php','1'),('������','buy.php','2'),('�������','sell.php','3'),('���������','sold.php','4'),('������','reviews.php','5')");
header("location: installer.php?step=2");
exit;
}

//��������� ������ ���������� �� ������ �����
if(isset($_POST['titleSITE']))$titleSITE = $_POST['titleSITE'];
if(isset($_POST['discSITE']))$discSITE = $_POST['discSITE'];
if(isset($_POST['keySITE']))$keySITE = $_POST['keySITE'];
if(isset($_POST['nameADMIN']))$nameADMIN = $_POST['nameADMIN'];
if(isset($_POST['passADMIN']))$passADMIN = $_POST['passADMIN'];
//��������� ������ ���������� �� ������ �����

//���� ��� ������ ������ �� ������ �����
if(isset($titleSITE) & isset($discSITE) & isset($keySITE) & isset($nameADMIN) & isset($passADMIN))
{
//����������� � ���� ������ (��)
include("moduls/db.php");
//����������� � ���� ������ (��)

$passADMIN = md5($passADMIN);//������������� ������ ����� ������� md5

$confIndex = mysql_query("INSERT INTO page (title,meta_d,meta_k) VALUES ('$titleSITE','$discSITE','$keySITE')");//������� ������ � ������� page. ���� ����� �� ��������� ���� ���� �����
$addADMIN = mysql_query("INSERT INTO user (login,password) VALUES ('$nameADMIN','$passADMIN')");//������� ������� ��������������

header("location: installer.php?step=3");//���������� ������������ �� ������ ���
exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>��������� CMS V-Red</title>
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
								<p align="center" style="font-size:13pt;">����� ���������� �� ��������� CMS V-Red!</p>
								
								<!-- ��� 1 -->
								<?php if($step == 1){ ?>
									<form action="installer.php" method="post" name="conf_DB">
									<table width="400" border="0" cellpadding="5" cellspacing="0" align="center" style="margin-top:50px;margin-bottom:50px;" >
										<tr>
											<td colspan="2" align="center"><strong>��� 1 - ����������� � ��</strong></td>
										</tr>
										<tr>
											<td width="180px">������� ��� ��</td>
											<td><input style="width:220px;" type="text" name="nameDB"/></td>
										</tr>
										<tr>
											<td width="180px">��� �������</td>
											<td><input style="width:220px;" type="text" name="nameSERVER" value="localhost"/></td>
										</tr>
										<tr>
											<td width="180px">�������� ���</td>
											<td><input style="width:220px;" type="text" name="server_root" value="http://���.ru/"/></td>
										</tr>
										<tr>
											<td width="180px">����� ��</td>
											<td><input style="width:220px;" type="text" name="nameUSER"/></td>
										</tr>
										<tr>
											<td width="180px">������ ��</td>
											<td><input style="width:220px;" type="password" name="passUSER"/></td>
										</tr>
										<tr>
											<td colspan="2" align="center"><input class="button" type="submit" value="�����"/></td>
										</tr>
									</table>
									</form>
								<?php } ?>
								<!-- ��� 1 -->
								
								<!-- ��� 2 -->
								<?php if($step == 2){ ?>
									<form action="installer.php?step=2" method="post" name="conf_DB">
									<table width="400" border="0" cellpadding="5" cellspacing="0" align="center" style="margin-top:50px;margin-bottom:50px;" >
										<tr>
											<td colspan="2" align="center"><strong>��� 2 - ���� ������</strong></td>
										</tr>
										<tr>
											<td width="180px">�������� �����</td>
											<td><input style="width:220px;" type="text" name="titleSITE"/></td>
										</tr>
										<tr>
											<td width="180px">�������� �����</td>
											<td><input style="width:220px;" type="text" name="discSITE" value=""/></td>
										</tr>
										<tr>
											<td width="180px">�������� ����� �����</td>
											<td><input style="width:220px;" type="text" name="keySITE" value=""/></td>
										</tr>
										<tr>
											<td width="180px">����� ��������������</td>
											<td><input style="width:220px;" type="text" name="nameADMIN" value="admin"/></td>
										</tr>
										<tr>
											<td width="180px">������ ��������������</td>
											<td><input style="width:220px;" type="password" name="passADMIN"/></td>
										</tr>
										<tr>
											<td colspan="2" align="center"><input class="button" type="submit" value="�����" /></td>
										</tr>
									</table>
									</form>
								<?php } ?>
								<!-- ��� 2 -->
								
								<!-- ��� 3 -->
								<?php if($step == 3){ ?>
									<table width="400" border="0" cellpadding="5" cellspacing="0" align="center" style="margin-top:50px;margin-bottom:50px;" >
										<tr>
											<td colspan="2" align="center"><strong>��������� ������ �������!</strong></td>
										</tr>
										<tr>
											<td colspan="2" align="center"><p style="color:red;font-size:15px;">������� ���� installer.php �� ����� �����</p></td>
										</tr>
										<tr>
											<td colspan="2" align="center"><a href="index.php">�� �������</a></td>
										</tr>
									</table>
								<?php } ?>
								<!-- ��� 3 -->
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
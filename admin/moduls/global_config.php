<?php
//����������
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
    $newCONFIGpage = mysql_query ("UPDATE page SET title='$cfgtitle',meta_d='$cfgmetaD',meta_k='$cfgmetaK' WHERE id='1'");//���������� ��������
    $cfgnote = str_replace("\n","<br>",$cfgnote);//������ �������� ������ �� ��� <BR>
    //���������� ������ ������
    if($cfgpassD != "")//���� ���� ������ �� ������
    {		
        $newpass = md5($cfgpassD);//������� ����� ������
        $sql = "UPDATE user SET login='$cfglogin',password='$newpass',skype='$cfgskype',icq='$cfgicq',mail='$cfgmail',note='$cfgnote' WHERE id='1'";
    }
    else 
	{//���� ������ ������
		$sql = "UPDATE user SET login='$cfglogin',skype='$cfgskype',icq='$cfgicq',mail='$cfgmail',note='$cfgnote' WHERE id='1'";
    }     
    $newCONFIGuser = mysql_query ($sql);//���������� ������ ������
    //���������� ������ ������
    header("location: ?page=config");//��������� ������������ �� �������� �� ������� ��������
    exit;
}
//����������

function global_config()//������� ������ ������ ��������
{
    $result_page = mysql_query("SELECT * FROM page WHERE id='1'");//����� ������ �� ������ ������ ������� � ���������� ������� �����
    $myrow_page = mysql_fetch_array($result_page);
	
	$result_user = mysql_query("SELECT * FROM user WHERE id='1'");//����� ������ �� ������ ������ ������� ������ ������ ��������������
    $myrow_user = mysql_fetch_array($result_user);
        
    $sm_read = file("templates/global_config.html");//��������� ������
    $sm_read = implode("",$sm_read);//���������� �������, ������������� �������� file()
	$cfgnote = str_replace("<br>","",$myrow_user[note]);//�������� br � ������ �� �������
    //������ ���-����
    $sm_read = str_replace("[_title]",$myrow_page['title'],$sm_read);//���������
    $sm_read = str_replace("[_metaD]",$myrow_page['meta_d'],$sm_read);//�������� �����
    $sm_read = str_replace("[_metaK]",$myrow_page['meta_k'],$sm_read);//�������� �����
	$sm_read = str_replace("[_login]",$myrow_user['login'],$sm_read);//�����
	$sm_read = str_replace("[_skype]",$myrow_user['skype'],$sm_read);//�����
    $sm_read = str_replace("[_icq]",$myrow_user['icq'],$sm_read);//�����
    $sm_read = str_replace("[_mail]",$myrow_user['mail'],$sm_read);//����
	$sm_read = str_replace("[_note]",$cfgnote,$sm_read);//���.����
    return $sm_read;//����� ���������������� html ����
}
?>
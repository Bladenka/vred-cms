<?php
include("moduls/db.php");//����������� � ���� ������

//�����������
//������������ ���������� �����/������ �������� ������� � �����
if (isset ($_GET['loginDB'])) {$loginDB = $_GET['loginDB'];unset($loginDB);}
if (isset ($_GET['passwordDB'])) {$passwordDB = $_GET['passwordDB'];unset($passwordDB);}

//��������� �������� ������ ����� �������� �����
if (isset ($_POST['loginDB'])) {$loginDB = $_POST['loginDB'];}
if (isset ($_POST['passwordDB'])) {$passwordDB = $_POST['passwordDB'];}

if(isset($loginDB) AND isset($passwordDB))//���� ���������� ����� � ������
{	
    if(preg_match("/^[a-zA-Z0-9_-]+$/s",$loginDB) AND preg_match("/^[a-zA-Z0-9]+$/s",$passwordDB))//������ ����������� �� ������������
    {
        $prov = getenv('HTTP_REFERER');//����������� �������� � ������� ������ ������
        $prov = str_replace("www.","",$prov);//www ���������, ���� ��� ����
        preg_match("/(http\:\/\/[-a-z0-9_.]+\/)/",$prov,$prov_pm);//� ������� ������� ������� ����������� ��������� ��������� ������ �� ������� ��: http://xxxx.ru
        $prov = $prov_pm[1];//������ ����� ��������� � ��������� ����������
        $server_root = str_replace("www.","",$server_root);//www ���������, ���� ��� ����

        if($server_root == $prov)//���� ����� ����� ����� � ����� �������� � ������� ��� ������� ����� ���������, ��
        {
            $passwordDB = md5($passwordDB);//��������� ������ ���������
            $resultlp = mysql_query("SELECT login,password FROM user WHERE login='$loginDB'");//������� ������ �� �� (����� � ������)
  			$log_and_pass = mysql_fetch_array($resultlp);
            if($log_and_pass != "")//��������, �� ������������� ������ ������ � ��...
            {
                if($loginDB == $log_and_pass[login] AND $passwordDB == $log_and_pass[password])//���� ��������� ���������� ��������� � ����������� ��
                {
                    session_start();//����� ������
      				$_SESSION['$logSESS'] = $log_and_pass[login];//������� ���������� ����������
      				header("location: index.php");//��������������� �� ������� ��������
      				exit;				
                }
                else//���� ��������� ���������� �� ��������� � ����������� ��
                {
                    header("location: login.php");//��������������� �� ����� �����������
                    exit; 				
                }
            }
            else//���� ������� ���...
            {
                header("location: login.php");//��������������� �� ����� �����������
                exit;
            }
        }
        else//���� ������ ��� ������ � ������� ������
        {
            header("location: login.php");//��������������� �� ����� �����������
            exit; 			
        }
    }
    else//���� ������� �� ���������� ����� � ������
    {
        header("location: login.php");//��������� �� ����� �����������
        exit; 
    }	
}
//�����������

//���� ����
$header_title = "�����������";
$header_metaD = "�����������";
$header_metaK = "�����������";
//���� ����

function form_author()//������� ������ ����� �����������
{
    $sm_read = file("templates/login.html");//����������� �������
    $sm_read = implode("",$sm_read);
    return $sm_read;//����� ����������
}

$content = form_author();//����� �������
include("templates/index.html");//������� ������
?>
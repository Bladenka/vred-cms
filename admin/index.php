<?
$header_title = "������ ��������������";
$header_metaD = "";
$header_metaK = "";

include("moduls/db.php");//����������� � ���� ������

//������ �������� �����������
if(isset($_GET['logSESS'])) {$logSESS = $_GET['logSESS'];unset($logSESS);}
if(isset($_POST['logSESS'])) {$logSESS = $_POST['logSESS'];unset($logSESS);}
session_start();
$logSESS = $_SESSION['$logSESS'];
if(!isset($logSESS))
{
	header("location: login.php");
	exit;  
}
//������ �������� �����������

if($_GET['id'])$id = $_GET['id'];
if($_GET['page'])$page = $_GET['page'];//��������� ��������, ������� ������ �������
else $page = "index";//���� ���������� �� ����������, ������ ������� ������� ��������

//������� ��������
if($page == "index")//���� ������� ������� ��������
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
}
//������� ��������

//---------------------------���������������� ����
//���������� ������ ����������������� ����
if($page == "menu_add")
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
	include("moduls/menu_add.php");
	$content = menu_add();
}
//���������� ������ ����������������� ����
//�������� ����������������� ����
if($page == "menu_list" || $page == "menu_update")
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
	include("moduls/menu_list.php");//����������� ������
	if($page == "menu_list")$content = menu_list();
	if($page == "menu_update")$content = menu_update($id);
}
//�������� ����������������� ����
//---------------------------���������������� ����

//---------------------------�������
//���������� ��������
if($page == "news_add")//���� ������� �������� ���������� ��������
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
	include("moduls/news_add.php");//����������� ������
	$content = news_add();//������� html ��� ������� � ����������
}
//���������� ��������
//�������� � ����� ��������
if($page == "news_list" || $page == "news_update")
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
	include("moduls/news_list.php");//����������� ������
	if($page == "news_list")$content = news_list();//���� ������� ��� �� ������� ��� ��������������
	if($page == "news_update")$content = news_update($id);//���� ������� �������
}
//�������� � ����� ��������
//��������� ��������� ������
if($page == "news_config")
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
	include("moduls/news_config.php");//����������� ������
	$content = news_config($id);
}
//��������� ��������� ������
//---------------------------�������

//---------------------------������� ���������
//�������� �������� ���������
if($page == "accs_unverified" || $page == "accs_verified" || $page == "accs_sold" || $page == "accs_update")
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
	include("moduls/accs_list.php");//����������� ������
	if($page == "accs_unverified")$content = accs_unverified();//�������� � ������ ����������
	if($page == "accs_verified")$content = accs_verified();//�������� � ����������� ����������
	if($page == "accs_sold")$content = accs_sold();//������ ���������
	if($page == "accs_update")$content = accs_update($id);//�������������� ����������
}
//�������� �������� ���������
//��������� �������� ���������
if($page == "accs_config")
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
	include("moduls/accs_config.php");//����������� ������
	if($page == "accs_config")$content = accs_config($id);//���� ������� �������
}
//��������� �������� ���������
//---------------------------������� ���������

//---------------------------������
//�������� �������
if($page == "reviews_verified" || $page == "reviews_update")
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
	include("moduls/reviews_verified.php");//���������� ��� ������
	if($page == "reviews_verified")$content = reviews_verified();//���� ����� ��� �� ������ ��� ��������������
	if($page == "reviews_update")$content = reviews_update($id);//���� ����� ������
}
//�������� �������
//��������� �������
if($page == "reviews_unverified")
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
	include("moduls/reviews_unverified.php");
	$content = reviews_unverified();
}
//��������� �������
//---------------------------������

//---------------------------��������� �����
if($page == "config")
{
	include("moduls/main_menu.php");//����������� ������
	$main_menu = main_menu();//������� html ��� ������� � ����������
	include("moduls/global_config.php");//���������� ������
	$content = global_config();
}
//---------------------------��������� �����
include("templates/index.html");//����� �������� ������� �� �����
?>
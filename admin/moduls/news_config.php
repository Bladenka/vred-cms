<?php
//����������
if(isset($_POST['status']))$status = $_POST['status'];
if(isset($_POST['block']))$block = $_POST['block'];

if(isset($status) AND isset($block))//���� ��������� ���������� ���������� ��� ������������...
{
    $newCONFIG = mysql_query ("UPDATE news SET status='$status',block='$block' WHERE id='$id'");//���������� ��������
    header("location: ?page=news_list");//��������������� � ������ ��������
    exit;
}
//����������

function news_config($id)//������� ������ ������ �������� �����
{
	$result_index = mysql_query("SELECT status,block FROM news WHERE id='$id'");//������ �� ������� "news(�������)" ��������� ������� �������
	$myrow_index = mysql_fetch_array($result_index);
    if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/news_config.html");//��������� ������
			$templates = implode("",$templates);//���������� �������, ������������� �������� file()

			//-----��������� ������� �� ������� ��������?----
			$vblQUEtxt = array("���","��");//������� ��� ��������
			$vblQUEint = array(0,1);//������� ��� �������
			$vbl = queCFG($myrow_index[block],$vblQUEtxt,$vblQUEint);//��������� option ��� ������ "�����" ��������� ��������
			//-----��������� ������� �� ������� ��������?----
			
			//-----������������ �������?----
			$viQUEtxt = array("���","��");//������� ��� ��������
			$viQUEint = array(0,1);//������� ��� �������
			$vi = queCFG($myrow_index[status],$viQUEtxt,$viQUEint);//����������� option ��� ������ "���������� �������"
			//-----������������ �������?----

			//������ ���-����
			$templates = str_replace("[_id]",$id,$templates);//ID �����
			$templates = str_replace("[_cfgvi]",$vi,$templates);//��������� ����� �� ������� ��������
			$templates = str_replace("[_cfgblock]",$vbl,$templates);//���������� ����� �� �� ���
		}
		else 
		{//���� ��������� ������� ������ �� ����� (������)...
			$templates = file("templates/error.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '������'; //��������� ������
			$message = '������ �������������� ������������� �������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
		}
	return $templates;//����� ���������������� html ����
}
//----------------------------------------------------------------------
function queCFG($sel)//������� ��������� ��������� �������
{
for($i=0;$i<2;$i++)
{
	//� ����������� �� ���������� i ����������� ��������� �������
    if($i == 0)$txtsel = "���";
	else $txtsel = "��";
    //��������� ����� ������� ������ ������
    if($sel == $i)$result .= "<option value='$i' selected>$txtsel</option>";//� option ���������� �������� ������������� selected
    else $result .= "<option value='$i'>$txtsel</option>";//��������� �������� ����� ��� �������� selected
}
return $result;//������� � �������������� html ���
}
?>
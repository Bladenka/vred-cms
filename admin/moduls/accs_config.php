<?php
//��������� ����������
if(isset($_POST['cfgstatus']))$cfgstatus = $_POST['cfgstatus'];
if(isset($_POST['cfgpayout']))$cfgpayout = $_POST['cfgpayout'];

//����������
if(isset($cfgstatus) & isset($cfgpayout))//���� ���������� ����� ������
{	
	$newCONFIG = mysql_query ("UPDATE accounts SET sold_date=NOW(),status='$cfgstatus',payout='$cfgpayout' WHERE id='$id'");//��������� ���������
	header("location: ".getenv('HTTP_REFERER'));//��������������� �� ��� �� ��������
    exit;
}
//����������

function accs_config($id)//������� �������� �������� ��� ���������� �������� 
{
	$result_index = mysql_query("SELECT * FROM accounts WHERE id='$id'");//������ �� ������� "accounts(��������)" ��������� ������� �������
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/accs_config.html");//��������� ������
			$templates = implode("",$templates);//���������� �������, ������������� �������� file()
			
			//----- ������ �������� ----
			$cfgSTATtext = array("������","���������","������");//������� ��� ��������
			$cfgSTATint = array(0,1,2);//������� ��� �������
			$cfgSTAT = cfgstatus($myrow_index[status],$cfgSTATtext,$cfgSTATint);//����������� option ��� ������ "������ ��������"
			//----- ������ �������� ----
			
			//----- ������ ������� ----
			$cfgPAYtext = array("�������","�������");//������� ��� ��������
			$cfgPAYint = array(0,1);//������� ��� �������
			$cfgPAY = cfgpayout($myrow_index[payout],$cfgPAYtext,$cfgPAYint);//����������� option ��� ������ "������ �������"
			//----- ������ ������� ----
			
			//������ ��������������� �� ���������� �� �������
			$templates = str_replace("[_id]",$myrow_index[id],$templates);//ID
			$templates = str_replace("[_server]",$myrow_index[server],$templates);//������
			$templates = str_replace("[_login_acc]",$myrow_index[login_acc],$templates);//����� ��������
			$templates = str_replace("[_pass_acc]",$myrow_index[pass_acc],$templates);//������ ��������
			$templates = str_replace("[_mail]",$myrow_index[mail],$templates);//����
			$templates = str_replace("[_mail_pass]",$myrow_index[mail_pass],$templates);//������ �����
			$templates = str_replace("[_price]",$myrow_index[price],$templates);//����
			$templates = str_replace("[_cfgstatus]",$cfgSTAT,$templates);//������
			$templates = str_replace("[_wallet_type]",$myrow_index[wallet_type],$templates);//��� ��������	
			$templates = str_replace("[_wallet]",$myrow_index[wallet],$templates);//����� �����
			$templates = str_replace("[_payout_price]",round($myrow_index[price] / 1.2),$templates);//����� �������	
			$templates = str_replace("[_cfgpayment]",$cfgPAY,$templates);//������ �������
		}
		else 
		{//���� ��������� ������� ������ �� ����� (������)...
			$templates = file("templates/error.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '������'; //��������� ������
			$message = '������ �������������� ������������� ��������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
		}
	return $templates;//����� ���������������� html ����
}

function cfgstatus($sel)//������� ��������� ��������� ������� ��������
{
	for($i=0;$i<3;$i++)
	{
		//� ����������� �� ���������� i ����������� ��������� �������
		if($i == 0)$txtsel = "������";
		if($i == 1)$txtsel = "���������";
		if($i == 2)$txtsel = "������";
		//��������� ����� ������� ������ ������
		if($sel == $i)$result .= "<option value='$i' selected>$txtsel</option>";//� option ���������� �������� ������������� selected
		else $result .= "<option value='$i'>$txtsel</option>";//��������� �������� ����� ��� �������� selected
	}
	return $result;//����� ���������������� html ����
}

function cfgpayout($sel)//������� ��������� ��������� ������� ������
{
	for($i=0;$i<2;$i++)
	{
		if($i == 0)$txtsel = "�������";
		else $txtsel = "�������";
		if($sel == $i)$result .= "<option value='$i' selected>$txtsel</option>";//�������� selected
		else $result .= "<option value='$i'>$txtsel</option>";
	}
	return $result;//����� ���������������� html ����
}
?>
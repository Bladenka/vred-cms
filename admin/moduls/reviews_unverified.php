<?php
//��������
if($_GET['del_post'])$del_post = $_GET['del_post'];//�������� GET-���������� ���������� ID ���������� ������
if($del_post)//���� ���������� ����������...
{
    $result_del_post = mysql_query ("DELETE FROM reviews WHERE id='$del_post'");//������ ������ � ������� id ����� GET-����������
    header("location: ?page=reviews_unverified");//��������������� ������������ ����� �������� ������
    exit;
}
//��������

function reviews_unverified()//������� ������ ���������������� �������
{
	$result_index = mysql_query("SELECT * FROM reviews WHERE status = '0' ORDER BY post_date ASC");//������ �� ������� "reviews(������)" ��� ������ �� �������� "0 = �������" (���������� �� �����������)
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/reviews_unverified.html");//��������� ������
			$templates = implode("",$templates);//�.�. ������� file() ���������� ������, ��� ����� �������
			preg_match("/\[_while\](.*?)\[_while\]/s",$templates,$tamp_while);//���������� ���������, ����������� �������� �� ������� ������ �� �����, ������� ������ �����������
				do
				{
					$copy_tamp = $tamp_while[1];/*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
					����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
					
					//������ ��������������� �� ���������� �� �������
					$copy_tamp = str_replace("[_id]",$myrow_index[id],$copy_tamp);//ID
					$copy_tamp = str_replace("[_title]",$myrow_index[title],$copy_tamp);//���������
					$copy_tamp = str_replace("[_user_text]",$myrow_index[user_text],$copy_tamp);//�����
					$copy_tamp = str_replace("[_author]",$myrow_index[author],$copy_tamp);//������� ������ ������
					$copy_tamp = str_replace("[_admin_text]",$myrow_index[admin_text],$copy_tamp);//����� ��������������
					$copy_tamp = str_replace("[_post_date]",$myrow_index[post_date],$copy_tamp);//���� ����������
					$list .= $copy_tamp;//����� ���� ��������������� ��� � ���� ����������
				}
				while($myrow_index = mysql_fetch_array($result_index));
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$list,$templates);//������ [_while]...[_while] ����������� ��������������� html ��� �� $list
		}
		else 
		{//���� ��������� ������� ������ �� ����� (������)...
			$templates = file("templates/error.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '����� ������'; //��������� ������
			$message = '��� ������� � ���� ������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
		}
	return $templates;//����� ���������������� html ����
}
?>
<?php
//��������
if($_GET['del_post'])$del_post = $_GET['del_post'];//�������� GET-���������� ���������� ID ���������� ������
if($del_post)//���� ���������� ����������...
{
    $result_del_post = mysql_query ("DELETE FROM reviews WHERE id='$del_post'");//������ ������ � ������� id ����� GET-����������
    header("location: ?page=reviews_verified");//��������������� � ������ ��������� �������
    exit;
}
//��������

//------���������� �������������� ������
//�������� ����������, ���� ����� ���� ���������� (sumbit �� ����� �������������� ������)
if($_POST['post_id'])$post_id = $_POST['post_id'];//ID
if($_POST['post_status'])$post_status = $_POST['post_status'];//������ ������
if($_POST['post_author'])$post_author = $_POST['post_author'];//������� ������ ������
if($_POST['post_title'])$post_title = $_POST['post_title'];//���������
if($_POST['post_user_text'])$post_user_text = $_POST['post_user_text'];//�����
if($_POST['post_admin_text'])$post_admin_text = $_POST['post_admin_text'];//����� ��������������
//�������� ����������, ���� ����� ���� ���������� (sumbit �� ����� �������������� ������)

if($post_author & $post_title & $post_user_text)//���� ��������� ���������� ���������� ��� ������������...
{   
    //������ ������� (') �� ���� ������
    $post_status = str_replace("'","&#039",$post_status);
    $post_author = str_replace("'","&#039",$post_author);
    $post_title = str_replace("'","&#039",$post_title);
	$post_user_text = str_replace("'","&#039",$post_user_text);
    $post_admin_text = str_replace("'","&#039",$post_admin_text);
    //������ ������� (') �� ���� ������	
	
    $edd_blog = mysql_query ("UPDATE reviews SET status='$post_status', author='$post_author', title='$post_title', user_text='$post_user_text', admin_text='$post_admin_text' WHERE id='$post_id'");//�������� ������ � ��
    header("location: ?page=reviews_verified");//��������������� �� �������� � ����������� ��������
    exit;
}
//------���������� �������������� ������

function reviews_verified()//������� ������ ������ ���������� �������
{
	$result_index = mysql_query("SELECT * FROM reviews WHERE status = '1' ORDER BY post_date DESC");//������ �� ������� "reviews(������)" ��� ������ �� �������� "1 = �����������" (���������� �� ��������)
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//��������, �� ������������� � ������� �������...
		{ //���� ���� ���� ������ ����..
			$templates = file("templates/reviews_verified.html");//��������� ������
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
		{//���� ������� ���, ������� ���������...
			$templates = file("templates/error.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '���������� ������'; //��������� ������
			$message = '��� ������� � ���� ������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
		}
	return $templates;//����� ���������������� html ����
}

function reviews_update($id)//������� ������ ���������� ������
{
	$result_index = mysql_query("SELECT * FROM reviews WHERE id='$id'");//������ �� ������� "reviews(������)" ������ � ����������� id
	$myrow_index = mysql_fetch_array($result_index);
	if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/reviews_update.html");//��������� ������
			$templates = implode("",$templates);//�.�. ������� file() ���������� ������, ��� ����� �������
			
			$text_post = str_replace("<BR>","",$myrow_index[user_text]);//������ ���� <br> �� �������
			//������ ��������������� �� ���������� �� �������
			$templates = str_replace("[_id]",$myrow_index[id],$templates);//ID
			$templates = str_replace("[_title]",$myrow_index[title],$templates);//���������
			$templates = str_replace("[_user_text]",$text_post,$templates);//�����
			$templates = str_replace("[_author]",$myrow_index[author],$templates);//������� ������ ������
			$templates = str_replace("[_admin_text]",$myrow_index[admin_text],$templates);//����� ��������������
			$templates = str_replace("[_date_comm]",$myrow_index[post_date],$templates);//���� ����������
		}
		else 
		{//���� ��������� ������� ������ �� ����� (������)...
			$templates = file("templates/error.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '������'; //��������� ������
			$message = '������ �������������� ������������� ������'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� � ������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� � ������� �� ��������� ���������
		}
	return $templates;//����� ���������������� html ����
}
?>
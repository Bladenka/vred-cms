<?php
//��������
if($_GET['del_post'])$del_post = $_GET['del_post'];//�������� GET-���������� ���������� ID ��������� �������
if($del_post)//���� ���������� ����������...
{
    $result_del_post = mysql_query ("DELETE FROM news WHERE id='$del_post'");//������ ������ � ������� id ����� GET-����������
    header("location: ?page=news_list");//��������������� �� �������� �� ������� ��������
    exit;
}
//��������

//------���������� �������������� �������
//�������� ����������, ���� ����� ���� ���������� (sumbit �� ����� �������������� ������)
if($_POST['update_post_id'])$update_post_id = $_POST['update_post_id'];//ID
if($_POST['update_post_title'])$update_post_title = $_POST['update_post_title'];//���������
if($_POST['update_post_text'])$update_post_text = $_POST['update_post_text'];//����� �������
if($_POST['update_post_metad'])$update_post_metad = $_POST['update_post_metad'];
if($_POST['update_post_metak'])$update_post_metak = $_POST['update_post_metak'];
//�������� ����������, ���� ����� ���� ���������� (sumbit �� ����� �������������� ������)

if($update_post_title & $update_post_text)//���� ��������� ���������� ���������� ��� ������������...
{   
    //������ ������� (') �� ���� ������
    $update_post_title = str_replace("'","&#039",$update_post_title);
    $update_post_text = str_replace("'","&#039",$update_post_text);
    $update_post_metad = str_replace("'","&#039",$update_post_metad);
	$update_post_metak = str_replace("'","&#039",$update_post_metak);
    //������ ������� (') �� ���� ������	

    $edd_blog = mysql_query ("UPDATE news SET title='$update_post_title', text='$update_post_text', meta_d = '$update_post_metad', meta_k = '$update_post_metak' WHERE id='$update_post_id'");//�������� ������ � ��   
    header("location: ?page=news_config&id=$update_post_id");//��������������� �� �������� � ����������� ������
    exit;
}
//------���������� �������������� �������

function news_list()//������� ������ ������ ��������
{
	$templates = file("templates/news_list.html");//��������� ������
	$templates = implode("",$templates);//���������� �������, ������������� �������� file()
	$result_index = mysql_query("SELECT * FROM news ORDER BY id DESC");//������ �� ������� "news(�������)" ��� ������ (���������� �� ��������)
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			preg_match("/\[_while\](.*?)\[_while\]/s",$templates,$tamp_while);//���������� ���������, ����������� �������� �� ������� ������ �� �����, ������� ������ �����������
			do
			{
				$copy_tamp = $tamp_while[1];/*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
				����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
				
				//������ ��������������� �� ���������� �� �������
				$copy_tamp = str_replace("[_id]",$myrow_index[id],$copy_tamp);//ID
				$copy_tamp = str_replace("[_block]",$myrow_index[block],$copy_tamp);//������ - ����� ����� ��������
				$copy_tamp = str_replace("[_status]",$myrow_index[status],$copy_tamp);//������ - ������������ �� ������� � ����� ��������
				$copy_tamp = str_replace("[_title]",$myrow_index[title],$copy_tamp);//���������
				$copy_tamp = str_replace("[_date_pub]",$myrow_index[date_pub],$copy_tamp);//����
				$list .= $copy_tamp;//����� ���� ��������������� ��� � ���� ����������
			}
			while($myrow_index = mysql_fetch_array($result_index));
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$list,$templates);//������ [_while]...[_while] ����������� ��������������� html ��� �� $list
		}
		else 
		{//���� ������� ���, ������� ���������...
			$message = '<tr><td class="bottom_cfg" align="center" height="16"><font>��� ������� � ���� ������</font></tr></td>'; //��������� ���������
			$templates = preg_replace("/\[_while\].*?\[_while\]/s",$message,$templates);//������ ��������������� �� ��������� ���������
		}
	return $templates;//����� ���������������� html ����
}

function news_update($id)//������� ������ ��������� ������� ��� ��������������
{
	$result_index = mysql_query("SELECT * FROM news WHERE id='$id'");//������ �� ������� "news(�������)" ������ � ����������� id
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//���� ��������� ������� ����� ������...
		{
			$templates = file("templates/news_update.html");//��������� ������
			$templates = implode("",$templates);//���������� �������, ������������� �������� file()

			$text_post = str_replace("<BR>","",$myrow_index[text]);//������ ���� <br> �� �������
			//������ ��������������� �� ���������� �� �������
			$templates = str_replace("[_id]",$myrow_index[id],$templates);//ID
			$templates = str_replace("[_title]",$myrow_index[title],$templates);//���������
			$templates = str_replace("[_text]",$text_post,$templates);//����� �����
			$templates = str_replace("[_date_pub]",$myrow_index[date_pub],$templates);//�����
			$templates = str_replace("[_metad]",$myrow_index[meta_d],$templates);//�������� �����
			$templates = str_replace("[_metak]",$myrow_index[meta_k],$templates);//�������� ����� �����
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
?>
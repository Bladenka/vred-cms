<?php
@$result_meta = mysql_query("SELECT * FROM page WHERE id='1'"); //������ �� ����� ��������� ������ (��������� �����, ��������, �������� �����)
@$myrow_meta = mysql_fetch_array($result_meta);

if($myrow_meta != "") //���� ��������� ������� ����� ������...
{
	$meta_title = '���������������� ������';
    $header_title = $meta_title." - ".$myrow_meta[title];//��������� �������� (��� �������� - ��� �����)
    $header_metaD = $myrow_meta[meta_d]; //��������
    $header_metaK = $myrow_meta[meta_k]; //�������� �����
}

//------���������� �������� �������
//��������� ������������� ��������� ���������� �� ����� �������� ������
if(isset($_POST['post_title']))$post_title = $_POST['post_title'];//���������
if(isset($_POST['post_user_text']))$post_user_text = $_POST['post_user_text'];//�����
if(isset($_POST['post_author']))$post_author = $_POST['post_author'];//������� ������ ������
if(isset($_POST['post_id']))$post_id = $_POST['post_id'];

if($post_title & $post_user_text & $post_author)//���� ��������� ���������� ���������� ��� ������������...
{
    //������� "htmlspecialchars" ����������� html ���� (���� ������� ���� ������� �������������) � ���� �������
	$post_title = htmlspecialchars($post_title);
    $post_user_text = htmlspecialchars($post_user_text);
	//������� "htmlspecialchars" ����������� html ���� (���� ������� ���� ������� �������������) � ���� �������
	
	//�������� ���� �����
    if($post_id != "")//���� ���� ���� ���������
    {
        session_start();//�������� ������
        if(md5($post_id) != $_SESSION['code'])$error_reviews = "��������� ���� ����������� �� ������������ ���������!";//���� ��� ������������
        unset($_SESSION['code']);//��������� ���
        session_destroy();//��������� ������
    }
	
	if(!isset($error_reviews))
    {
		//������ ������� (') �� ���� ������
		$post_title = str_replace("'","&#039",$post_title);
		$post_user_text = str_replace("'","&#039",$post_user_text);
		$post_author = str_replace("'","&#039",$post_author);
		//������ ������� (') �� ���� ������
    
		$post_user_text = str_replace("\n","<br>",$post_user_text);//������ �������� ������ ���������������� ������ �� ��� <br>
		
		$result_add_comm = mysql_query ("INSERT INTO reviews (status,author,post_date,title,user_text) VALUES ('0','$post_author',NOW(),'$post_title','$post_user_text')");//������ ������ � ��
		header("location: reviews.php");//��������������� ������������ ����� �������� ���������
		exit;
	}
}
//------���������� �������� �������

function reviews($error)//������� ������ ���������� �������
{
	$result_index = mysql_query("SELECT * FROM reviews WHERE status = '1' ORDER BY id DESC");//������ �� ������� "reviews(������)" ��� ������ �� �������� "1 = �����������" (���������� �� ��������)
	$myrow_index = mysql_fetch_array($result_index);
		if($myrow_index != "")//��������, �� ������������� � ������� �������...
		{ //���� ���� ���� ������ ����...
			$templates = file("templates/reviews.html");//��������� ������
			$templates = implode("",$templates);//�.�. ������� file() ���������� ������, ��� ����� �������
				do
				{
					$change_ids = $templates;/*��� ��� ���� �������� ������� ������(�������� �������������� �� ���������� �� �������), ������� ���(������) � ��������� ����������, 
					����� �������� ������������ �������� file() ���� ��� 1 ���, � ��� �������������� �������� �� ������*/
					
					//������ ��������������� �� ���������� �� �������
					$change_ids = str_replace("[_author]",$myrow_index[author],$change_ids);//������� ������ ������
					$change_ids = str_replace("[_post_date]",$myrow_index[post_date],$change_ids);//���� ����������
					$change_ids = str_replace("[_title]",$myrow_index[title],$change_ids);//���������
					$change_ids = str_replace("[_user_text]",$myrow_index[user_text],$change_ids);//�����
					$change_ids = str_replace("[_admin_text]",$myrow_index[admin_text],$change_ids);//����� ��������������
					$comm .= $change_ids; //����� ���� ��������������� ��� � ���� ����������
				}
			while($myrow_index = mysql_fetch_array($result_index));
		}
		else 
		{//���� ������� ���, ������� ���������...
			$templates = file("templates/error.html"); //����������� �������
			$templates = implode("",$templates); //���������� �������, ������������� �������� file()
			$title = '��������� �����'; //��������� ������
			$message = '��� ����� �� ����� ����� � ����� �������. �������� ������ ������� ���� �����!'; //��������� ���������
			$templates = preg_replace("[err_title]",$title,$templates);//������ ��������������� �� ��������� ������
			$templates = preg_replace("[err_message]",$message,$templates);//������ ��������������� �� ��������� ���������
			$comm .= $templates; //����� ���� ��������������� ��� � ���� ����������
		}
	$form = file("templates/reviews_form.html");//��������� ������ � ������
	$form = implode("",$form);//�.�. ������� file() ���������� ������, ��� ����� ��������
	
	//����� ������
	if($error != "")//���� ���� ������
	{
		$echoMESSAGE = '<font color="red"><strong>'.$error.'</strong></font>';//������
		$form = str_replace("[_error]",$echoMESSAGE,$form);//����� ������ �� �����
	}
	else $form = str_replace("[_error]","",$form);//���� ������ ���, �� ������� ����� ���������� �� �������
	//����� ������
	
	//�����
	include ("moduls/capcha.php");
	$cods = capcha();
	for($i=0;$i<4;$i++)
	{
		$form = str_replace("[_code".$i."]",$cods[$i][1],$form);//� ����� ���������� 4 ����
		$form = str_replace("[_img".$i."]",$cods[$i][3],$form);//� ����� ���������� 4 �����������
		if($cods[$i][5] == "true")$form = str_replace("[_q]",$cods[$i][4],$form);//������� ������ � �����
	}
	//�����
	
	$form .= $comm;
	return $form;//����� ���������������� html ����
}
?>
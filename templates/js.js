function capcha(v,val) //
{
	document.getElementById("post_id").value = "";
    for(var i=1;i<=4;i++)document.getElementById("cp"+i+"OK").style.display = "none";
    
    document.getElementById("cp"+v+"OK").style.display = "block";
    document.getElementById("post_id").value = val;	
}

//========================================================================

function form_sell() //�������� ����� ������� ���������
{
//------------------- ��������� ������������ �����
	var names = ["post_title", "post_id", "post_server", "post_corp", "post_level", "post_uri", "post_cr", "post_login_acc", "post_pass_acc", "post_mail", "post_mail_pass", "post_price", "post_wallet_type", "post_wallet"];//������������ ����
	var title = ["���������", "ID", "������", "��������", "������� �������", "�������", "�������", "�����", "������", "E-mail", "������ E-mail", "����", "��� ��������", "����� �����"];//����� ����� � ������ ������
	var elements = document.forms["form"].elements;
	var element;
	for(i = 0; i < names.length; i++) 
	{
		element = elements[names[i]];
		if (element.value == "")
		{
			element.style.borderColor='red';
			element.focus();
			alert ('���� "'+title[i]+'" �������� ������������ � ������ ���� ���������!');
			return false;
		}
		else
		{
			element.style.borderColor='#1b1b1b';
		}
	}
//------------------- ��������� ������������ �����

//------------------- ��������� ����� � ��������� ����������
	var names = ["post_id", "post_level", "post_exp", "post_honor", "post_rank", "post_uri", "post_cr", "post_jackpot", "post_prog", "post_lf3", "post_lf4", "post_g3n7900", "post_sg3nb02", "post_mcb25", "post_mcb50", 
	"post_sab50", "post_ucb100", "post_rsb75", "post_cbo100", "post_job100", "post_plt2021", "post_plt3030", "post_dcr250", "post_hstrm01", "post_ubr100", "post_sar02", "post_cbr", "post_acm1", "post_empm01", "post_subm01", 
	"post_ddm01", "post_slm01", "post_emp01", "post_price"];//������������ ����
	var title = ["ID", "������� �������", "����", "�����", "���� �����", "�������", "�������", "�������", "���� ���������", "������ ���� LF-3", "������ ���� LF-4", "��������� G3N-7900", "���� SG3N-B02", "������� ���� MCB-25", 
	"������� ���� MCB-50", "������� ���� SAB-50", "������� ���� UCB-100", "������� ���� RSB-75", "������� ���� CBO-100", "������� ���� JOB-100", "������ ���� PLT-2021", "������ ���� PLT-3030", "������ ���� DCR-250", "��������� ���� HSTRM-01", 
	"��������� ���� UBR-100", "��������� ���� SAR-02", "��������� ���� CBR", "���� ���� ACM-1", "���� ���� EMP-M01", "���� ���� SUB-M01", "���� ���� DD-M01", "���� ���� SL-M01", "������� EMP-01", "����"];//����� ����� � ������ ������
	var regPRICE = /^[0-9]+$/gi;
	var elements = document.forms["form"].elements;
	var element;
	for(i = 0; i < names.length; i++) 
	{
		element = elements[names[i]];
		var result = element.value.match(regPRICE);
		if(element.value != "" & !result)
		{
			element.style.borderColor='red';
			element.focus();
			alert ('���� "'+title[i]+'" ����� ��������� ������ �����!');
			return false;
		}
		else
		{
			element.style.borderColor='#1b1b1b';
		}
	}
//------------------- ��������� ����� � ��������� ����������

//------------------- ��������� ���� "����"
	var price = form.post_price;
	if(price.value < 400)
	{	
		price.style.borderColor='red';
		price.focus();
		alert ('�� �� ������������� ������ � ����� ������ 400 ���!');
		return false;
	}
	else
	{
		price.style.borderColor='#1b1b1b';
	}
//------------------- ��������� ���� "����"

//------------------- ��������� ���� "����"
	if(form.post_mail.value != "")
	{
		var email = form.post_mail.value;
		var regV = /[a-z0-9-_]{2,1000}\@[a-z0-9\-\_]{2,100}\.[a-z0-9]{2,4}/gi;
		var result = email.match(regV);
		if(!result)
		{	
			form.post_mail.style.borderColor='red';
			form.post_mail.focus();
			alert ('������� ���������� email!');
			return false;
		}
	}
//------------------- ��������� ���� "����"	
}

//========================================================================

function form_reviews()//�������� ����� �������
{
//------------------- ��������� ������������ �����	
	var names = ["post_title", "post_user_text", "post_author", "post_id"]; //������ ���� ������� �� ��������
	var title = ["�� �� ��������� ������!", "�� �� �������� ���� ������!", "�� �� �������������!", "�� �� ������� ��������!"]; //������ ������ ���������� ������������
	var elements = document.forms["form"].elements;
	var element;
	for(i = 0; i < names.length; i++)
	{
		element = elements[names[i]];
		if (element.value == "")
		{
			element.style.borderColor='red';
			element.focus();
			alert (title[i]);
			return false;
		}
		else
		{
			element.style.borderColor='#1b1b1b';
		}
	}
//------------------- ��������� ������������ �����	

//------------------- ��������� ���� "�����"	
	var author = form.post_author;
	if(author.value != "")
	{
		if(author.value.length < 3 || author.value.length > 25)
		{	
			author.style.borderColor='red';
			author.focus();
			alert ('��� ������������ �� ����� ���� ������ 3 ��� ������� 25 ��������!');
			return false;
		}
		else
		{
			author.style.borderColor='#1b1b1b';
			var regAUTHOR = /^[-_0-9a-zA-Z�-��-� ]+$/gi;
			var result = author.value.match(regAUTHOR);
			if(!result)
			{	
				author.style.borderColor='red';
				author.focus();
				alert ('��� ������������ �������� ������������ �������!');
				return false;
			}
			else
			{
				author.style.borderColor='#1b1b1b';
			}
		}
	}
//------------------- ��������� ���� "�����"
}
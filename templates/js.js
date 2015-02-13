function capcha(v,val) //
{
	document.getElementById("post_id").value = "";
    for(var i=1;i<=4;i++)document.getElementById("cp"+i+"OK").style.display = "none";
    
    document.getElementById("cp"+v+"OK").style.display = "block";
    document.getElementById("post_id").value = val;	
}

//========================================================================

function form_sell() //Проверка формы продажи аккаунтов
{
//------------------- Обработка обязательных полей
	var names = ["post_title", "post_id", "post_server", "post_corp", "post_level", "post_uri", "post_cr", "post_login_acc", "post_pass_acc", "post_mail", "post_mail_pass", "post_price", "post_wallet_type", "post_wallet"];//Обязательные поля
	var title = ["Заголовок", "ID", "Сервер", "Компания", "Игровой уровень", "Уридиум", "Кредиты", "Логин", "Пароль", "E-mail", "Пароль E-mail", "Цена", "Тип кошелька", "Номер счета"];//Имена полей в тексте ошибки
	var elements = document.forms["form"].elements;
	var element;
	for(i = 0; i < names.length; i++) 
	{
		element = elements[names[i]];
		if (element.value == "")
		{
			element.style.borderColor='red';
			element.focus();
			alert ('Поле "'+title[i]+'" является обязательным и должно быть заполнено!');
			return false;
		}
		else
		{
			element.style.borderColor='#1b1b1b';
		}
	}
//------------------- Обработка обязательных полей

//------------------- Обработка полей с числовыми значениями
	var names = ["post_id", "post_level", "post_exp", "post_honor", "post_rank", "post_uri", "post_cr", "post_jackpot", "post_prog", "post_lf3", "post_lf4", "post_g3n7900", "post_sg3nb02", "post_mcb25", "post_mcb50", 
	"post_sab50", "post_ucb100", "post_rsb75", "post_cbo100", "post_job100", "post_plt2021", "post_plt3030", "post_dcr250", "post_hstrm01", "post_ubr100", "post_sar02", "post_cbr", "post_acm1", "post_empm01", "post_subm01", 
	"post_ddm01", "post_slm01", "post_emp01", "post_price"];//Обязательные поля
	var title = ["ID", "Игровой уровень", "Опыт", "Честь", "Очки ранга", "Уридиум", "Кредиты", "Джекпот", "Очки прогресса", "Лазеры типа LF-3", "Лазеры типа LF-4", "Двигатели G3N-7900", "Щиты SG3N-B02", "Батареи типа MCB-25", 
	"Батареи типа MCB-50", "Батареи типа SAB-50", "Батареи типа UCB-100", "Батареи типа RSB-75", "Батареи типа CBO-100", "Батареи типа JOB-100", "Ракеты типа PLT-2021", "Ракеты типа PLT-3030", "Ракеты типа DCR-250", "Ракетомёты типа HSTRM-01", 
	"Ракетомёты типа UBR-100", "Ракетомёты типа SAR-02", "Ракетомёты типа CBR", "Мины типа ACM-1", "Мины типа EMP-M01", "Мины типа SUB-M01", "Мины типа DD-M01", "Мины типа SL-M01", "Импульс EMP-01", "Цена"];//Имена полей в тексте ошибки
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
			alert ('Поле "'+title[i]+'" может содержать только цифры!');
			return false;
		}
		else
		{
			element.style.borderColor='#1b1b1b';
		}
	}
//------------------- Обработка полей с числовыми значениями

//------------------- Обработка поля "Цена"
	var price = form.post_price;
	if(price.value < 400)
	{	
		price.style.borderColor='red';
		price.focus();
		alert ('Мы не рассматриваем заявки с ценой меньше 400 руб!');
		return false;
	}
	else
	{
		price.style.borderColor='#1b1b1b';
	}
//------------------- Обработка поля "Цена"

//------------------- Обработка поля "Майл"
	if(form.post_mail.value != "")
	{
		var email = form.post_mail.value;
		var regV = /[a-z0-9-_]{2,1000}\@[a-z0-9\-\_]{2,100}\.[a-z0-9]{2,4}/gi;
		var result = email.match(regV);
		if(!result)
		{	
			form.post_mail.style.borderColor='red';
			form.post_mail.focus();
			alert ('Введите корректный email!');
			return false;
		}
	}
//------------------- Обработка поля "Майл"	
}

//========================================================================

function form_reviews()//Проверка формы отзывов
{
//------------------- Обработка обязательных полей	
	var names = ["post_title", "post_user_text", "post_author", "post_id"]; //массив имен инпутов на проверку
	var title = ["Вы не выставили оценку!", "Вы не заполнил поле отзыва!", "Вы не представились!", "Вы не выбрали картинку!"]; //массив ошибок выдаваемых пользователю
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
//------------------- Обработка обязательных полей	

//------------------- Обработка поля "Автор"	
	var author = form.post_author;
	if(author.value != "")
	{
		if(author.value.length < 3 || author.value.length > 25)
		{	
			author.style.borderColor='red';
			author.focus();
			alert ('Имя пользователя не может быть короче 3 или длиннее 25 символов!');
			return false;
		}
		else
		{
			author.style.borderColor='#1b1b1b';
			var regAUTHOR = /^[-_0-9a-zA-Zа-яА-Я ]+$/gi;
			var result = author.value.match(regAUTHOR);
			if(!result)
			{	
				author.style.borderColor='red';
				author.focus();
				alert ('Имя пользователя содержит недопустимые символы!');
				return false;
			}
			else
			{
				author.style.borderColor='#1b1b1b';
			}
		}
	}
//------------------- Обработка поля "Автор"
}
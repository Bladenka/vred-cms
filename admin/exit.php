<?php
session_start();//Старт сессии
unset ($_SESSION['$logSESS']);//Удаляю зарегистрированную глобальную переменную
session_destroy();//Убиваю сессию
header("location: /admin/login.php");//Перенаправление к форме авторизации
exit;
?>
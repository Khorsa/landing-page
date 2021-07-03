<?php

require_once __DIR__ . "/auth.php";
$auth = new Admin\Auth();

if ($auth->isLogged() == true) {
	header("location: /admin");
}
	
$message = '';
if (isset($_POST['login']) && isset($_POST['pwd'])) {
	

	
	try {
		$auth->login(htmlspecialchars($_POST['login']), htmlspecialchars($_POST['pwd']));
		
		header("location: /admin");
		
	} catch(\Exception $ex) {
		$message = $ex->getMessage();
	}
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="Столяров Роман, 2021">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Админка</title>
<link rel='stylesheet' href='/admin/styles.css' type='text/css' />

</head>


<body>
<br><br><br><br>
<form class="loginform" action="/admin/login.php" method="post">
	<label for="login">Логин</label>
	<input type="text" name="login" id="login" />
	<label for="pwd">Пароль</label>
	<input type="password" name="pwd" id="pwd" />
	<input type="submit" value="Войти">
	<div class="cf message"><?=$message?></div>
</form>

</body>

</html>

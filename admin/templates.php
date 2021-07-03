<?php
require_once __DIR__ . "/auth.php";
$auth = new Admin\Auth();
if ($auth->isLogged() != true) {
	header("location: /admin/login.php");
	exit;
}

$template = htmlspecialchars($_GET['file']);
$templateFile = __DIR__ . "/../templates/{$template}.html.twig";

if (!is_file($templateFile)) {
	header("location: /admin/");
	exit;
}


if (isset($_POST["templatecode"])) {
	
	$code = $_POST["templatecode"];
	
	unlink($templateFile);
	file_put_contents($templateFile, $code);
	header("location: /admin/");

	exit;
}


?><!DOCTYPE html>
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

<div class="container">
	<div class="menu">
		<a href="/admin" class="logo">FlexyCMS&nbsp;light</a>
		<nav>
		
<?php

$fileNames = scandir(__DIR__ . "/../templates");
$files = [];
foreach($fileNames as $fileName) {
	if ($fileName == '.') continue;
	if ($fileName == '..') continue;
	$name = substr($fileName, 0, strpos($fileName, '.html.twig'));
	$files[] = $name;
}

foreach($files as $file) {
	print "<a href='/admin/templates.php?file={$file}'>{$file}</a>";
}

?>
		</nav>
		<a href="/admin/logout.php" class="logout">Выйти</a>
	</div>

	<div class="content">
	
		<form class="template-form" action="/admin/templates.php?file=<?=$file?>" method="post">
			<textarea class="template-edit" name="templatecode" spellcheck="false">
<?php print file_get_contents($templateFile); ?>
			</textarea>
			
			<input type="submit" value="Сохранить" class="submit-template" />
		</form>
			
	</div>
</div>

</body>
</html>
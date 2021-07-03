<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

header('Content-Type: application/json');

try
{
	$fio = null;
	if (isset($_POST['fio'])) $fio = htmlspecialchars($_POST['fio']);

	$phone = '';
	if (isset($_POST['phone'])) $phone = htmlspecialchars($_POST['phone']);

	$len = '';
	if (isset($_POST['len'])) $len = htmlspecialchars($_POST['len']);

	if ($fio == null) throw new Exception('Введите ваше имя!');
	if ($phone == null) throw new Exception('Введите ваш телефон!');

	
	$mailer = new PHPMailer();

	$mailer->CharSet = 'UTF-8';
	$mailer->SetFrom('postmaster@'.$_SERVER['HTTP_HOST'], 'Сайт «landing»');
	$mailer->AddAddress('info@landing.ru', 'Администратор сайта');
    $mailer->AddBCC('rshome@mail.ru', 'Разработчик');
	
	$mailer->Subject = 'С сайта «landing» отправлено письмо';

	$body = "";
	$body .= "IP-адрес: ".$_SERVER['REMOTE_ADDR']."\r\n";
	
	$body .= "Отправлен запрос на обратный звонок\r\n";
	$body .= "Имя: {$fio}\r\n";
	$body .= "Телефон: {$phone}\r\n";
	
	$mailer->AltBody = $body;
	$body = str_replace("\r\n", "<br />", $body);
	$mailer->MsgHTML($body);
	$mailer->Send();
	
	$result = array('error' => 0, 'message' => 'Ваше сообщение успешно отправлено!');
	print json_encode($result);
	exit;
}
catch(Exception $e)
{
	$result = array('error' => 1, 'message' => $e->getMessage());
	print json_encode($result);
	exit;
}

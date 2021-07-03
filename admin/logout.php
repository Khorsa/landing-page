<?php

require_once __DIR__ . "/auth.php";
$auth = new Admin\Auth();

$auth->logout();

header("location: /admin");
	

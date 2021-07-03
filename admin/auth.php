<?php

namespace Admin;

session_start();

class Auth 
{
	private $name;
	private $password;

	public function __construct() 
	{
		include __DIR__ . "/../settings.php";
		$this->name = $login;
		$this->password = $password;
	}
	
	
	public function isLogged() 
	{
		if ($_SESSION['isLogged'] && $_SESSION['isLogged'] === true) return true;
		return false;
	}
	
	public function login($name, $password) 
	{
		if ($name != $this->name || $password != $this->password) throw new \Exception("Логин или пароль не подходят");
		$_SESSION['isLogged'] = true;
		return true;
	}
	
	public function logout() 
	{
		$_SESSION['isLogged'] = false;
		return true;
	}
	
	
}
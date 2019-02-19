<?php

class User
{
	protected $_id,
	          $_login,
	          $_password,
	          $_email,
			  $_admin,
			  $_errors=[];

	CONST INVALID_LOGIN = 1;
	CONST INVALID_PASSWORD = 2;
	CONST INVALID_EMAIL = 3;

	  public function __construct($data)
	{
		$this->hydrate($data);
	}

  public function hydrate(array $data)
	{
		foreach ($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);

		  if (method_exists($this, $method))
		  {
			  $this->$method($value);
		  }
		}	
	}



	//GETTERS

	public function id()
	{
		return $this->_id;
	}

	public function login()
	{
		return $this->_login;
	}

	public function password()
	{
		return $this->_password;
	}

	public function email()
	{
		return $this->_email;
	}

	public function admin()
	{
		return $this->_admin;
	}

	public function errors()
	{
		return $this->_errors;
	}

	//SETTERS

	public function setId($id)
	{
		$id = (int)$id;
		$this->_id = $id;
	}

	public function setLogin($login)
	{
		if (!is_string($login) || empty($login))
		{
			$this->_errors[]=self::INVALID_LOGIN;
		}
		else
		{
			$this->_login = $login;
		}
	}

	public function setPassword($password)
	{
		if (!is_string($password) || empty($password))
		{
			$this->_errors[]=self::INVALID_PASSWORD;
		}
		else
		{
			$this->_password = password_hash($password, PASSWORD_DEFAULT); 
		}
	}

	public function setEmail($email)
	{
		if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email) || !is_string($email))
		{
			$this->_errors[]=self::INVALID_EMAIL;
		}
		else
		{
			$this->_email = $email;
		}
	}

	public function setAdmin($admin)
	{
		$this->_admin = $admin;
	}
}
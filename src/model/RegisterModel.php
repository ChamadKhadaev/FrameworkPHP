<?php

namespace App\Model;

use Core\Database;
use Exception;
use PDOException;

class RegisterModel
{
	/**
	 * @var string
	 */
	public string $username;
	/**
	 * @var string
	 */
	private string $email;
	/**
	 * @var string
	 */
	private string $password;
	
	/**
	 * @param string $username
	 * @param string $email
	 * @param string $password
	 */
	public function __construct(string $username, string $email, string $password)
	{
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
	}
	
	/**
	 * @throws \Exception
	 */
	public function createUser($username, $email, $password): bool
	{
			$insert = new RegisterModel($username, $email, $password);
			$insert->insertUser();
			echo "success createUser";
			header("Location: /profile/$username");
			return true;
	}
	
	/**
	 * @return bool
	 */
	public function insertUser(): bool
	{
		$this->username = $_POST['username'];
		$this->email = $_POST['email'];
		$this->password = $_POST['password'];
	
		try {
			Database::query('INSERT INTO users VALUES(null, :username, :email, :password)',
				[
					':username' => $this->username,
					':email' => $this->email,
					':password' => password_hash($this->password, PASSWORD_BCRYPT)
				]
			);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return TRUE;
	}
	
	/**
	 * @throws \Exception
	 */
	public static function usernameVerify($username): bool
	{
		if (!Database::query('SELECT username FROM users WHERE username=:username', [':username' => $username]))
		{
			if (strlen($username) >= 4 && strlen($username) <= 32)
			{
				if (preg_match('/[a-zA-Z0-9_]+/', $username))
				{
					echo "Username Valid <br>";
					return TRUE;
				} else {
					echo "Username must contain only letters and numbers <br>";
				}
			} else {
					echo "Username length must be between 6 and 32 <br>";
			}
		} else {
			echo "Username is already taken <br>";
		}
		return false;
	}
	
	public static function passwordVerify($password): bool
	{
		if (strlen($password) >= 8 && strlen($password) <= 60)
		{
			echo "Password Valid <br>";
			return True;
		} else {
			echo "password must contain between 8 et 60 characters <br>";
		}
		return false;
	}
	

	
	/**
	 * @throws \Exception
	 */
	public static function emailVerify($email): bool
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			if (!Database::query("SELECT email FROM users WHERE email = :email", [':email' => $email]))
			{
				echo "Email Valid <br>";
				return True;
			} else {
				echo "Email is already taken <br>";
			}
		}
		return false;
	}
	
	
}
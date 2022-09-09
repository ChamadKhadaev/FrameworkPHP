<?php

namespace App\Model;

use Classes\Exception\LoginException;
use Core\Database;


class UserModel
{
	private int $id;
	public string $username;
	private string $email;
	private string $password;
	
	/*public function __construct($id, $username, $email, $password)
	{
		$this->id = $id;
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
	}*/
	
	/**
	 * @throws \Exception
	 */
	public static function getId($id): bool
	{
			try{
				Database::query("SELECT id FROM users WHERE username = :goodtest ", [':id' => $id]);
				echo "your $id";
				header("Location: /id/$id");
				return true;
			} catch (\PDOException){
				echo "GetId: not found";
			}
		
		return false;
	}
	
	/**
	 * @throws \Classes\Exception\LoginException
	 * @throws \Exception
	 */
	public function login(): bool
	{
		$this->username = $_POST['username'];
		$this->password = $_POST['password'];
		

			if((new UserModel())->loginUsername($this->username)
				&& (new UserModel())->loginPassword())
			{
				echo "success login";
				session_start();
				return true;
			} else {
				throw new LoginException("Error: UserModel::login() Failed");
			}
	}
	
	/**
	 * @throws \Exception
	 */
	public function loginUsername($username): bool
	{
		$checkUsernameExists = Database::query("SELECT username FROM users WHERE username = :username",
			[':username' => $username]);
		
		if($checkUsernameExists)
		{
			return true;
		} else {
			throw new LoginException("Error: UserModel::loginUsername($username) not Found!");
		}
	}
	
	/**
	 * @throws \Classes\Exception\LoginException
	 * @throws \Exception
	 */
	public function loginPassword(): bool
	{
		$checkPasswordHash = Database::query("SELECT password FROM users WHERE password = :password",
			[':password' => password_verify($this->password, PASSWORD_BCRYPT )]);
		
		if($checkPasswordHash)
		{
			return true;
		} else {
			throw new LoginException("Error: UserModel::loginPassword(password) not Valid!");
		}
	}
}
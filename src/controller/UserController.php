<?php

namespace App\Controller;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Core/autoload.php';

use App\Model\RegisterModel;
use App\Model\UserModel;
use Core\Controller;
use Exception;
use Classes\Exception\RegisterException;

class UserController extends Controller
{
	
	/**
	 * @throws Exception
	 */
	public function create()
	{
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (isset($_POST['register']))
		{
			if(RegisterModel::usernameVerify($username) && RegisterModel::emailVerify($email) && RegisterModel::passwordVerify($password))
			{
				$register = new RegisterModel($username, $email, $password);
				$register->createUser($username, $email, $password);
			} else {
				throw new RegisterException("Error: RegisterModel::createUser($username, $email)");
			}
		}
	}
	
	/**
	 * @throws \Classes\Exception\LoginException
	 */
	public function loginUser()
	{
		if (isset($_GET['login']))
		{
			(new UserModel())->login();
		}
	}
	
	public function login()
	{
		$this->render('login');
	}
	
	/**
	 * @throws \Exception
	 */
	public function getId(): bool
	{
		$id = $_GET['getId'];
		
		if(isset($_GET['getId']))
		{
			UserModel::getId($id);
			return true;
		}
		return false;
	}
}


<?php

namespace Core;


use Exception;
use PDO;
use Dotenv;
use PDOException;

require_once 'vendor/autoload.php';

class Database
{

	/**
	 * @return PDO
	 */
	public static function connect(): PDO
    {
	    $dotenv = new Dotenv\Dotenv(__DIR__);
	    $dotenv->load();

		try {
			$pdo = new PDO(
				'mysql:host='.$_ENV['DATABASE_HOST'].';dbname='.$_ENV['DATABASE_NAME'],
				$_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']
			);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die('Error:' . $e->getMessage() . '<br/>');
		}
        return $pdo;
    }


	/**
	 * @param $query
	 * @param array $params
	 * @return array|false|void
	 * @throws Exception
	 */
	public static function query($query, array $params = array())
	{
		try {
			$statement = self::connect()->prepare($query);
			$statement->execute($params);

			if (explode(' ', $query)[0] == 'SELECT') {
				return $statement->fetchAll();
			}
		} catch (PDOException $e) {
			throw new Exception('Query failed:' . $e->getMessage(), ''.$e->getCode(), null);
		}
	}

}
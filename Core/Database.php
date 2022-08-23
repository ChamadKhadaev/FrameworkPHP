<?php

namespace Core;


use PDO;
use Core\DatabaseConfig;

require_once 'vendor/autoload.php';

class Database
{

    /**
     * @return PDO
     */
	public static function connect(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;dbname=mixed;charset=utf8', 'hasan', 'hasan');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    /**
     * @param $query
     * @param array $params
     * @return array|false|void $statement->fetchAll
     */
    public static function query($query, array $params = array())
	{
		$statement = self::connect()->prepare($query);
		$statement->execute($params);

		if (explode(' ', $query)[0] == 'SELECT')
		{
			$data = $statement->fetchAll();
			return $data;
		}
	}

}
<?php
namespace app;

use PDOException;

class database{

	public $pdo;

	public function __construct()
	{

		$settings = $this->getPDOSettings();
		$this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
		$q = $this->pdo->prepare("DESCRIBE currency");
		$q->execute();
		if(!$q->fetchAll(\PDO::FETCH_COLUMN)){
			try {
				$this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
				$sql ="CREATE TABLE IF NOT EXISTS `currency` (
				`id` INT AUTO_INCREMENT NOT NULL,
				`currency` varchar(200) NOT NULL,
				`value` TINYINT DEFAULT 1,
				PRIMARY KEY (`id`)) 
				CHARACTER SET utf8 COLLATE utf8_general_ci" ;
				$this->pdo->exec($sql);

			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}

		$b = $this->pdo->prepare("DESCRIBE history");
		$b->execute();

		if(!$b->fetchAll(\PDO::FETCH_COLUMN)){
			try {
				$this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
				$sql ="CREATE TABLE IF NOT EXISTS `history` (
				`id` INT AUTO_INCREMENT NOT NULL,
				`amount` DOUBLE NOT NULL,
				`from_currency` varchar(200) NOT NULL,
				`to_currency` varchar(200) NOT NULL,
				`result` DOUBLE NOT NULL,			
				`date` timestamp,
				PRIMARY KEY (`id`)) 
				CHARACTER SET utf8 COLLATE utf8_general_ci" ;
				$this->pdo->exec($sql);

			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}

	}

	protected function getPDOSettings()
	{

		$config = include ROOTPATH.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'database.php';
		$result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
		$result['user'] = $config['user'];
		$result['pass'] = $config['pass'];
		return $result;
	}

	public function execute($query, array $params=null)
	{

		if(is_null($params)){
			$stmt = $this->pdo->query($query);
			return $stmt->fetchAll();
		}
		$stmt = $this->pdo->prepare($query);
		$stmt->execute($params);
		return $stmt->fetchAll();

	}

	public function insert($table, $data)
	{
		foreach ($data as $idx=>$item)
		{
			if ($item) {
				$result_values[$idx] = "'".$item."'";
			} else {
				unset($data[$idx]);
			}
		}
		$columns = implode(", ",array_keys($data));
		$result_values  = implode(", ", $result_values);
		$query = "INSERT INTO $table ($columns) VALUES ($result_values)";
		$stmt = $this->pdo->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}
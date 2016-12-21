<?php

namespace Model\Manager;

use Model\Db;
use PDO;

/**
 * Contient toutes les méthodes faisant des requêtes à la base de données
 */
class DemoManager
{
	public function findAll() 
		{
			$sql = "SELECT * 
					FROM movies";
			echo("plop");

			$dbh = Db::getDbh();

			$stmt = $dbh->prepare($sql);
			$stmt->execute();

			$results = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Model\Entity\Demo');

			return $results;
		}	
}
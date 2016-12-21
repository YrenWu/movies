<?php

namespace Model\Manager;

use Model\Db;

use PDO;

/**
 * Contient toutes les méthodes faisant des requêtes à la base de données
 */
class DemoManager
{
	public function delete($id)
	{
		$sql = "DELETE FROM movies WHERE id=:id";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}

	public function findByDate($date)
	{
		$sql = "SELECT *
				FROM movies WHERE year = :year";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":year", $date);
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Model\Entity\Demo');
		return $results;
	}

	public function findByGenre($genre)
	{

	}

	public function findAll() 
	{
		$sql = "SELECT imdbId, id, title
				FROM movies ORDER BY rating DESC";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Model\Entity\Demo');

		return $results;
	}	

	public function findOne($id)
	{
		$sql = "SELECT *
				FROM movies 
				WHERE id= :id";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id", $id);
		$stmt->execute();

		$result = $stmt->fetchObject('\Model\Entity\Demo');

		return $result;
	}
}
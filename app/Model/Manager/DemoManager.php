<?php

namespace Model\Manager;

use Model\Db;

use PDO;

/**
 * Contient toutes les méthodes faisant des requêtes à la base de données
 */
class DemoManager
{
	public function insert(Demo $movie)
	{
		//$sql = "INSERT INTO movies () VALUES ()";
	}

	public function update(Demo $movie)
	{

	}


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
				FROM movies WHERE year = :year 
				ORDER BY rating DESC";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":year", $date);
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Model\Entity\Demo');
		return $results;
	}

	public function findByKeyword($word)
	{
		$sql = "SELECT * FROM movies AS m 
				INNER JOIN movies_genres AS mg ON mg.movieId=m.id 
				INNER JOIN genres AS g ON g.id=mg.genreId 
				WHERE g.name = :word 
				ORDER BY rating DESC";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":word", $word);
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Model\Entity\Demo');

		return $results;
	}

	public function countAll()
	{
		$sql = "SELECT COUNT(*) FROM movies";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$count = $stmt->fetchColumn(); // quand on récupère une seule cellule

		return $count;

	}

	public function findAll($page) 
	{
		$numPage = 5;
		$offset = ($page-1) * $numPage; 

		$sql = "SELECT *
				FROM movies ORDER BY rating DESC 
				LIMIT $numPage OFFSET $offset";

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
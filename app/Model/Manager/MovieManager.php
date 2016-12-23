<?php

namespace Model\Manager;

use Model\Db;
use Model\Entity\Movie;

use PDO;

/**
 * Contient toutes les méthodes faisant des requêtes à la base de données
 */
class MovieManager
{
	public function insert(Movie $movie)
	{
		$sql = "INSERT INTO movies (
					title, imdbId, year, cast, directors, 
					writers, plot, rating, votes, runtime, 
					trailerUrl, dateCreated, dateModified) 
				VALUES (
					:title, :imdbId, :year, :cast, :directors,
					:writers, :plot, 0, 0, :runtime, 
					:trailerUrl, NOW(), NOW())";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$year = (int) $movie->getYear();

		$stmt->bindValue(':title', $movie->getTitle());
		$stmt->bindValue(':imdbId', $movie->getImdbId());
		$stmt->bindValue(':year', $year);
		$stmt->bindValue(':cast', $movie->getCast());
		$stmt->bindValue(':directors', $movie->getDirectors());
		$stmt->bindValue(':plot', $movie->getPlot());
		$stmt->bindValue(':writers', $movie->getWriters());
		$stmt->bindValue(':runtime', $movie->getRuntime());
		$stmt->bindValue(':trailerUrl', $movie->getTrailerUrl());
		
		$stmt->execute();

	}
	public function update(Movie $movie)
	{
		$sql = "UPDATE movies 
				SET title=:title,
				imdbId=:imdbId,
				year=:year,
				cast=:cast,
				directors=:directors,
				plot=:plot,
				writers=:writers,
				runtime=:runtime,
				trailerUrl=:trailerUrl
				WHERE id=:id";


		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);

		$stmt->bindValue(':id', $movie->getId());
		$stmt->bindValue(':title', $movie->getTitle());
		$stmt->bindValue(':imdbId', $movie->getImdbId());
		$stmt->bindValue(':year',  $movie->getYear());
		$stmt->bindValue(':cast', $movie->getCast());
		$stmt->bindValue(':directors', $movie->getDirectors());
		$stmt->bindValue(':plot', $movie->getPlot());
		$stmt->bindValue(':writers', $movie->getWriters());
		$stmt->bindValue(':runtime', $movie->getRuntime());
		$stmt->bindValue(':trailerUrl', $movie->getTrailerUrl());

		$stmt->execute();
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
				ORDER BY rating DESC LIMIT 15";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":year", $date);
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Model\Entity\Movie');
		return $results;
	}

	public function findByKeyword($word)
	{
		$sql = "SELECT * FROM movies AS m 
				INNER JOIN movies_genres AS mg ON mg.movieId=m.id 
				INNER JOIN genres AS g ON g.id=mg.genreId 
				WHERE g.name = :word 
				ORDER BY rating DESC LIMIT 15";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":word", $word);
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Model\Entity\Movie');

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

	public function findAll($page, $numPage) 
	{
		
		$offset = ($page-1) * $numPage; 

		$sql = "SELECT *
				FROM movies ORDER BY rating DESC 
				LIMIT $numPage OFFSET $offset";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Model\Entity\Movie');

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

		$result = $stmt->fetchObject('\Model\Entity\Movie');

		return $result;
	}
}
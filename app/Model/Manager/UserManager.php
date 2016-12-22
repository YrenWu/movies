<?php 

namespace Model\Manager;

use Model\Db;

use PDO;


class  UserManager
{
	public function insert($user)
	{
		$sql = "INSERT INTO users (name, pass, email, admin) 
				VALUES (:name, :pass, :email, 0)";
			
		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':name', $user->getName());
		$stmt->bindValue(':pass',  $user->getPasswd());
		$stmt->bindValue(':email', $user->getEmail());
		$stmt->execute(); 
	}

	public function delete($id)
	{
		$sql = "DELETE FROM users WHERE id=:id";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}

	public function update($user)
	{

	}

	public function findOne()
	{

	}

	public function findAll()
	{		
		$sql = "SELECT name, id FROM users";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$results = $stmt->fetchAll(\PDO::FETCH_CLASS, '\Model\Entity\User');

		return $results;
	}
}
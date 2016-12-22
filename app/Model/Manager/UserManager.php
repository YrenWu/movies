<?php 

namespace Model\Manager;

use Model\Db;
use Model\Entity\User;

use PDO;


class  UserManager
{
	public function login($login)
	{
	
		$sql = "SELECT * FROM users 
				WHERE name = :login 
				OR email = :login ";

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':login', $login);


		$stmt->execute();
		$result = $stmt->fetchObject('\Model\Entity\User');

		return $result;

	}

	public function update($user)
	{

	}

	public function findOne($id)
	{
		$sql = 'SELECT * FROM users WHERE id = :id';

		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id', $id);

		$user = $stmt->execute();
		return $user;
	}

	public function insert($user)
	{
		$sql = "INSERT INTO users (name, pass, email, token, admin) 
				VALUES (:name, :pass, :email, :token, :role)";
			
		$dbh = Db::getDbh();

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':name', $user->getName());
		$stmt->bindValue(':pass',  $user->getPasswd());
		$stmt->bindValue(':email', $user->getEmail());
		$stmt->bindValue(':token', $user->getToken());
		$stmt->bindValue(':role', $user->getRole());

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
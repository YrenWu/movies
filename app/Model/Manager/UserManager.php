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
		$stmt->bindValue(':pass', $user->getPasswd() );
		$stmt->bindValue(':email', md5($user->getEmail()));
		$stmt->execute();
	}

	public function delete($id)
	{

	}

	public function update($user)
	{

	}

	public function findOne()
	{

	}

	public function findAll()
	{

	}
}
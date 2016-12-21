<?php

namespace Model\Entity;

class User 
{
	private $name;
	private $id;
	private $passwd;
	private $email;
	private $role;
	private $token

	private $validationErrors = [];

	/**
	 * Retourne un booléen en fonction de si l'entité est valide pour une insertion en bdd
	 */
	public function isValid()
	{
		$isValid = true;

		//valider les données de l'instance ici 

		return $isValid;
	}

	/**
	 * getter pour les erreurs de validation
	 */
	public function getValidationErrors()
	{
		return $this->validationErrors;
	}


	public function getName()
	 {
	     return $this->name;
	 }
	  
	 public function setName($name)
	 {
	     $this->name = $name;
	 } 
	public function getId()
	 {
	     return $this->id;
	 }
	  
	 public function setId($id)
	 {
	     $this->id = $id;
	 } 
	public function getPasswd()
	 {
	     return $this->passwd;
	 }
	  
	 public function setPasswd($passwd)
	 {
	     $this->passwd = $passwd;
	 } 
	public function getEmail()
	 {
	     return $this->email;
	 }
	  
	 public function setEmail($email)
	 {
	     $this->email = $email;
	 } 
	public function getRole()
	 {
	     return $this->role;
	 }
	  
	 public function setRole($role)
	 {
	     $this->role = $role;
	 } 
	public function getToken()
	{
	    return $this->token;
	}
	 
	public function setToken($token)
	{
	    $this->token = $token;
	}

}
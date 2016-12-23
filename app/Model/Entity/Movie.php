<?php

namespace Model\Entity;

class Movie
{
	private $id; 					//clef primaire

	private $validationErrors = []; //contient les erreurs de validation

	private $title;
	private $imdbId;
	private $year;
	private $cast;
	private $directors;
	private $rating;
	private $votes;
	private $trailerUrl;
	private $runtime;
	private $dateCreated;
	private $dateModified;
	private $plot;
	private $writers;


	/**
	 * Retourne un booléen en fonction de si l'entité est valide pour une insertion en bdd
	 */
	public function isValid()
	{
		$isValid = true;

		//valider les données de l'instance ici 
		if(strlen($this->plot) < 10){
			$isValid = false;
			$this->validationErrors[] = "Please enter a longer plot";
		}

		if($this->year < 1900){
			$isValid = false;
			$this->validationErrors[] = "Please enter valid year";
		}

		return $isValid;
	}

	/**
	 * getter pour les erreurs de validation
	 */
	public function getValidationErrors()
	{
		return $this->validationErrors;
	}

	/**
	 * Pas besoin de setter pour l'id, MySQL s'en charge
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	*  Getters et setters
	*/
	public function getTitle()
	 {
	     return $this->title;
	 }
	  
	 public function setTitle($title)
	 {
	     $this->title = $title;
	 } 
	public function getImdbId()
	 {
	     return $this->imdbId;
	 }
	  
	 public function setImdbId($imdbId)
	 {
	     $this->imdbId = $imdbId;
	 } 
	public function getYear()
	 {
	     return $this->year;
	 }
	  
	 public function setYear($year)
	 {
	     $this->year = $year;
	 } 
	public function getCast ()
	{
	    return $this->cast ;
	}
	 
	public function setCast ($cast )
	{
	    $this->cast  = $cast ;
	}
	public function getDirectors()
	 {
	     return $this->directors;
	 }
	  
	 public function setDirectors($directors)
	 {
	     $this->directors = $directors;
	 } 
	public function getRating()
	 {
	     return $this->rating;
	 }
	  
	 public function setRating($rating)
	 {
	     $this->rating = $rating;
	 } 
	public function getVotes()
	 {
	     return $this->votes;
	 }
	  
	 public function setVotes($votes)
	 {
	     $this->votes = $votes;
	 } 
	public function getTrailerUrl()
	 {
	     return $this->trailerUrl;
	 }
	  
	 public function setTrailerUrl($trailerUrl)
	 {
	     $this->trailerUrl = $trailerUrl;
	 } 
	public function getRuntime()
	 {
	     return $this->runtime;
	 }
	  
	 public function setRuntime($runtime)
	 {
	     $this->runtime = $runtime;
	 } 
	public function getDateCreated()
	 {
	     return $this->dateCreated;
	 }
	  
	 public function setDateCreated($dateCreated)
	 {
	     $this->dateCreated = $dateCreated;
	 } 
	public function getDateModified()
	{
	    return $this->dateModified;
	}
	 
	public function setDateModified($dateModified)
	{
	    $this->dateModified = $dateModified;
	}

	public function getPlot()
	{
	    return $this->plot;
	}
	 
	public function setPlot($plot)
	{
	    $this->plot = $plot;
	}
	
	public function getWriters()
	{
	    return $this->writers;
	}
	 
	public function setWriters($writers)
	{
	    $this->writers = $writers;
	}
}
<?php 

	namespace model;

	include_once 'Genre.php';

	/**
	 * 
	 */
	class Movie
	{
		
		private $name;
		private $duration;
		private $language;
		private $image;
		private $genre;

		function __construct( $name = 'Unnamed', $duration = 0, $language = 'Unavailable', $image = '/assets/default.jpg' ){
			$this->setName($name);
			$this->setDuration($duration);
			$this->setLanguage($language);
			$this->setImage($image);
			$this->genre = array();
		}
	
	    /**
	     * @return mixed
	     */
	    public function getName()
	    {
	        return $this->name;
	    }

	    /**
	     * @param mixed $name
	     */
	    public function setName($name)
	    {
	        $this->name = $name;
	    }

	    /**
	     * @return mixed
	     */
	    public function getDuration()
	    {
	        return $this->duration;
	    }

	    /**
	     * @param mixed $duration
	     */
	    public function setDuration($duration)
	    {
	        $this->duration = $duration;
	    }

	    /**
	     * @return mixed
	     */
	    public function getLanguage()
	    {
	        return $this->language;
	    }

	    /**
	     * @param mixed $language
	     */
	    public function setLanguage($language)
	    {
	        $this->language = $language;
	    }

	    /**
	     * @return mixed
	     */
	    public function getImage()
	    {
	        return $this->image;
	    }

	    /**
	     * @param mixed $image
	     */
	    public function setImage($image)
	    {
	        $this->image = $image;
	    }

	    /**
	    *	@param Genre : $genre
	    */
	    public function addGenre( Genre $genre ){
	    	array_push($this->genre, $genre );
	    }

	}

 ?>
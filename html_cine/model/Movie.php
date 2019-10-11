<?php 

	namespace model;

	/**
	 * 
	 */
	class Movie
	{
		
		private $id;	
		private $name;
		private $duration;
		private $language;
		private $image;
		private $genres;

		function __construct( $name = 'Unnamed', $duration = 0, $language = 'Unavailable', $image = '/assets/default.jpg', $genres = array(), $id = 0 ){


			$this->setName($name);
			$this->setDuration($duration);
			$this->setLanguage($language);
			$this->setImage($image);
			$this->genres = array();
			foreach ($genres as $genre ) {
				$this->addGenre( $genre );
			}
		}
	
		/**
		 * @return mixed
		 */
		public function getId()
		{
		    return $this->id;
		}

		/**
		 * @param mixed $name
		 */
		public function setId($id)
		{
		    $this->id = $id;
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
	     * @return array
	     */
	    public function getGenres()
	    {
	        return $this->genres;
	    }

	    /**
	    *	@param Genre : $genre
	    */
	    public function addGenre( $genre ){
	    	array_push($this->genres, $genre );
	    }

	}

 ?>
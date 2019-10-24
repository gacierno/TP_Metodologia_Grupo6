<?php 

	namespace model;

	/**
	 * 
	 */
	class Movie
	{
		
		private $id;
		private $apiId;	
		private $name;
		private $duration;
		private $language;
		private $image;
		private $genres;

		function __construct( $options ){
			$this->setName( 	(isset($options['name'] ) ) 	?$options['name']: '' );
			$this->setDuration( (isset($options['duration'] ) ) ?$options['duration']: 0 );
			$this->setLanguage( (isset($options['language'] ) ) ?$options['language']: '' );
			$this->setImage( 	(isset($options['image'] ) ) 	?$options['image']: '' );
			$this->setGenres( 	(isset($options['genres'] ) ) 	?$options['genres']: array() );
			$this->setId( 		(isset($options['id'] ) )		?$options['id']: null );
			$this->setApiId( 	(isset($options['apiId'] ) ) 	?$options['apiId']: null );	
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
	     * @param array : Genre
	     */
	    public function setGenres( $genres )
	    {
	        return $this->genres = $genres;
	    }

	    /**
	    *	@param Genre : $genre
	    */
	    public function addGenre( $genre ){
	    	array_push($this->genres, $genre );
	    }

	    /**
	     * @return array
	     */
	    public function getApiId()
	    {
	        return $this->apiId;
	    }

	    /**
	    *	@param 
	    */
	    public function setApiId( $apiId ){
	    	$this->apiId = $apiId;
	    }

	}

 ?>
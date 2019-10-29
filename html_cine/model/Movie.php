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

		function __construct( $options ){
			$this->setName( 	(isset($options['movie_title'] ) ) 	?$options['movie_title']: '' );
			$this->setDuration( (isset($options['movie_runtime'] ) ) ?$options['movie_runtime']: 0 );
			$this->setLanguage( (isset($options['movie_language'] ) ) ?$options['movie_language']: '' );
			$this->setImage( 	(isset($options['movie_image'] ) ) 	?$options['movie_image']: '' );
			$this->setGenres( 	(isset($options['movie_genres'] ) ) 	?$options['movie_genres']: array() );
			$this->setId( 		(isset($options['movie_id'] ) )		?$options['movie_id']: null );
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

	}

 ?>
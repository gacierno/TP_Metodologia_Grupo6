<?php 
	
	namespace model;

	class Genre
	{

		private $id;
		private $name;

		function __construct( $options )
		{
			$this->setId( 	( isset($options['genre_id']) ) 	? $options['genre_id'] : null );
			$this->setName( ( isset($options['genre_name']) ) 	? $options['genre_name'] : '' );
		}

	    /**
	     * @return mixed
	     */
	    public function getId()
	    {
	        return $this->id;
	    }

	    /**
	     * @param mixed $id
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

	}


 ?>
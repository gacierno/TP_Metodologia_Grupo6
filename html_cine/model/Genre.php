<?php 
	
	namespace model;

	class Genre
	{

		private $id;
		private $apiId;
		private $name;

		function __construct( $options )
		{
			$this->setId( 	( isset($options['id']) ) 	? $options['id'] : null );
			$this->setName( ( isset($options['name']) ) ? $options['name'] : '' );
			$this->setApiId( ( isset($options['apiId']) ) ? $options['apiId'] : null );
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
<?php 
	namespace model;
	/**
	 * 
	 */
	class Purchase
	{
		private $id;
		private $qr;
		private $purchase;	
		private $user;		

		
		function __construct( $options )
		{
			$this->setId( 		(isset($options['id'])		)?$options['id']:null );
			$this->setPurchase( (isset($options['purchase']))?$options['purchase']:null );
			$this->setQr( 		(isset($options['qr'])		)?$options['qr']:null );
			$this->setUser( 	(isset($options['user'])	)?$options['user']:null );
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
	    public function getQr()
	    {
	        return $this->qr;
	    }

	    /**
	     * @param mixed $qr
	     */
	    public function setQr($qr)
	    {
	        $this->qr = $qr;
	    }

	    /**
	     * @return mixed
	     */
	    public function getPurchase()
	    {
	        return $this->purchase;
	    }

	    /**
	     * @param mixed $purchase
	     */
	    public function setPurchase($purchase)
	    {
	        $this->purchase = $purchase;
	    }

	    /**
	     * @return mixed
	     */
	    public function getUser()
	    {
	        return $this->user;
	    }

	    /**
	     * @param mixed $user
	     */
	    public function setUser($user)
	    {
	        $this->user = $user;
	    }
	}
 ?>
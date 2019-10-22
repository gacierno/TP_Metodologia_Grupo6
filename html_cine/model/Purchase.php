<?php 
	namespace model;
	/**
	 * 
	 */
	class Purchase
	{
		private $id;
		private $qr;
		private $purchase;	//	:int purchase id
		private $user;		//	:int user id

		
		function __construct( $user, $purchase, $id, $qr )
		{
			$this->setId($id);
			$this->setPurchase($purchase);
			$this->setQr($qr);
			$this->setUser($user);
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
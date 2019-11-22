<?php 
	namespace model;
	/**
	-  id: int
	-  ticket_qty: int	
	-  discount: int
	-  date: string
	-  amount: float
	-  tickets: array: Tickets
	-  user:  object User
	-  payment: object : Payment
	 */
	class Purchase
	{
		private $id;
		private $ticket_qty;
		private $discount;
		private $date;
		private $amount;
		private $tickets;	// array( object : Ticket )
		private $user;		// object : User
		private $payment;	// object : Payment

		
		function __construct( $options )
		{
			$this->setId( 		(isset($options['purchase_id'])			)?$options['purchase_id']:null );
			$this->setTicketQty( (isset($options['purchase_ticket_qty']) )?$options['purchase_ticket_qty']:0 );
			$this->setDiscount( (isset($options['purchase_discount'])	)?$options['purchase_discount']:0 );
			$this->setDate( 	(isset($options['purchase_date'])		)?$options['purchase_date']:'' );
			$this->setAmount( 	(isset($options['purchase_amount'])		)?$options['purchase_amount']:0 );
			$this->setTickets( 	(isset($options['purchase_tickets'])	)?$options['purchase_tickets']:null );
			$this->setUser( 	(isset($options['purchase_user'])		)?$options['purchase_user']:null );
			$this->setPayment( 	(isset($options['purchase_payment'])	)?$options['purchase_payment']:null );
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
	    public function getTicketQty()
	    {
	        return $this->ticket_qty;
	    }

	    /**
	     * @param mixed $ticket_qty
	     */
	    public function setTicketQty($ticket_qty)
	    {
	        $this->ticket_qty = $ticket_qty;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getDiscount()
	    {
	        return $this->discount;
	    }

	    /**
	     * @param mixed $discount
	     */
	    public function setDiscount($discount)
	    {
	        $this->discount = $discount;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getDate()
	    {
	        return $this->date;
	    }

	    /**
	     * @param mixed $date
	     */
	    public function setDate($date)
	    {
	        $this->date = $date;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getAmount()
	    {
	        return $this->amount;
	    }

	    /**
	     * @param mixed $amount
	     */
	    public function setAmount($amount)
	    {
	        $this->amount = $amount;

	        return $this;
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

	    /**
	     * @return mixed
	     */
	    public function getPayment()
	    {
	        return $this->payment;
	    }

	    /**
	     * @param mixed $payment
	     */
	    public function setPayment($payment)
	    {
	        $this->payment = $payment;
	    }

	    /**
	     * @param $ticket: Ticket
	     */
	    public function addTicket( $ticket ){
	    	if( $ticket != null ){
	    		array_push( $this->tickets, $ticket );
	    	}
	    }
	}
 ?>
<?php 
namespace model;
/**
-  id: int
-  authentification_code: int
-  date: string
-  amount: float
  */
 class Payment
 {

 	private $id;
 	private $authentification_code;
 	private $date;
 	private $amount;
    private $method;	
 	
 	function __construct( $options )
 	{
 		$this->setId(        ( isset($options['payment_id']) )   ? $options['payment_id'] : null );
 		$this->setAuthentificationCode(  ( isset($options['payment_auth_code']) ) ? $options['payment_auth_code'] : '' );
 		$this->setDate(     ( isset($options['payment_date']) )     ? $options['payment_date'] : '' );
        $this->setAmount(   ( isset($options['payment_amount']) )     ? $options['payment_amount'] : 0 );
        $this->setMethod(   ( isset($options['payment_method']) )     ? $options['payment_method'] : '' );
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
    public function getAuthentificationCode()
    {
        return $this->authentification_code;
    }

    /**
     * @param mixed $authentification_code
     */
    public function setAuthentificationCode($authentification_code)
    {
        $this->authentification_code = $authentification_code;
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
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

} 
 ?>
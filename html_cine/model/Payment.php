<?php 
namespace model;
/**
  * 
  */
 class Payment
 {

 	private $id;
 	private $authCode;
 	private $date;
 	private $amount;
 	private $count;	
 	
 	function __construct( $options )
 	{
 		$this->setId(        ( isset($options['id']) )       ? $options['id'] : null );
 		$this->setAmount(    ( isset($options['amount']) )   ? $options['amount'] : 0 );
 		$this->setCount(     ( isset($options['count']) )    ? $options['count'] : null );
 		$this->setDate(      ( isset($options['date']) )     ? $options['date'] : null );
 		$this->setAuthCode(  ( isset($options['authCode']) ) ? $options['authCode'] : null );
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
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * @param mixed $authCode
     */
    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;
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
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }
} 
 ?>
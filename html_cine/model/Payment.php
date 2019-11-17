<?php 
namespace model;
/**
-  id: int
-  authentification_code: int
-  date: string
-  amount: float
-  count: object: Count
  */
 class Payment
 {

 	private $id;
 	private $authentification_code;
 	private $date;
 	private $amount;
 	private $count;	
 	
 	function __construct( $options )
 	{
 		$this->setId(        ( isset($options['payment_id']) )   ? $options['payment_id'] : null );
 		$this->setAuthentificationCode(  ( isset($options['payment_amount']) ) ? $options['payment_amount'] : 0 );
 		$this->setDate(     ( isset($options['payment_date']) )     ? $options['payment_date'] : null );
        $this->setAmount(   ( isset($options['payment_amount']) )     ? $options['payment_amount'] : null );
        $this->setCount(    ( isset($options['payment_count']) )    ? $options['payment_count'] : null );
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
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     *
     * @return self
     */
    public function setAuthentificationCode($authentification_code)
    {
        $this->authentification_code = $authentification_code;

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
     *
     * @return self
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
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
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
     *
     * @return self
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }
} 
 ?>
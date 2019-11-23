<?php
namespace model;
/**
-  id: int
-  authentification_code: int
-  date: string
-  amount: float
-  mp_preference_id
-  mp_payment_id
-  mp_payment_status
-  mp_payment_status_detail
-  mp_merchant_order_id
-  mp_processing_mode
-  mp_merchant_account_id
  */
 class Payment
 {

 	private $id;
 	private $authentification_code;
 	private $date;
 	private $amount;
  private $method;
  private $purchaseId;
  private $mp_preference_id;
  private $mp_payment_id;
  private $mp_payment_status;
  private $mp_payment_status_detail;
  private $mp_merchant_order_id;
  private $mp_processing_mode;
  private $mp_merchant_account_id;

 	function __construct( $options )
 	{
    extract($options);
 		$this->setId(        ( isset($options['payment_id']) )   ? $options['payment_id'] : null );
 		$this->setAuthentificationCode(  ( isset($options['payment_auth_code']) ) ? $options['payment_auth_code'] : '' );
 		$this->setDate(     ( isset($options['payment_date']) )     ? $options['payment_date'] : '' );
    $this->setAmount(   ( isset($options['payment_amount']) )     ? $options['payment_amount'] : 0 );
    $this->setMethod(   ( isset($options['payment_method']) )     ? $options['payment_method'] : '' );
    $this->setPurchaseId((isset($options['purchase_id']) )      ? $options['purchase_id'] : null );

    $this->setMPReferenceId(isset($mp_preference_id) ? $mp_preference_id : '');
    $this->setMPPaymentId(isset($mp_payment_id) ? $mp_payment_id : '');
    $this->setMPPaymentStatus(isset($mp_payment_status) ? $mp_payment_status : '');
    $this->setMPPaymentStatusDetail(isset($mp_payment_status_detail) $mp_payment_status_detail ? : '');
    $this->setMPMerchantOrderId(isset($mp_merchant_order_id) ? $mp_merchant_order_id : '');
    $this->setMPProcessingMode(isset($mp_processing_mode) ? $mp_processing_mode : '');
    $this->setMPMerchantAccountId(isset($mp_merchant_account_id) ? $mp_merchant_account_id : '');
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

    public function setPurchaseId( $purchaseId ){
        $this->purchaseId = $purchaseId
    }

    public function getPurchaseId(){
        return $this->purchaseId;
    }


    public function  getMPReferenceId(){
      return $this->mp_preference_id;
    };
    public function  getMPPaymentId(){
      return $this->mp_payment_id;
    };
    public function  getMPPaymentStatus(){
      return $this->mp_payment_status;
    };
    public function  getMPPaymentStatusDetail(){
      return $this->mp_payment_status_detail;
    };
    public function  getMPMerchantOrderId(){
      return $this->mp_merchant_order_id;
    };
    public function  getMPProcessingMode(){
      return $this->mp_processing_mode;
    };
    public function  getMPMerchantAccountId(){
      return $this->mp_merchant_account_id;
    };


    public function  setMPReferenceId($value){
      return $this->mp_preference_id = $value;
    };
    public function  setMPPaymentId($value){
      return $this->mp_payment_id = $value;
    };
    public function  setMPPaymentStatus($value){
      return $this->mp_payment_status = $value;
    };
    public function  setMPPaymentStatusDetail($value){
      return $this->mp_payment_status_detail = $value;
    };
    public function  setMPMerchantOrderId($value){
      return $this->mp_merchant_order_id = $value;
    };
    public function  setMPProcessingMode($value){
      return $this->mp_processing_mode = $value;
    };
    public function  setMPMerchantAccountId($value){
      return $this->mp_merchant_account_id = $value;
    };

}
 ?>

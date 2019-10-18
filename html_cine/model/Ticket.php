<?php 
namespace model;
/**
 * 
 */
class Ticket
{
	private $id;
	private $qrCode;
	private $purchase;
	private $show;

	function __construct( $id = null, $qrCode = null, $purchase = null, $show = null )
	{
		if( $id != null )		$this->setId($id);
		if( $qrCode != null )	$this->setQrCode($qrCode);
		if( $purchase != null )	$this->setPurchase($purchase);
		if( $show != null )		$this->setShow($show);

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
    public function getQrCode()
    {
        return $this->qrCode;
    }

    /**
     * @param mixed $qrCode
     */
    public function setQrCode($qrCode)
    {
        $this->qrCode = $qrCode;
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
     *
     * @return self
     */
    public function setPurchase($purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * @return mixed
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * @param mixed $show
     */
    public function setShow($show)
    {
        $this->show = $show;
    }
}
 ?>
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
	private $show;     // Object : Show

	function __construct( $options )
	{
		$this->setId( (isset($options['id']) ) ? $options['id'] : null );
		$this->setQrCode( (isset($options['qrCode']) ) ? $options['qrCode'] : null );
		$this->setPurchase( (isset($options['purchase']) ) ? $options['purchase'] : null );
		$this->setShow( (isset($options['show']) ) ? $options['show'] : null );

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
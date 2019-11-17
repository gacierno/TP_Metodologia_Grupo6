<?php 
namespace model;
/**
-  id: int
-  qrCode: string
-  show: Object : Show
 */
class Ticket
{
	private $id;
	private $qrCode;
	private $show;     // Object : Show

	function __construct( $options )
	{
		$this->setId( (isset($options['ticket_id']) ) ? $options['ticket_id'] : null );
		$this->setQrCode( (isset($options['ticket_qrCode']) ) ? $options['ticket_qrCode'] : null );
		$this->setShow( (isset($options['ticket_show']) ) ? $options['ticket_show'] : null );

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
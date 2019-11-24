<?php
namespace model;
/**
-  id: int
-  code: string
-  show: Object : Show
 */
class Ticket
{
	private $id;
	private $code;
	private $show;     // Object : Show

	function __construct( $options )
	{
		$this->setId( (isset($options['ticket_id']) ) ? $options['ticket_id'] : null );
		$this->setCode( (isset($options['ticket_code']) ) ? $options['ticket_code'] : 'ASASGQT@$YG@$Y@$^@$^' );
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
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

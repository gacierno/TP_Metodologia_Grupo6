<?php
namespace model;
/**
 *
 */
class Cinema
{
    private $id;
	private $name;
	private $address;
	private $capacity;
	private $ticketValue;
    private $available;


	function __construct( $options )
	{
		$this->setAddress(    ( isset($options['cinema_address']) )  ? $options['cinema_address'] : '' );
		$this->setCapacity(   ( isset($options['cinema_capacity']) ) ? $options['cinema_capacity'] : 0 );
		$this->setName(       ( isset($options['cinema_name']) )     ? $options['cinema_name'] : '' );
		$this->setTicketValue( ( isset($options['cinema_ticketValue']) )? $options['cinema_ticketValue'] : 0);
        $this->setId(         ( isset($options['cinema_id']) )       ? $options['cinema_id'] : null );
        $this->setAbailability( ( isset($options['cinema_available']) )       ? $options['cinema_available'] : 1 );
	}

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    /**
     * @return mixed
     */
    public function getTicketValue()
    {
        return $this->ticketValue;
    }

    /**
     * @param mixed $ticketValue
     */
    public function setTicketValue($ticketValue)
    {
        $this->ticketValue = $ticketValue;
    }

    /**
     * @return mixed
     */
    public function getSwhos()
    {
        return $this->shows;
    }

    /**
     * @param mixed $available
     */
    public function setAbailability($available)
    {
        $this->available = $available;
    }

    /**
     * @return mixed
     */
    public function getAbailability()
    {
        return $this->available;
    }

}
 ?>

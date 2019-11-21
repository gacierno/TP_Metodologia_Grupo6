<?php
namespace model;
/*

-  id: int
-  name: string
-  capacity: int
-  ticketValue: float
-  available: boolean

*/

use model\Cinema as Cinema;

class CinemaRoom
{
    private $id;
	private $name;
	private $capacity;
	private $ticketValue;
    private $available;
    private $cinema; //object Cinema


	function __construct( $options )
	{
		$this->setCapacity(   ( isset($options['cinemaroom_capacity']) ) ? $options['cinemaroom_capacity'] : 0 );
		$this->setName(       ( isset($options['cinemaroom_name']) )     ? $options['cinemaroom_name'] : '' );
		$this->setTicketValue( ( isset($options['cinemaroom_ticketValue']) )? $options['cinemaroom_ticketValue'] : 0);
        $this->setId(         ( isset($options['cinemaroom_id']) )       ? $options['cinemaroom_id'] : null );
        $this->setAvailability( ( isset($options['cinemaroom_available']) ) ? $options['cinemaroom_available'] : 1 );
        $this->setCinema(       ( isset($options['cinemarrom_cinema'])    ) ? $options['cinemarrom_cinema']    : null );
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
    public function setAvailability($available)
    {
        $this->available = $available;
    }

    /**
     * @return mixed
     */
    public function getAvailability()
    {
        return $this->available;
    }

    /**
     * @return class Cinema
     */
    public function getCinema()
    {
        return $this->cinema;
    }

    /**
     * @param mixed $cinema
     */
    public function setCinema($cinema)
    {
        $this->cinema = $cinema;
    }

}
 ?>

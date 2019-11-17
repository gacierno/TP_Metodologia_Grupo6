<?php
namespace model;
/**
-  id: int
-  name: name
-  address: string
-  available: boolean
-  cinemarooms: array: CinemaRoom
 */
class Cinema
{
    private $id;
	private $name;
	private $address;
    private $available;
    private $cinemarooms;


	function __construct( $options )
	{
		$this->setAddress(    ( isset($options['cinema_address']) )  ? $options['cinema_address'] : '' );
		$this->setName(       ( isset($options['cinema_name']) )     ? $options['cinema_name'] : '' );
        $this->setId(         ( isset($options['cinema_id']) )       ? $options['cinema_id'] : null );
        $this->setAvailability( ( isset($options['cinema_available']) )     ? $options['cinema_available'] : 1 );
        $this->setCinemaRooms(  ( isset($options['cinema_cinemarooms']) )   ? $options['cinema_cinemarooms']: array() );
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
     * @param mixed $cinemarooms
     */
    public function setCinemaRooms($cinemarooms)
    {
        $this->cinemarooms = $cinemarooms;
    }

    /**
     * @return mixed
     */
    public function getCinemaRooms()
    {
        return $this->cinemarooms;
    }

    
}
 ?>

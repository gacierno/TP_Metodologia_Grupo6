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

	function __construct( $name = 'Unnamed', $address = 'No address', $capacity = 0, $ticketValue = 0, $id = null )
	{
		$this->setAddress($address);
		$this->setCapacity($capacity);
		$this->setName($name);
		$this->setTicketValue($ticketValue);
        if(isset($id)) $this->setId($id);
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
}
 ?>

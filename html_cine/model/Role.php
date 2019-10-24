<?php 
namespace model;
/**
 * 
 */
class Role
{

	private $id;
	private $name;
	private $description;
	
	function __construct( $options )
	{
		$this->setDescription( (isset($options['description']) )? $options['description'] : null ) ;
		$this->setId( (isset($options['id']) )? $options['id'] : null ) ;
		$this->setName( (isset($options['name']) )? $options['name'] : null ) ;	
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
 ?>
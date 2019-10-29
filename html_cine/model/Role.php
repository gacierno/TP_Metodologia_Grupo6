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
		$this->setDescription( (isset($options['role_description']) )? $options['role_description'] : null ) ;
		$this->setId( (isset($options['role_id']) )? $options['role_id'] : null ) ;
		$this->setName( (isset($options['role_name']) )? $options['role_name'] : null ) ;	
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
<?php 
namespace model;
/**
 * 
 */
class Count
{

	private $id;
	private $name;
	
	function __construct( $arg )
	{
		$this->setId(     (isset($arg['id']))  ?$arg['id']     :null );
		$this->setName(   (isset($arg['name']))?$arg['name']   :'' );
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
}
 ?>
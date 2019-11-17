<?php 
namespace model;
/**
-  id: int
-  company: string
 */
class Count
{

	private $id;
	private $company;
	
	function __construct( $arg )
	{
		$this->setId(     (isset($arg['count_id']))  ?$arg['count_id'] : 0 );
		$this->setCompany( (isset($arg['count_company']))?$arg['count_company'] :'' );
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
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }
}
 ?>
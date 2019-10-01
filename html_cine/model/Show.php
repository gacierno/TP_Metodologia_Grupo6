<?php 
namespace model;
/**
 * 
 */
class Show
{
	
	private $day;
	private $time;

	function __construct( $day = '1980-01-01', $time = '00:00' )
	{
		$this->setTime($time);
		$this->setDay($day);
	}



    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }
}
 ?>
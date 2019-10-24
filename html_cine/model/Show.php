<?php 
namespace model;
/**
 * 
 */
class Show
{
	private $id;
	private $day;
	private $time;
    private $movie;

	function __construct( $day = '1980-01-01', $time = '00:00', $movie = null, $id = null )
	{
        if( $id != null ) $this->setId($id);
		$this->setTime($time);
		$this->setDay($day);
        $this->setMovie($movie);
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

    /**
     * @return mixed
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @param mixed $movie
     */
    public function setMovie($movie)
    {
        $this->movie = $movie;
    }

}
 ?>
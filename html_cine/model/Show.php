<?php 
namespace model;
/**
 * 
 */
class Show
{
	
	private $day;
	private $time;
    private $movie;
    private $cinema;

	function __construct( $day = '1980-01-01', $time = '00:00', $movie = null, $cinema = null )
	{
		$this->setTime($time);
		$this->setDay($day);
        $this->setMovie($movie);
        $this->setCinema($cinema);
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

    /**
     * @return mixed
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
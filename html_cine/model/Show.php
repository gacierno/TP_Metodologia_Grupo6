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
    private $movie;  // Object : Movie
    private $cinema; // Object : Cinema
    private $available;

	function __construct( $options )
	{
        $this->setId( (isset($options['show_id']) ) ? $options['show_id'] : null );
		$this->setTime( (isset($options['show_time']) ) ? $options['show_time'] : null );
		$this->setDay( (isset($options['show_date']) ) ? $options['show_date'] : null );
        $this->setMovie( (isset($options['show_movie']) ) ? $options['show_movie'] : null );
        $this->setCinema( (isset($options['show_cinema']) ) ? $options['show_cinema'] : null );
        $this->setAbailability( ( isset($options['show_available']) ) ? $options['show_available'] : 1 );
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

    /**
     * @param mixed $available
     */
    public function setAbailability($available)
    {
        $this->available = $available;
    }

    /**
     * @return mixed
     */
    public function getAbailability()
    {
        return $this->available;
    }

}
 ?>

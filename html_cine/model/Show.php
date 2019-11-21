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
  private $end_time;
  private $movie;  // Object : Movie
  private $cinemaroom; // Object : CinemaRoom
  private $available;

	function __construct( $options )
	{
        $this->setId( (isset($options['show_id']) ) ? $options['show_id'] : null );
				$this->setTime( (isset($options['show_time']) ) ? $options['show_time'] : null );
        $this->setEndTime( (isset($options['show_end_time']) ) ? $options['show_end_time'] : null );
				$this->setDay( (isset($options['show_date']) ) ? $options['show_date'] : null );
        $this->setMovie( (isset($options['show_movie']) ) ? $options['show_movie'] : null );
        $this->setCinemaRoom( (isset($options['show_cinemaroom']) ) ? $options['show_cinemaroom'] : null );
        $this->setAvailability( ( isset($options['show_available']) ) ? $options['show_available'] : 1 );
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
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param mixed $time
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
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
    public function setCinemaRoom($cinemaroom)
    {
        $this->cinema = $cinemaroom;
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

}
 ?>

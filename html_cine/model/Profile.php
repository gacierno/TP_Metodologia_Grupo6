<?php 
namespace model;
/**
 * 
 */
class Profile
{
	
	private $id;
	private $nombre;
	private $apellido;
	private $dni;


	function __construct( $options )
	{
		$this->setApellido(   (isset($options['profile_apellido']) )?$options['profile_apellido']: '' );
		$this->setDni(        (isset($options['profile_dni'])      )?$options['profile_dni']: null );
		$this->setId(         (isset($options['profile_id'])       )?$options['profile_id']: null );
		$this->setNombre(     (isset($options['profile_nombre'])   )?$options['profile_nombre']: '' );
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }
}
 ?>
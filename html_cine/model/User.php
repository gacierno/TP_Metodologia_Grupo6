<?php 
namespace model;
/**
 * 
 */
class User
{
	
	private $id;
	private $email;
	private $pass;
	private $role;		
	private $profile;

	function __construct( $options )
	{
		$this->setEmail( (isset($options['email']) ) ? $options['email'] : '' );
		$this->setId( (isset($options['id']) ) ? $options['id'] : null );
		$this->setPass( (isset($options['pass']) ) ? $options['pass'] : '' );
		$this->setProfile( (isset($options['profile']) ) ? $options['profile'] : null );
		$this->setRole( (isset($options['role']) ) ? $options['role'] : null );
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }
}
 ?>
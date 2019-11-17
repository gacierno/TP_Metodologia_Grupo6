<?php
namespace model;
/**
-  id: int
-  email: string
-  password: string
-  role:  object : Role
-  profile:  object : Profile
-  available: boolean
 */
class User
{

	private $id;
	private $email;
	private $pass;
	private $role;     // Object : Role
	private $profile;  // Object : Profile
    private $available;

	function __construct( $options )
	{
		$this->setEmail( (isset($options['user_email']) ) ? $options['user_email'] : '' );
		$this->setId( (isset($options['user_id']) ) ? $options['user_id'] : null );
		$this->setPass( (isset($options['user_password']) ) ? $options['user_password'] : '' );
		$this->setProfile( (isset($options['user_profile']) ) ? $options['user_profile'] : null );
		$this->setRole( (isset($options['user_role']) ) ? $options['user_role'] : null );
    $this->setAvailability( ( isset($options['user_available']) ) ? $options['user_available'] : 1 );

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

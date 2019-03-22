
<?php

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="users")
 **/
class UserEntity extends BaseEntity {
	/** 
	* @ORM\Column(type="string")
	* 
	**/
	protected $name;

	/** 
	* @ORM\Column(type="string", unique=true)
	*
	*/
	protected $email;

	/** 
	* @ORM\Column(type="string")
	*
	*/
	protected $password;


	public function __construct($name, $email, $password)
	{
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
	}

	/**
	 * Get the value of name
	 */ 
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of name
	 *
	 * @return  self
	 */ 
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	
	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}
}

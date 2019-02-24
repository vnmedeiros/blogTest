<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="authors")
 **/
class AuthorEntity extends BaseEntity {
	/** @ORM\Column(type="string") **/
	protected $name;

	/**
	* @ORM\OneToMany(targetEntity="PostEntity", mappedBy="authors")
	**/
	protected $posts;

	public function __construct($name)
	{
		$this->name = $name;
		$this->posts = new ArrayCollection();
	}

	public function addPost(PostEntity $post)
	{
		$this->posts[] = $post;
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
}

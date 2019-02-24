<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="tags")
 **/
class TagEntity extends BaseEntity {
	/** @ORM\Column(type="string") **/
	protected $name;

	/**
	* @ORM\ManyToMany(targetEntity="PostEntity", inversedBy="tags")
	* @ORM\JoinTable(name="post_tag",
	*     joinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")},
	*     inverseJoinColumns={@JoinColumn(name="post_id", referencedColumnName="id")})
	**/
	protected $posts;

	public function __construct($name)
	{
		$this->name = $name;
		$this->posts = new ArrayCollection();
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

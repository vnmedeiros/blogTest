<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="tags")
 **/
class TagEntity extends BaseEntity {
	/** @ORM\Column(type="string") **/
	protected $name;

	/**
	* @ORM\ManyToMany(targetEntity="PostEntity", mappedBy="tags", cascade={"persist"})
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

	public function addPost(PostEntity $post)
	{
		if ($this->posts->contains($post)) {
				return;
		}
		$this->posts->add($post);
		$post->addTag($this);
	}

	public function removePost(PostEntity $post)
	{
		if (!$this->posts->contains($post)) {
				return;
		}
		$this->posts->removeElement($post);
		$post->removeTag($this);
	}

	public function getPosts()
	{
		return $this->posts;
	}

	public function setPosts($posts)
	{
		$this->posts = $posts;

		return $this;
	}
}

<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="posts")
 **/
class PostEntity extends BaseEntity {
	/** @ORM\Column(type="string") **/
	protected $title;
	/** @ORM\Column(type="string") **/
	protected $slug;
	/** @ORM\Column(type="text") **/
	protected $body;
	/** @ORM\Column(type="string") **/
	protected $image;
	/** @ORM\Column(type="boolean") **/
	protected $published;

	/**
	* @ORM\ManyToOne(targetEntity="AuthorEntity", inversedBy="posts")
	**/
	protected $author;

	/**
	* @ORM\ManyToMany(targetEntity="TagEntity", mappedBy="posts")
	*/
	private $tags;

	public function __construct($title, $body, $image='', $published=false)
	{
		$this->body = $body;
		$this->title = $title;
		$this->image = $image;
		$this->published = $published;

		$formated = preg_replace('/\s/', '_', $this->title);
		$this->slug = trim($stripped);
	}

	public function addTag(TagEntity $tag)
	{
		$this->tags[] = $tag;
	}


	/**
	 * Get the value of title
	 */ 
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Set the value of title
	 *
	 * @return  self
	 */ 
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * Get the value of slug
	 */ 
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * Set the value of slug
	 *
	 * @return  self
	 */ 
	public function setSlug($slug)
	{
		$this->slug = $slug;
		return $this;
	}

	/**
	 * Get the value of body
	 */ 
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * Set the value of body
	 *
	 * @return  self
	 */ 
	public function setBody($body)
	{
		$this->body = $body;
		return $this;
	}

	/**
	 * Get the value of image
	 */ 
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Set the value of image
	 *
	 * @return  self
	 */ 
	public function setImage($image)
	{
		$this->image = $image;
		return $this;
	}

	/**
	 * Get the value of published
	 */ 
	public function getPublished()
	{
		return $this->published;
	}

	/**
	 * Set the value of published
	 *
	 * @return  self
	 */ 
	public function setPublished($published)
	{
		$this->published = $published;
		return $this;
	}
}

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

	public function __construct($title, $body, $image='', $published=false) {
		$this->body = $body;
		$this->title = $title;
		$this->image = $image;
		$this->published = $published;

		$formated = preg_replace('/\s/', '_', $this->title);
		$this->slug = trim($stripped);
	}

}

<?php

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\JsonResponse;

class BaseEntity implements JsonSerializable {
	
	/** @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	**/
	protected $id;

	public function getId()
	{
		return $this->id;
	}

	public function jsonSerialize()
	{
		return $this->as_array();
	}

	public function as_array()
	{
		$temp = get_object_vars($this);
		$vars = [];
		foreach($temp as $key => $value) {
			if(method_exists($this, 'get'.ucfirst($key))) {
				if($key == 'tags') {
					$vars[$key] =  $value->toArray();
				} else {
					$vars[$key] =  $value;
				}
			}
		}
		return $vars;
	}

	//
	// the Magic Methods:
	//
	// public function __set($property, $value) {
	// 	if (property_exists($this, $property)) {
	// 		$this->$property = $value;
	// 		return $this;
	// 	}
	// }

	// public function __get($property) {
	// 	if (property_exists($this, $property)) {
	// 		return $this->$property;
	// 	}
	// }

}

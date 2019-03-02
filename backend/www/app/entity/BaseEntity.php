<?php

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseEntity implements JsonSerializable {
	
	/** @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * 
	**/
	protected $id;

	public function getId()
	{
		return $this->id;
	}

	public function jsonSerialize()
	{
		$serializer = JMS\Serializer\SerializerBuilder::create()
    ->addMetadataDir(__DIR__)
		->build();
		$json = $serializer->serialize($this, 'json');
		return json_decode($json);
	}
}

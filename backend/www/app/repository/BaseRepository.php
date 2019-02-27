<?php
use Doctrine\ORM\EntityManager;

class BaseRepository {

	protected static $instance;
	protected $em;
	protected static $entityType = "BaseEntity";

	final public static function get_instance( )
	{
		//if (!isset(static::$instance))
			static::$instance = new static(static::$instance->em);
		static::$instance->init();
		return static::$instance;
	}

	final public function setEntityManager(EntityManager $em) 
	{
		$this->em = $em;
		return $this;
	}

	final private function __construct(EntityManager $em = null)
	{
		$this->em = $em;
		$this->init();
	}

	protected function init() {}

	public function persist(BaseEntity $object)
	{
		$this->em->persist($object);
		$this->em->flush();
		return $object;
	}

	public function remove(BaseEntity $object)
	{
		$this->em->remove($object);
		$this->em->flush();
		return $object;
	}

	public function get_all()
	{
		$repository = $this->em->getRepository($this->entityType);
		$list = $repository->findAll();
		return $list;
	}

	public function get_by_id($id)
	{
		$object = $this->em->find($this->entityType, $id);
		return $object;
	}

	public function merger_to_update(&$entity, $changes)
	{
		foreach ($changes->as_array() as $key => $value) {
			if($value) {
				$method = "set".ucfirst($key);
				if (method_exists($entity, $method)) {
					$entity->$method($value);
				}
			}
		}
	}
}

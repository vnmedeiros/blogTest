<?php
use Doctrine\ORM\EntityManager;

abstract class BaseRepository {

	protected static $instance;
	protected $em;
	protected $entityType = "BaseEntity";
	protected static $context = null;

	final public static function get_instance($context)
	{
		return isset(static::$instance)
			? static::$instance
			: static::$instance = new static($context);
	}

	//final private function __construct(EntityManager $em)
	final private function __construct($context)
	{
		self::$context = $context;
		$this->em = self::$context[EntityManager::class];
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

<?php
class TagRepository extends BaseRepository {
	
	protected function init() {
		$this->entityType = "TagEntity";
	}

	public static function mount_data($data)
	{
		$data = json_decode($data);
		$tag = new TagEntity($data->name);
		return $tag;
	}

	public function findByPost($post)
	{
		$repository = $this->em->getRepository($this->entityType);
		$tags = $repository->createQueryBuilder('tag')
			->where(':post MEMBER OF tag.posts')
			->setParameter('post', $post)
			->getQuery();
		return $tags->getResult();
	}
}

<?php
class PostRepository extends BaseRepository {

	protected function init() {
		$this->entityType = "PostEntity";
	}

	public static function mount_data($data)
	{
		$data = json_decode($data);
		$post = new PostEntity($data->title,
														$data->body,
														$data->image,
														$data->published);
		
		if (isset($data->author->id) &&  (!empty($data->author->id)) ) {
			$author = AuthorRepository::get_instance()->get_by_id($data->author->id);
			$post->setAuthor($author);
		}
	
		if (isset($data->tags) &&  (!empty($data->tags)) ) {
			foreach($data->tags as $tag) {
				$tag = TagRepository::get_instance()->get_by_id($tag->id);
				$post->addTag($tag);
			}
		}
		return $post;
	}

	public function findByAuthor($author)
	{
		$repository = $this->em->getRepository($this->entityType);
		$posts = $repository->createQueryBuilder('post')
			->where('post.author = :author')
			->setParameter('author', $author)
			->getQuery();
		return $posts->getResult();
	}

	public function find_by_tag($tag)
	{
		$repository = $this->em->getRepository($this->entityType);
		$posts = $repository->createQueryBuilder('post')
			->where(':tag MEMBER OF post.tags')
			->setParameter('tag', $tag)
			->getQuery();
		return $posts->getResult();
	}

}

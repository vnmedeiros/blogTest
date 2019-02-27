<?php
class PostRepository extends BaseRepository {
	protected $entityType = "PostEntity";

	public static function mount_data($data)
	{
		$data = json_decode($data);
		$post = new PostEntity($data->title,
														$data->body,
														$data->image,
														$data->published);
		
		if (isset($data->author->id) &&  (!empty($data->author->id)) ) {
			
			AuthorRepository::get_instance(self::$context)->entityType = "AuthorEntity";
			$author = AuthorRepository::get_instance(self::$context)->get_by_id($data->author->id);
			$post->setAuthor($author);
			AuthorRepository::get_instance(self::$context)->$entityType = "PostEntity";
		}
	
		if (isset($data->tags) &&  (!empty($data->tags)) ) {
			foreach($data->tags as $tag_id) {
				$tag = TagRepository::get_instance(self::getContext())->get_by_id($tag_id);
				$post->addTag($tag);
			}
		}
	
		return $post;
	}
}

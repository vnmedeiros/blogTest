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
		$author = AuthorRepository::get_instance($this)->get_by_id($data->author_id);
		$post->author = $author;
	
		foreach($data->tags as $tag_id) {
			$tag = TagRepository::get_instance($this)->get_by_id($tag_id);
			$post->addTag($tag);
		}
	
		return $post;
	}
}

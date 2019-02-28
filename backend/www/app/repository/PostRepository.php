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

}

<?php
class TagRepository extends BaseRepository {
	protected $entityType = "TagRepository";

	public static function mount_data($data)
	{
		$data = json_decode($data);
		$tag = new TagEntity($data->name);
		return $tag;
	}
}

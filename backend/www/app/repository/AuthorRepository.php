<?php
class AuthorRepository extends BaseRepository {
	protected $entityType = "AuthorEntity";

	public static function mount_data($data)
	{
		$data = json_decode($data);
		$author = new AuthorEntity($data->name);
		return $author;
	}
}

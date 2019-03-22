<?php
class UserRepository extends BaseRepository {

	protected function init() {
		$this->entityType = "UserEntity";
	}

	public static function mount_data($data)
	{
		$data = json_decode($data);
		$user = new UserEntity($data->name, $data->email, $data->password);
		return $user;
	}

	public function get_by_email($email)
	{
		$repository = $this->em->getRepository($this->entityType);
		$object = $repository->findOneBy(array('email' => $email));
		return $object;
	}

	public function check_user_pass($email, $password)
	{
		$repository = $this->em->getRepository($this->entityType);
		$object = $repository->findOneBy(['email' => $email, 'password'=>$password]);
		return $object;
	}
}

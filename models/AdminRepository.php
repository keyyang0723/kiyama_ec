<?php

class AdminRepository extends DbRepository
{
	public function insert($user_name,$password)
	{
		$password = $this->hashPassword($password);

		$sql = "
		INSERT INTO admins(user_name,password)
					VALUES(:user_name,:password)
				";

		$stmt = $this->execute($sql,array(
			':user_name' => $user_name,
			':password'  => $password,
		));		
	}

	public function hashPassword($password)
	{
		return password_hash($password,PASSWORD_DEFAULT);
	}

	public function fetchByUserName($user_name)
	{
		$sql = "SELECT * FROM admins WHERE user_name = :user_name";

		return $this->fetch($sql,array(':user_name'=>$user_name));
	}
	public function isUniqueUserName($user_name)
	{
		$sql = "SELECT COUNT(id) as count FROM admins WHERE user_name = :user_name";

		$row = $this->fetch($sql,array(':user_name' => $user_name));
		if($row['count']==='0'){
			return true;
		}
		return false;
	}
}

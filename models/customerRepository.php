<?php

class customerRepository extends DbRepository
{
	public function insert($customer_name,$password)
	{
		$password = $this->hashPassword($password);
		$now = new Datetime();


		$sql = "
		INSERT INTO customers(customer_name,password,created_at,updated_at)
					VALUES(:customer_name,:password,:created_at,:updated_at)
				";

		$stmt = $this->execute($sql,array(
			':customer_name' => $customer_name,
			':password'  => $password,
			':created_at' => $now->format('Y-m-d H:i:s'),
			':updated_at' => $now->format('Y-m-d H:i:s'),
		));		
	}

	public function hashPassword($password)
	{
		return password_hash($password,PASSWORD_DEFAULT);
	}

	public function fetchByUserName($customer_name)
	{
		$sql = "SELECT * FROM customers WHERE customer_name = :customer_name";

		return $this->fetch($sql,array(':customer_name'=>$customer_name));
	}
	public function isUniqueUserName($customer_name)
	{
		$sql = "SELECT COUNT(customer_id) as count FROM customers WHERE customer_name = :customer_name";

		$row = $this->fetch($sql,array(':customer_name' => $customer_name));
		if($row['count']==='0'){
			return true;
		}
		return false;
	}
}


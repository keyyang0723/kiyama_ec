<?php

class OrderRepository extends DbRepository
{
	public function fetchAllOrderList(){
		$sql = "
			SELECT * FROM orders
			";
			return $this->fetchAll($sql);

	}

	public function insertOrder($customer_name)
	{
		$sql="
			INSERT INTO orders(customer_name)
				VALUES(:customer_name)";

		$stm= $this->execute($sql,array(
			':customer_name' =>$customer_name,
		));
	}
}

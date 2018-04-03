<?php

class OrderRepository extends DbRepository
{
	public function fetchAllOrderList(){
		$sql = "
			SELECT * FROM orders
			";
			return $this->fetchAll($sql);

	}
}

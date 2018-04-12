<?php

class OrderRepository extends DbRepository
{
	public function fetchAllOrderList(){
		$sql = "
			SELECT * FROM orders
			";
			return $this->fetchAll($sql);

	}

	public function insertOrder($customer_name,$customer_address,$customer_street,$customer_zipcode,
		$customer_tel,$customer_email,$product_id,$price,$tax_rate)
	{
		$now = new Datetime();

		$sql="
			INSERT INTO orders(customer_name,customer_address,customer_street,customer_zipcode,
		customer_tel,customer_email,product_id,price,tax_rate,created_at,updated_at)
				VALUES(:customer_name,:customer_address,:customer_street,:customer_zipcode,
		:customer_tel,:customer_email,:product_id,:price,:tax_rate,:created_at,:updated_at)
		";

		$stm= $this->execute($sql,array(
			':customer_name' =>$customer_name,
			':customer_address' =>$customer_address,
			':customer_street' =>$customer_street,
			':customer_zipcode' =>$customer_zipcode,
			':customer_tel' =>$customer_tel,
			':customer_email' =>$customer_email,
			':product_id' =>$product_id,
			':price' =>$price,
			':tax_rate' =>$tax_rate,
			':created_at' => $now->format('Y-m-d H:i:s'),
			':updated_at' => $now->format('Y-m-d H:i:s'),
		));
	}

	public function fetchById($id){
		$sql = "
		SELECT * FROM orders WHERE id = :id";

		return $this->fetch($sql,array(':id'=>$id));
	}

	public function edit($customer_name,$customer_address,$customer_street,$customer_zipcode,
		$customer_tel,$customer_email,$product_id,$price,$tax_rate,$id)
	{
		$now = new Datetime();

		$sql = "
			UPDATE orders SET
			customer_name = :customer_name,
			customer_address = :customer_address,
			customer_street = :customer_street,
			customer_zipcode = :customer_zipcode,
			customer_tel = :customer_tel,
			customer_email = :customer_email,
			product_id = :product_id,
			price = :price,
			tax_rate = :tax_rate,
			updated_at = :updated_at
			WHERE id = :id
		";

		$stmt = $this->execute($sql,array(
			':id'		=>$id,
			':customer_name' =>$customer_name,
			':customer_address' =>$customer_address,
			':customer_street' =>$customer_street,
			':customer_zipcode' =>$customer_zipcode,
			':customer_tel' =>$customer_tel,
			':customer_email' =>$customer_email,
			':product_id' =>$product_id,
			':price' =>$price,
			':tax_rate' =>$tax_rate,
			':updated_at' => $now->format('Y-m-d H:i:s'),
		));
	}
	public function delete($id)
	{
		$sql = "DELETE FROM orders
			WHERE id = :id";
			$stmt = $this->execute($sql,array(
				':id' => $id,
			));
	}
}

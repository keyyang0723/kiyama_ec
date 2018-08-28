<?php

class order_detailsRepository extends DbRepository
{
	public function insertOrderDetail($product_id,$amount,$product_price,$orders_id){
		$sql = "
		INSERT INTO order_details(product_id,amount,product_price,orders_id)
					VALUES(:product_id,:amount,:product_price,:orders_id)
				";

		$stmt = $this->execute($sql,array(
			':product_id' => $product_id,
			':amount' => $amount,
			':product_price' => $product_price,
			':orders_id' => $orders_id
		));		
	}

	public function updateByCustomerID($customer_id,$orders_id){
		$sql ="
		UPDATE cart SET 
			orders_id = :orders_id,
			bought = 1
		WHERE customer_id = :customer_id
		AND bought = 0
		";
			
			$stmt = $this->execute($sql,array(
			':customer_id' =>$customer_id,
			':orders_id'   =>$orders_id
		));
	}

	public function fetchAllByOrderdId($orders_id){
		$sql = "
		SELECT * FROM order_details 
		INNER JOIN products
		ON order_details.product_id = products.id 
		WHERE orders_id = :orders_id
		";

		return $this->fetchAll($sql,array(
			':orders_id' => $orders_id
		));
	}

	public function deliteByOrdersid($orders_id){
		$sql = "DELETE FROM order_details
			WHERE orders_id = :orders_id";
			$stmt = $this->execute($sql,array(
				':orders_id' => $orders_id,
			));
	}
}
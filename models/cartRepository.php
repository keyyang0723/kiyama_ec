<?php 
class cartRepository extends DbRepository{

	public function insertCart($customer_id,$product_id,$amount){
		$sql ="
		INSERT INTO cart(customer_id,product_id,amount)
			      VALUES(:customer_id,:product_id,:amount)";
		$stmt = $this->execute($sql,array(
			':customer_id' =>$customer_id,
			':product_id'  =>$product_id,
			':amount'      =>$amount
		));
	}
	public 
	function fetchByCustomer_id($customer_id){
		$sql ="SELECT * FROM cart INNER JOIN products  
		ON cart.product_id = products.id 
		WHERE customer_id = :customer_id 
		AND cart.bought = 0 ";
		return $this->fetchAll($sql,array(':customer_id'=>$customer_id));
	}

	public function isNotRegisted($customer_id,$product_id)
	{
		$sql = "SELECT COUNT(customer_id) as count FROM cart 
		WHERE customer_id = :customer_id 
		and  product_id = :product_id
		and bought = 0";

		$row = $this->fetch($sql,array(
			':customer_id' => $customer_id,
			':product_id'  => $product_id,
		));
		if($row['count'] === '0'){
			return true;
		}
		return false;
	}

	public function isRegisted($cart_id)
	{
		$sql = "SELECT COUNT(cart_id) as count FROM cart WHERE cart_id = :cart_id";

		$row = $this->fetch($sql,array(
			':cart_id' =>$cart_id,
		));
		if($row['count']==='0'){
			return false;
		}
		return true;
	}

	public function deleteCart($cart_id){
		$sql ="
		DELETE FROM cart WHERE cart_id = :cart_id";
			
			$stmt = $this->execute($sql,array(
			':cart_id' =>$cart_id,
		));
	}

	public function cartAmoutChage($amount,$cart_id){

		$sql ="
		UPDATE  cart 
		SET amount = :amount 
		WHERE cart_id = :cart_id";
			
			$stmt = $this->execute($sql,array(
			':cart_id' => $cart_id,
			':amount'  => $amount
		));
	}
}
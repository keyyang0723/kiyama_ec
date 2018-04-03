<?php

class ProductRepository extends DbRepository
{
	public function insert($name,$description,$category_id,$price,$image,$stock)
	{
		$sql = " 
			INSERT INTO products(name,description,category_id,price,image,stock)
			VALUES(:name,:description,:category_id,:price,:image,:stock)
			";

		$stmt = $this->execute($sql,array(
			':name'    =>$name,
			':description'=>$description,
			':category_id'=>$category_id,
			':price'       =>$price,
			':image'	  =>$image,
			':stock'	  =>$stock,
		));
	}

	// public function insert($name)
	// {
	// 	$sql = " 
	// 		INSERT INTO products(name)
	// 		VALUES(:name)
	// 		";

	// 	$stmt = $this->execute($sql,array(
	// 		':name'    =>$name,
	// 	));
	// }


	public function fetchAllProduct(){
		$sql = "
			SELECT * FROM products
			";
			return $this->fetchAll($sql);

	}
}

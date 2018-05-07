<?php

class ProductRepository extends DbRepository
{
	public function insert($name,$description,$category_id,$price,$image,$stock,$image_name)
	{
		$sql = " 
			INSERT INTO products(name,description,category_id,price,image,stock,image_name)
			VALUES(:name,:description,:category_id,:price,:image,:stock,:image_name)
			";

		$stmt = $this->execute($sql,array(
			':name'    =>$name,
			':description'=>$description,
			':category_id'=>$category_id,
			':price'       =>$price,
			':image'	  =>$image,
			':stock'	  =>$stock,
			':image_name' =>$image_name,
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

	public function fetchByName($name)
	{
		$sql = "SELECT * FROM products WHERE name = :name";
		return $this->fetch($sql,array(
			':name' => $name));
	}

	public function fetchById($id)
	{
		{
		$sql = "SELECT * FROM products WHERE id = :id";
		return $this->fetch($sql,array(
			':id' => $id));
	}
	}

	public function edit($name,$description,$category_id,$price,$image,$stock,$is_displayed,$id)
	{
		$sql = "
			UPDATE products SET 
				name = :name,
				description = :description,
				category_id = :category_id,
				price = :price,
				stock = :stock,
				image = :image,
				is_displayed = :is_displayed
				WHERE id = :id
				";

		$stmt = $this->execute($sql,array(
			':name'    =>$name,
			':description'=>$description,
			':category_id'=>$category_id,
			':price'       =>$price,
			':image'	  =>$image,
			':stock'	  =>$stock,
			'is_displayed' =>$is_displayed,
			'id'		=>$id,
		));
	}
	public function delete($id)
	{
		$sql = "DELETE FROM products
			WHERE id = :id";
			$stmt = $this->execute($sql,array(
				':id' => $id,
			));
	}

	public function reduce($product_id,$number){

		$sql = "UPDATE products SET
			stock = stock - :num
			WHERE id = :id
			";

		$stmt = $this->execute($sql,array(
			':id'=> $product_id,
			':num'=>$number,
			));
	}
}

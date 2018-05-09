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

	public function fetchAllProductsByName($name)
	{
		$sql = "SELECT * FROM products WHERE name LIKE :name";
		return $this->fetchAll($sql,array(
			':name' => $name));
	}

	public function fetchAllSearchProductsByCategory_id($category_id)
	{
		$sql = "SELECT * FROM products WHERE category_id = :category_id";
		return $this->fetchALL($sql,array(
			':category_id' => $category_id));
	}

	public function fetchAllProductsByNameAndCtegory_id($name,$category_id){

		$sql = "SELECT * FROM products WHERE category_id = :category_id AND name LIKE :name";
		return $this->fetchAll($sql,array(
			':name' => $name,
			':category_id' => $category_id
		));
	}

	public function edit($name,$description,$category_id,$price,$image,$stock,$is_displayed,$id,$image_name)
	{
		$sql = "
			UPDATE products SET 
				name = :name,
				description = :description,
				category_id = :category_id,
				price = :price,
				stock = :stock,
				image = :image,
				is_displayed = :is_displayed,
				image_name = :image_name
				WHERE id = :id
				";

		$stmt = $this->execute($sql,array(
			':name'    =>$name,
			':description'=>$description,
			':category_id'=>$category_id,
			':price'       =>$price,
			':image'	  =>$image,
			':stock'	  =>$stock,
			':is_displayed' =>$is_displayed,
			':image_name' =>$image_name,
			':id'		=>$id,
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

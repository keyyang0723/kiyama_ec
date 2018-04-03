<?php

class CategoryRepository extends DbRepository
{
	public function insert($name)
	{
		$sql = "INSERT INTO categories(name)
			VALUES(:name)";
		$stmt = $this->execute($sql,array(
			':name' =>$name,
		));
	}
	public function fetchAllCategories(){
		$sql ="SELECT *FROM categories";

		return $this->fetchAll($sql);

	}

	public function delete($id)
	{
		$sql = "DELETE FROM categories
			WHERE id = :id";
			$stmt = $this->execute($sql,array(
				':id' => $id,
			));
	}
}

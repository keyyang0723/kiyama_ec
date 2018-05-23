<?php

class productRepository extends DbRepository
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




	public function fetchPageProduct($display_product,$display_amount){
		$sql = "
			SELECT * FROM products LIMIT $display_product,$display_amount
			";
			return $this->fetchAll($sql
			);

	}

	public function fetchPageProductDisIs_displayed($display_product,$display_amount){
		$sql = "
			SELECT * FROM products WHERE NOT (is_displayed = 1) LIMIT $display_product,$display_amount
			";
			return $this->fetchAll($sql
			);

	}

	public function countProduct(){
		$sql = "
			SELECT COUNT(id) as count FROM products 
			";
			return $this->fetch($sql);
	}

	public function countProductRemoveIsdisplayed(){
		$sql = "
			SELECT COUNT(id) as count FROM products WHERE NOT (is_displayed = 1)
			";
			return $this->fetch($sql);
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

	public function fetchByProductId($product_id)
	{
		{
		$sql = "SELECT * FROM products WHERE id = :id";
		return $this->fetch($sql,array(
			':id' => $product_id));
		}
	}


	public function fetchAllProductsByNameAndCtegory_id($search_name,$category_id,$display_product,$display_amount){



		$sql = "SELECT * FROM products";
        $where = [];
        $param = [];
       
        if ( strlen($search_name)>0 ){
            $where[] = "name LIKE :name";
            $param[':name']  = '%'.$search_name.'%';
           
        }
        if ( strlen($category_id)>0) {
            $where[] = "category_id = :category_id";
            $param[':category_id'] = $category_id;
           

        }

   //      if(strlen($search_name) == 0 && strlen($category_id) == 0){
   //      		$sql .= " LIMIT $display_product,$display_amount
			// ";     
			// echo 444; 
   //      return $this->fetchAll($sql,$param
          
   //      );
        
   //      }

        if ( count($where)>0) {
            $sql .= " WHERE " . (implode(" AND ",$where));
        }

			$sql .= " LIMIT $display_product,$display_amount
			";      
			
        return $this->fetchAll($sql,$param
          
        );
       
	
	}

	public function fetchAllProductsByNameAndCtegory_idDisIs_displayed($search_name,$category_id,$display_product,$display_amount){



		$sql = "SELECT * FROM products";
        $where = [];
        $param = [];
        $where[] = "NOT (is_displayed = 1)";
        if ( strlen($search_name)>0 ){
            $where[] = "name LIKE :name";
            $param[':name']  = '%'.$search_name.'%';
        }
        if ( strlen($category_id)>0) {
            $where[] = "category_id = :category_id";
            $param[':category_id'] = $category_id;
        }

        // if(strlen($search_name)==0 && !isset($category_id)){
        	
        // 	return [];

        // }

        // if ( count($where)>0) {
        //     $sql .= " WHERE " . (implode(" AND ",$where));
        // }
        	$sql .= " WHERE " . (implode(" AND ",$where));
			$sql .= " LIMIT $display_product,$display_amount
			";      

        return $this->fetchAll($sql,$param
         
        );

	
	}

	public function countSearchProduct($search_name,$category_id){


		$sql   = "SELECT COUNT(id) as count FROM products";
        $where = [];
        $param = [];
        if ( strlen($search_name) >0 ){
            $where[] = "name LIKE :name";
            $param[':name']  = '%'.$search_name.'%';
        }
        if ( strlen($category_id) >0) {
            $where[] = "category_id = :category_id";
            $param[':category_id'] = $category_id;
        }

        //  if(strlen($search_name)==0 &&strlen($category_id) == 0){
        	
        // 	return $this->fetch($sql,$param
        // );

        // }

        if ( count($where)>0) {
            $sql .= " WHERE " . (implode(" AND ",$where));
        }
       
        return $this->fetch($sql,$param
          
        );
    }

    public function countSearchProductNotIsdisplayed($search_name,$category_id){

    	
		$sql     = "SELECT COUNT(id) as count FROM products";
        $where   = [];
        $param   = [];
        $where[] = "NOT (is_displayed = 1)";

        if ( strlen($search_name) > 0){
            $where[]         = "name LIKE :name";
            $param[':name']  = '%'.$search_name.'%';
        }
        if ( strlen($category_id) > 0) {
            $where[]               = "category_id = :category_id";
            $param[':category_id'] = $category_id;
        }


        // if ( count($where)>0) {
        //     $sql .= " WHERE " . (implode(" AND ",$where));
        // }
        $sql .= " WHERE " . (implode(" AND ",$where));
        
        return $this->fetch($sql,$param
          
        );
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

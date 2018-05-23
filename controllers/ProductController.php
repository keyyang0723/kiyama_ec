<?php

class ProductController extends Controller
{
	// public function indexAction()
	// {	
	// 	if(!$this->session->isAuthenticated()){
	// 		return $this->redirect('/account/signin');
	// 	}

	// 	$number_of_products	= $this->db_manager->get('product')->countproduct();
	// 	$display_amount	    = 15;
	// 	$last_page 		    = ceil($number_of_products['count'] / $display_amount);
	// 	$now_page           = $this->request->getget('page') ? $this->request->getget('page') : 1;
	// 	$next_page          = $now_page+1;
	// 	$prev_page          = $now_page-1;
	// 	$display_product    = floor(($now_page-1)*$display_amount);

	// 	$products 		    = $this->db_manager->get('product')->fetchPageProduct($display_product,$display_amount);
	// 	$categories 		= $this->db_manager->get('category')->fetchAllCategories();
		



	// 	return $this->render(array(
	// 		'products'			=> $products,
	// 		'last_page'			=> $last_page,
	// 		'now_page'			=> $now_page,
	// 		'display_product' 	=> $display_product,
	// 		'categories'		=> $categories,
	// 		'number_of_products'=> $number_of_products,
	// 		'next_page'         => $next_page,
	// 		'prev_page'         => $prev_page,
	// 		'name'   			=> '',
	// 	));	



	// }


	public function detailAction()
	{
		if(!$this->session->isAuthenticated()){
			return $this->redirect('/account/signin');
		}
		$path_info = $this->request->getPathInfo();
		$parms = explode('/',$path_info);
		$id = $parms[3];
		//$id = $this->request->getGet('id');
		$product = $this->db_manager->get('Product')->fetchById($id);

		if($product === false){
			return $this->redirect('/admin/errorpage');
		}
		return $this->render(array(
			'id' =>$id,
			'product' =>$product));
	}

	public function editAction()
	{
		if(!$this->session->isAuthenticated()){
			return $this->redirect('/account/signin');
		}

		$products 	= $this->db_manager->get('product')->fetchAllProduct();
		$categories = $this->db_manager->get('category')->fetchAllCategories();
		if(!$this->request->isPost()){
		
		return $this->render(array(
			'products'		=> $products,
			'name'   		=> '',
			'description'	=> '',
			'categories' 	=> $categories,
			'category_id'	=> '',
			'price'       	=> '',
			'image'	  		=> '',
			'stock'	  		=> '',
			'fname'  		=> '',
			'image_name'    => '',
			'is_displayed'  => '',
		));	
		}

		$categories =$this->db_manager->get('category')->fetchAllCategories();
		$name = $this->request->getPost('name');
		$description = $this->request->getPost('description');
		$price = $this->request->getPost('price');
		$stock = $this->request->getPost('stock');
		$category_id = $this->request->getPost('category_id');
		$image = $this->request->getPost('image');
		$id = $this->request->getPost('id');
		$is_displayed = $this->request->getPost('is_displayed');
		$image_name = $this->request->getPost('image_name');
		
		if(isset($_FILES['fname'])){
			$tempfile = $_FILES['fname']['tmp_name'];
		}


		$delite = $this ->request->getPost('delite');
	
		$errors = array();
		if(!strlen($name)){
			$errors[]='商品名を入力してください';
		}else if(mb_strlen($name) > 50){
			$errors[]='商品名は50文字以内で入力してください';
			$name ='';
		}

		if(!strlen($description)){
			$errors[]='説明を入力してください';
		}else if(mb_strlen($description) > 200){
			$errors[]='説明は200文字以内で入力してください';
			$description ='';
		}
		if(!strlen($price)){
			$errors[]='値段を入力してください';
		}elseif(ctype_digit($price)=== FALSE ){
			$errors[]='値段は半角数字で入力してください';
		}else if(mb_strlen($price) > 10){
			$errors[]='値段は10桁以下で入力してください';
			$price ='';
		}

		if(!isset($category_id)){
			$errors[]='カテゴリを選択してください';
		}

		if(!strlen($stock)){
			$errors[]='個数を入力してください';
		}elseif(!ctype_digit($stock)){
			$errors[]='個数は半角数字で入力してください';
		}else if(mb_strlen($stock) > 10){
			$errors[]='商品数は10桁以内で入力してください';
			$stock ='';
		}
 
		if(isset($_FILES['fname']) && strlen($_FILES['fname']['type'])!=0 ){
			if(filesize($tempfile) > 1000000){
				$errors[]='画像ファイルが大きすぎます';
			}
			if($_FILES['fname']['type'] !== 'image/jpeg'){
				$errors[]='画像はjpgを選択してください';
			}
		}	


		if(isset($delite)){
			$this->db_manager->get('product')->delete($id);
			return $this->redirect('/admin');
		}
		
		if(count($errors)===0){

			if(isset($tempfile)){
				if(is_uploaded_file($tempfile)){
					if(file_exists('image/'.$image_name.'.jpg')){
						unlink('image/'.$image_name.'.jpg');
					}
					$user = $this->session->get('admin');
					$imageuser = $user['user_name'];
					$imagetime = date('H:i:s');
					$image_name = sha1($imageuser.$imagetime);
					$filename = 'image/'.$image_name.'.jpg';
					move_uploaded_file($tempfile , $filename);
				}	
			}else{

			}
			if($id===null){
				$this->db_manager->get('Product')->insert($name,$description,$category_id,$price,$image,$stock,$image_name);

				return $this->redirect('/admin');
			}else{
			$this->db_manager->get('Product')->edit($name,$description,$category_id,$price,$image,$stock,$is_displayed,$id,$image_name);}
			return $this->render(array(
				'errors'  => $errors,
				'name'   =>$name,
				'description'=>$description,
				'categories'=>$categories,
				'category_id'=>$category_id,
				'price'       =>$price,
				'image'	  =>$image,
				'stock'	  =>$stock,
				'is_displayed' =>$is_displayed,
				'image_name' =>$image_name,
				'fname' =>'',
				'id'  	 =>$id,
			));
		}

			return $this->render(array(
				'errors'  => $errors,
				//'products'=>$products,
				'name'   =>$name,
				'description'=>$description,
				'categories'=>$categories,
				'category_id'=>$category_id,
				'price'       =>$price,
				'image'	  =>$image,
				'stock'	  =>$stock,
				'is_displayed' =>$is_displayed,
				'image_name' =>$image_name,
				'fname' =>'',
				'id'  	 =>$id,
			));
	}

	public function indexAction(){

		if(!$this->session->isAuthenticated()){
			return $this->redirect('/account/signin');
		}

		$categories         = $this->db_manager->get('category')->fetchAllCategories();
		$search_name        = $this->request->getPost('search_name');
		$category_id        = $this->request->getPost('category_id');
		$products           = [];

		if(strlen($search_name) == 0 && strlen($category_id) == 0){
			$number_of_products = $this->db_manager->get('product')->countProduct();
			
		}else{
			$number_of_products	= $this->db_manager->get('product')->countSearchProduct($search_name,$category_id);
		}
		$display_amount	    = 15;
		$last_page 		    = ceil($number_of_products['count'] / $display_amount);
		$now_page           = $this->request->getget('page') ? $this->request->getget('page') : 1;
		$next_page          = $now_page+1;
		$prev_page          = $now_page-1;
		$display_product    = floor(($now_page-1)*$display_amount);
		var_dump($search_name,$category_id);
		if(strlen($search_name) == 0 && strlen($category_id) == 0){
			$products = $this->db_manager->get('product')->fetchPageProductDisIs_displayed($display_product,$display_amount);

		}else{
		$products = $this->db_manager->get('product')->fetchAllProductsByNameAndCtegory_id($search_name,$category_id,
			$display_product,$display_amount);}
	
		
		if(count($products) == 0 ){
			$errors[] = "該当する結果がありませんでした";
			return $this->render(array(
			'search_name'       => $search_name,
			'categories'        => $categories,
			'category_id'       => $category_id,
			'products'          => $products,
			'errors'            => $errors,
			'last_page'			=> $last_page,
			'now_page'			=> $now_page,
			'display_product' 	=> $display_product,
			'categories'		=> $categories,
			'number_of_products'=> $number_of_products,
			'next_page'         => $next_page,
			'prev_page'         => $prev_page,
		));
		}else{
			return $this->render(array(
				'search_name' =>$search_name,
				'categories'=>$categories,
				'category_id'=>$category_id,
				'products'=>$products,
				'last_page'			=> $last_page,
			'now_page'			=> $now_page,
			'display_product' 	=> $display_product,
			'categories'		=> $categories,
			'number_of_products'=> $number_of_products,
			'next_page'         => $next_page,
			'prev_page'         => $prev_page,
			));
		}
	}

	public function errorpageAction()
	{
		return $this->render(array());
	}
	

}
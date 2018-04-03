<?php

class ProductController extends Controller
{
	public function indexAction()
	{
		$products =$this->db_manager->get('product')->fetchAllProduct();

		return $this->render(array(
			'products'=>$products,
			'name'   =>'',
			'_token' =>$this->generateCsrfToken('product/post'),
		));	



	}
	// public function registAction()
	// {
	// 	$products =$this->db_manager->get('product')->fetchAllProduct();
	// 	$categories =$this->db_manager->get('category')->fetchAllCategories();
	// 	return $this->render(array(
	// 		'products'=>$products,
	// 		'name'   =>'',
	// 		'description'=>'',
	// 		'categories'=>$categories,
	// 		'price'       =>'',
	// 		'image'	  =>'',
	// 		'stock'	  =>'',
	// 		'_token' =>$this->generateCsrfToken('product/post'),
	// 	));	



	// }

	public function registAction()
	{
		$products =$this->db_manager->get('product')->fetchAllProduct();
		$categories =$this->db_manager->get('category')->fetchAllCategories();
		if(!$this->request->isPost()){
		
		return $this->render(array(
			'products'=>$products,
			'name'   =>'',
			'description'=>'',
			'categories'=>$categories,
			'category_id'=>'',
			'price'       =>'',
			'image'	  =>'',
			'stock'	  =>'',
			'_token' =>$this->generateCsrfToken('product/post'),
		));	
		}

		// $token = $this->request->getPost('_token');
		// if(!$this->checkCsrfToken('status/post',$token)){
		// 	return $this->redirect('/');
		// }
		$name = $this->request->getPost('name');
		$description = $this->request->getPost('description');
		$price = $this->request->getPost('price');
		$stock = $this->request->getPost('stock');
		$category_id = $this->request->getPost('category_id');
		$image = $this->request->getPost('image');
		$body = $this->request->getPost('body');
		$errors = array();
		if(!strlen($name)){
			$errors[]='商品名を入力してください';
		}else if(mb_strlen($name) > 200){
			$errors[]='商品名は２００文字以内で入力してください';
		}

		if(!strlen($description)){
			$errors[]='説明を入力してください';
		}
		if(!strlen($price)){
			$errors[]='値段を入力してください';
		}
		if(!isset($category_id)){
			$errors[]='カテゴリを選択してください';
		}
		if(!strlen($stock)){
			$errors[]='個数を入力してください';
		}
		if(!isset($image)){
			$errors[]='画像を選択してください';
		}


		if(count($errors)===0){
			$user = $this->session->get('user');
			$this->db_manager->get('Product')->insert($name,$description,$category_id,$price,$image,$stock);

			return $this->redirect('/');
		}

		$user = $this->session->get('admin');
		$status = $this->db_manager->get('product')
			->fetchAllProduct();

			return $this->render(array(
				'errors'  => $errors,
				'products'=>$products,
				'name'   =>$name,
				'description'=>$description,
				'categories'=>$categories,
				'category_id'=>$category_id,
				'price'       =>$price,
				'image'	  =>$image,
				'stock'	  =>$stock,
				'_token' =>$this->generateCsrfToken('product/post'),
			));

	}
























}
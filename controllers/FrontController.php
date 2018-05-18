<?php
class FrontController extends Controller
{
	public function frontAction()
	{

		$number_of_products	= $this->db_manager->get('product')->countProductRemoveIsdisplayed();
		$display_amount	    = 15;
		$last_page 		    = ceil($number_of_products['count'] / $display_amount);
		$now_page           = $this->request->getget('page') ? $this->request->getget('page') : 1;
		$next_page          = $now_page+1;
		$prev_page          = $now_page-1;
		$display_product    = floor(($now_page-1)*$display_amount);

		$products 		    = $this->db_manager->get('product')->fetchPageProductDisIs_displayed($display_product,$display_amount);
		$categories 		= $this->db_manager->get('category')->fetchAllCategories();
		

		return $this->render(array(
			'products'=>$products,
			'categories' =>$categories,

			'products'			=> $products,
			'last_page'			=> $last_page,
			'now_page'			=> $now_page,
			'display_product' 	=> $display_product,
			'categories'		=> $categories,
			'number_of_products'=> $number_of_products,
			'next_page'         => $next_page,
			'prev_page'         => $prev_page,
			'name'   			=> '',
		));	

	}

	public function detailAction()
	{
		$product_id = $this->request->getGet('product_id');
		$product = $this->db_manager->get('product')->fetchByProductId($product_id);
		if($product === false or $product['is_displayed']==1){
			return $this->redirect('/errorpage');
		}
		$number = $this->request->getPost('number');
		$_SESSION['number'] = $number;
		return $this->render(array(
			'number' => $number,
			'product_id' =>$product_id,
			'product' =>$product));
	}


	public function formAction()
	{	

		if($this->request->isPost()){
			$product_id = $this->request->getPost('product_id');
			$number = $this->request->getPost('number');

				return $this->render(array(
				'product_id'	=>$product_id,
				'customer_name' =>'',
				'customer_address'=>'',
				'customer_street'=>'',
				'customer_zipcode' =>'',
				'customer_tel'=>'',
				'customer_email'=>'',
				'number'=>$number,
			));
		}

		$product_id =$_SESSION['product_id'];
		$number = $_SESSION['number'];

		$_SESSION['product_id'] = '';
		$_SESSION['number'] = '';
		
		
 		if(isset($_SESSION['customer_name'])){
				$customer_name = $_SESSION['customer_name'];
				$_SESSION['customer_name'] = '';
			}else{
				$customer_name = '';
			}
			if(isset($_SESSION['customer_address'])){
				$customer_address = $_SESSION['customer_address'];
				$_SESSION['customer_address'] = '';
			}else{
				$customer_address = '';
			}
			if(isset($_SESSION['customer_street'])){
				$customer_street= $_SESSION['customer_street'];
				$_SESSION['customer_street'] = '';
			}else{
				$customer_street = '';
			}
			if(isset($_SESSION['customer_zipcode'])){
				$customer_zipcode = $_SESSION['customer_zipcode'];
				$_SESSION['customer_zipcode'] = '';
			}else{
				$customer_zipcode = '';
			}
			if(isset($_SESSION['customer_tel'])){
				$customer_tel = $_SESSION['customer_tel'];
				$_SESSION['customer_tel'] = '';
			}else{
				$customer_tel = '';
			}
			if(isset($_SESSION['customer_email'])){
				$customer_email = $_SESSION['customer_email'];
				$_SESSION['customer_email'] = '';
			}else{
				$customer_email = '';
			}
			if(isset($_SESSION['errors'])){
				$errors = $_SESSION['errors'];
			}else{
				$errors = [];
			}

		return $this->render(array(
			'number'=>$number,
			'customer_name' =>$customer_name,
			'customer_address'=>$customer_address,
			'customer_street'=>$customer_street,
			'customer_zipcode' =>$customer_zipcode,
			'customer_tel'=>$customer_tel,
			'customer_email'=>$customer_email,
			'errors' =>$errors,
			'product_id' =>$product_id,
			));
	}

	public function confAction()
	{	
		
		
		$customer_name = $this->request->getPost('customer_name');
		$customer_address = $this->request->getPost('customer_address');
		$customer_street= $this->request->getPost('customer_street');
		$customer_zipcode = $this->request->getPost('customer_zipcode');
		$customer_tel = $this->request->getPost('customer_tel');
		$customer_email = $this->request->getPost('customer_email');
		$product_id = $this->request->getPost('product_id');
		$product = $this->db_manager->get('product')->fetchByProductId($product_id);
		$tax_rate = "1.08";
		$number = $this->request->getPost('number');
		if(!$this->request->isPost() or $product === false or $number === false){
			$this->forward404();
		}
		$price = $product['price']*$number*$tax_rate;
		$errors = [];

		

		if(!strlen($customer_name)){
			$errors[] ='お名前を入力してください';
		}
		if(!strlen($customer_address)){
			$errors[] ='住所を入力してください';
		}
		if(!strlen($customer_street)){
			$errors[] ='番地を入力してください';
		}
		if(!strlen($customer_zipcode)){
			$errors[] ='住所番号を入力してください';
		}
		if(!strlen($customer_tel)){
			$errors[] ='電話番号を入力してください';
		}
		if(!strlen($customer_email)){
			$errors[] ='メールアドレスを入力してください';
		}

		$_SESSION['errors'] = $errors;
		$_SESSION['customer_name'] = $customer_name;
		$_SESSION['customer_address'] = $customer_address;
		$_SESSION['customer_street'] = $customer_street;
		$_SESSION['customer_zipcode'] = $customer_zipcode;
		$_SESSION['customer_tel'] = $customer_tel;
		$_SESSION['customer_email'] = $customer_email;
		$_SESSION['product_id'] = $product_id;
		$_SESSION['number'] = $number;
		

		if(count($errors)!==0){
		
			return $this->redirect('/form');
		
		}else{

			
			return $this->render(array(
			'number'=>$number,
			'product_id' => $product_id,
			'product'=>$product,
			'customer_name' =>$customer_name,
			'customer_address'=>$customer_address,
			'customer_street'=>$customer_street,
			'customer_zipcode' =>$customer_zipcode,
			'customer_tel'=>$customer_tel,
			'customer_email'=>$customer_email,
			'tax_rate' =>$tax_rate,
			'price' =>$price
			
		));
		}
	}

	public function postAction()
	{	
		if(!$this->request->isPost()){
			$this->forward404();
		}
		
		$customer_name = $this->request->getPost('customer_name');
		$customer_address = $this->request->getPost('customer_address');
		$customer_street= $this->request->getPost('customer_street');
		$customer_zipcode = $this->request->getPost('customer_zipcode');
		$customer_tel = $this->request->getPost('customer_tel');
		$customer_email = $this->request->getPost('customer_email');
		$product_id = $this->request->getPost('product_id');
		$product = $this->db_manager->get('product')->fetchByProductId($product_id);
		$tax_rate = $this->request->getPost('tax_rate');
		$number = $this->request->getPost('number');
		$price = $this->request->getPost('price');
		$errors = [];

		if(!strlen($customer_name)){
			$errors[] ='お名前を入力してください';
		}
		if(!strlen($customer_address)){
			$errors[] ='住所を入力してください';
		}
		if(!strlen($customer_street)){
			$errors[] ='番地を入力してください';
		}
		if(!strlen($customer_zipcode)){
			$errors[] ='住所番号を入力してください';
		}
		if(!strlen($customer_tel)){
			$errors[] ='電話番号を入力してください';
		}
		if(!strlen($customer_email)){
			$errors[] ='メールアドレスを入力してください';
		}

		if(ctype_digit($price)=== FALSE ){
			$errors[]='値段は半角数字で入力してください1';
		}

		if(ctype_digit($number)=== FALSE ){
			$errors[]='値段は半角数字で入力してください2';
		}

		if($tax_rate=== FALSE ){
			$errors[]='値段は半角数字で入力してください3';
		}

		
		if(count($errors)!==0){
		
			$this->forward404();
		
		}
		

		return $this->redirect('/finish');
		
	}
	
	public function finishAction(){
		return $this->render(array());
	}

	public function searchAction(){
		
		$categories         = $this->db_manager->get('category')->fetchAllCategories();
		$search_name        = $this->request->getPost('search_name');
		$category_id        = $this->request->getPost('category_id');
		$products           = [];

		$number_of_products	= $this->db_manager->get('product')->countSearchProductNotIsdisplayed($search_name,$category_id);

		$display_amount	    = 15;
		$last_page 		    = ceil($number_of_products['count'] / $display_amount);
		$now_page           = $this->request->getget('page') ? $this->request->getget('page') : 1;
		$next_page          = $now_page+1;
		$prev_page          = $now_page-1;
		$display_product    = floor(($now_page-1)*$display_amount);

		
		$products = $this->db_manager->get('product')->fetchAllProductsByNameAndCtegory_idDisIs_displayed($search_name,$category_id,$display_product,$display_amount);
	
		
		if(count($products) == 0 ){
			$errors[] = "該当する結果がありませんでした";
			return $this->render(array(
			'search_name' =>$search_name,
			'categories'=>$categories,
			'category_id'=>$category_id,
			'products'=>$products,
			'errors'=>$errors,
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
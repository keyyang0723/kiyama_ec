<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
//ユーザー用アカウントコントローラー
class FrontController extends Controller
{
	public function frontAction(){
		if(!$this->session->get('customer')){
			$this->session->clear();
			$this->session->setAuthenticated(false);
		}

		$customer = $this->session->get('customer');

		$categories         = $this->db_manager->get('category')->fetchAllCategories();
		$search_name        = $this->request->getPost('search_name');
		$category_id        = $this->request->getPost('category_id');
		$products           = [];

		
		if(strlen($search_name) == 0 && strlen($category_id) == 0){
			$number_of_products = $this->db_manager->get('product')->countProductRemoveIsdisplayed();
			
		}else{
			$number_of_products	= $this->db_manager->get('product')->countSearchProductNotIsdisplayed($search_name,$category_id);
		}


		$display_amount	    = 15;
		$last_page 		    = ceil($number_of_products['count'] / $display_amount);
		$now_page           = $this->request->getget('page') ? $this->request->getget('page') : 1;
		$next_page          = $now_page+1;
		$prev_page          = $now_page-1;
		$display_product    = floor(($now_page-1)*$display_amount);

		
		
		
		if(strlen($search_name) == 0 && strlen($category_id) == 0){
			$products = $this->db_manager->get('product')->fetchPageProductDisIs_displayed($display_product,$display_amount);

		}else{
			$products = $this->db_manager->get('product')->fetchAllProductsByNameAndCtegory_idDisIs_displayed($search_name,$category_id,$display_product,$display_amount);}
	

		
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
			'customer'          => $customer,
		));
		}else{
			return $this->render(array(
			'search_name'       => $search_name,
			'categories'        => $categories,
			'category_id'       => $category_id,
			'products'          => $products,
			'last_page'			=> $last_page,
			'now_page'			=> $now_page,
			'display_product' 	=> $display_product,
			'categories'		=> $categories,
			'number_of_products'=> $number_of_products,
			'next_page'         => $next_page,
			'prev_page'         => $prev_page,
			'customer'          => $customer,
			));
		}
	}

	public function errorpageAction()
	{
		return $this->render(array());
	}
	


	public function detailAction()
	{
		$customer   = $this->session->get('customer');
		$path_info  = $this->request->getPathInfo();
		$parms      = explode('/',$path_info);
		$product_id = $parms[1];
		$product    = $this->db_manager->get('product')->fetchByProductId($product_id);


		if($product === false or $product['is_displayed']==1){
			return $this->redirect('/errorpage');
		}
	
		return $this->render(array(
			'customer'   => $customer,
			'path_info'  => $path_info,
			'product_id' => $product_id,
			'product'    => $product
		));
	}


	public function formAction()
	{	

		if($this->request->isPost()){
			$product_id  = $this->request->getPost('product_id');
			$number      = $this->request->getPost('number');

				return $this->render(array(
				'product_id'       => $product_id,
				'customer_name'    => '',
				'customer_address' => '',
				'customer_street'  => '',
				'customer_zipcode' => '',
				'customer_tel'     => '',
				'customer_email'   => '',
				'number'           => $number,
			));
		}

		$product_id             = $_SESSION['product_id'];
		$number                 = $_SESSION['number'];
		$_SESSION['product_id'] = '';
		$_SESSION['number']     = '';
		
		
 		if(isset($_SESSION['customer_name'])){
				$customer_name                = $_SESSION['customer_name'];
				$_SESSION['customer_name']    = '';
			}else{
				$customer_name                = '';
			}
			if(isset($_SESSION['customer_address'])){
				$customer_address             = $_SESSION['customer_address'];
				$_SESSION['customer_address'] = '';
			}else{
				$customer_address             = '';
			}
			if(isset($_SESSION['customer_street'])){
				$customer_street              = $_SESSION['customer_street'];
				$_SESSION['customer_street']  = '';
			}else{
				$customer_street              = '';
			}
			if(isset($_SESSION['customer_zipcode'])){
				$customer_zipcode             = $_SESSION['customer_zipcode'];
				$_SESSION['customer_zipcode'] = '';
			}else{
				$customer_zipcod              = '';
			}
			if(isset($_SESSION['customer_tel'])){
				$customer_tel                 = $_SESSION['customer_tel'];
				$_SESSION['customer_tel']     = '';
			}else{
				$customer_tel                 = '';
			}
			if(isset($_SESSION['customer_email'])){
				$customer_email               = $_SESSION['customer_email'];
				$_SESSION['customer_email']   = '';
			}else{
				$customer_email               = '';
			}
			if(isset($_SESSION['errors'])){
				$errors = $_SESSION['errors'];
			}else{
				$errors = [];
			}
 	
		return $this->render(array(
			'number'           => $number,
			'customer_name'    => $customer_name,
			'customer_address' => $customer_address,
			'customer_street'  => $customer_street,
			'customer_zipcode' => $customer_zipcode,
			'customer_tel'     => $customer_tel,
			'customer_email'   => $customer_email,
			'errors'           => $errors,
			'product_id'       => $product_id,
			));
	}

	public function confAction()
	{	
		
		
		$customer_name    = $this->request->getPost('customer_name');
		$customer_address = $this->request->getPost('customer_address');
		$customer_street  = $this->request->getPost('customer_street');
		$customer_zipcode = $this->request->getPost('customer_zipcode');
		$customer_tel     = $this->request->getPost('customer_tel');
		$customer_email   = $this->request->getPost('customer_email');
		$product_id       = $this->request->getPost('product_id');
		$number           = $this->request->getPost('number');
		$product          = $this->db_manager->get('product')->fetchByProductId($product_id);
		$tax_rate         = "0.08";
		

		if(!$this->request->isPost() or $product === false or $number === false){
			$this->forward404();
		}
		$price  = $product['price']*$number+$product['price']*$number*$tax_rate;
		$errors = [];

		

		if(!strlen($customer_name)){
			$errors[]      = 'お名前を入力してください';
		}else if(mb_strlen($customer_name) > 50){
			$errors[]      = 'お名前は50文字以内で入力してください';
			$customer_name = '';
		}

		if(!strlen($customer_address)){
			$errors[]         = '住所を入力してください';
		}else if(mb_strlen($customer_address) > 50){
			$errors[]         = '住所は50文字以内で入力してください';
			$customer_address = '';
		}

		if(!strlen($customer_street)){
			$errors[]        = '番地を入力してください';
		}else if(mb_strlen($customer_street) > 50){
			$errors[]        = '番地は50文字以内で入力してください';
			$customer_street = '';
		}

		if(!strlen($customer_zipcode)){
			$errors[]         = '住所番号を入力してください';
		}else if(ctype_digit($customer_zipcode)=== FALSE ){
			$errors[]         = '住所番号は-無し半角数字で入力してください';
		}else if(mb_strlen($customer_zipcode) != 7){
			$errors[]         = '住所番号は7桁で入力してください';
			$customer_zipcode = '';
		}

		if(!strlen($customer_tel)){
			$errors[]     = '電話番号を入力してください';
		}else if(ctype_digit($customer_tel)=== FALSE ){
			$errors[]     = '電話番号は-無し半角数字で入力してください';
		}else if(mb_strlen($customer_tel) > 12){
			$errors[]     = '電話番号は12桁以下で入力してください';
			$customer_tel = '';
		}

		if(!strlen($customer_email)){
			$errors[]       = 'メールアドレスを入力してください';
		}else if(mb_strlen($customer_email) > 50){
			$errors[]       = 'メールアドレスは50文字以内で入力してください';
			$customer_email = '';
		}



		$_SESSION['errors']           = $errors;
		$_SESSION['customer_name']    = $customer_name;
		$_SESSION['customer_address'] = $customer_address;
		$_SESSION['customer_street']  = $customer_street;
		$_SESSION['customer_zipcode'] = $customer_zipcode;
		$_SESSION['customer_tel']     = $customer_tel;
		$_SESSION['customer_email']   = $customer_email;
		$_SESSION['product_id']       = $product_id;
		$_SESSION['number']           = $number;
		

		if(count($errors) !== 0){
		
			return $this->redirect('/form');
		
		}else{

			
			return $this->render(array(
			'number'           => $number,
			'product_id'       => $product_id,
			'product'          => $product,
			'customer_name'    => $customer_name,
			'customer_address' => $customer_address,
			'customer_street'  => $customer_street,
			'customer_zipcode' => $customer_zipcode,
			'customer_tel'     => $customer_tel,
			'customer_email'   => $customer_email,
			'tax_rate'         => $tax_rate,
			'price'            => $price
			
		));
		}
	}

	public function postAction()
	{	
		if(!$this->request->isPost()){
			$this->forward404();
		}
		
		$customer_name    = $this->request->getPost('customer_name');
		$customer_address = $this->request->getPost('customer_address');
		$customer_street  = $this->request->getPost('customer_street');
		$customer_zipcode = $this->request->getPost('customer_zipcode');
		$customer_tel     = $this->request->getPost('customer_tel');
		$customer_email   = $this->request->getPost('customer_email');
		$product_id       = $this->request->getPost('product_id');
		$product          = $this->db_manager->get('product')->fetchByProductId($product_id);
		$tax_rate         = $this->request->getPost('tax_rate');
		$number           = $this->request->getPost('number');
		$price            = $this->request->getPost('price');
		$errors           = [];

		if(!strlen($customer_name)){
			$errors[]      = 'お名前を入力してください';
		}else if(mb_strlen($customer_name) > 50){
			$errors[]      = 'お名前は50文字以内で入力してください';
			$customer_name ='';
		}

		if(!strlen($customer_address)){
			$errors[]         = '住所を入力してください';
		}else if(mb_strlen($customer_address) > 50){
			$errors[]         = '住所は50文字以内で入力してください';
			$customer_address ='';
		}

		if(!strlen($customer_street)){
			$errors[]        = '番地を入力してください';
		}else if(mb_strlen($customer_street) > 50){
			$errors[]        = '番地は50文字以内で入力してください';
			$customer_street ='';
		}

		if(!strlen($customer_zipcode)){
			$errors[]         = '住所番号を入力してください';
		}else if(ctype_digit($customer_zipcode) === FALSE ){
			$errors[]         = '住所番号は-無し半角数字で入力してください';
		}else if(mb_strlen($customer_zipcode) != 7){
			$errors[]         = '住所番号は7桁で入力してください';
			$customer_zipcode ='';
		}

		if(!strlen($customer_tel)){
			$errors[]     = '電話番号を入力してください';
		}else if(ctype_digit($customer_tel) === FALSE ){
			$errors[]     = '電話番号は-無し半角数字で入力してください';
		}else if(mb_strlen($customer_tel) > 12){
			$errors[]     = '電話番号は12桁以下で入力してください';
			$customer_tel = '';
		}

		if(!strlen($customer_email)){
			$errors[]       = 'メールアドレスを入力してください';
		}else if(mb_strlen($customer_email) > 50){
			$errors[]       = 'メールアドレスは50文字以内で入力してください';
			$customer_email = '';
		}

		if(ctype_digit($price) === FALSE ){
			$errors[] = '値段は半角数字で入力してください1';
		}

		if(ctype_digit($number) === FALSE ){
			$errors[] = '値段は半角数字で入力してください2';
		}

		if($tax_rate === FALSE ){
			$errors[] = '値段は半角数字で入力してください3';
		}

		
		if(count($errors) !== 0){
		
			$this->forward404();
		
		}
		$this->db_manager->get('order')->insertOrder($customer_name,$customer_address,$customer_street,$customer_zipcode,
		$customer_tel,$customer_email,$product_id,$price,$tax_rate,$number);

		return $this->redirect('/finish');
		
	}
	
	public function finishAction(){
		return $this->render(array());
	}

	public function insertcartAction(){
		if(!$this->session->isAuthenticated()){
			return $this->redirect('/customer/signin');
		}

		$path = $this->request->getPost('path');
		$product_id = $this->request->getPost('product_id');
		$customer = $this->session->get('customer');
		$amount = $this->request->getPost('amount');
	    if($this->db_manager->get('cart')->isNotRegisted($customer['customer_id'],$product_id)){
		   $this->db_manager->get('cart')->insertCart($customer['customer_id'],$product_id,$amount);
	    }

	   
		return $this->redirect('/mypage/'.$customer['customer_name'].'/purchase');
	}

	public function deletecartAction(){
		$cart_id = $this->request->getPost('cart_id');
		$customer = $this->session->get('customer');
		$path = $this->request->getPost('path');
		var_dump($customer);
	    if($this->db_manager->get('cart')->isRegisted($cart_id)){
		   $this->db_manager->get('cart')->deleteCart($cart_id);
	    }
		
		return $this->redirect('/mypage/'.$customer['customer_name'].$path);
	}
	
	public function purchaseAction(){
		if(!$this->session->isAuthenticated()){
			return $this->redirect('/customer/signin');
		}
		$product_id = $this->request->getPost('product_id');
		$customer = $this->session->get('customer');
	    if($this->db_manager->get('cart')->isNotRegisted($customer['customer_id'],$product_id)){
		   $this->db_manager->get('cart')->insertCart($customer['customer_id'],$product_id);
	    }
		
		return $this->redirect('/mypage/'.$customer['customer_name'].'/purchase');
	}


}
<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);

class MypageController extends Controller
{

	public function mainAction(){
		if(!$this->session->get('customer')){
			$this->session->clear();
			$this->session->setAuthenticated(false);
		}
		if(!$this->session->isAuthenticated()){
			return $this->redirect('/customer/signin');
		}

		$customer = $this->session->get('customer');
		if(!$customer['customer_id']){
			$this->redirect('/customer/signin');
		}

		$customer_name = $customer['customer_name'];
		$customer      = $this->db_manager->get('customer')->fetchByUserName($customer_name);
		$this->session->set('customer',$customer);

		$customer_name    = $customer['customer_name'];
		$customer_address = $customer['customer_address'];
		$customer_zipcode = $customer['customer_zipcode'];
		$customer_street  = $customer['customer_street'];
		$customer_tel     = $customer['customer_tel'];
		$customer_email   = $customer['customer_email'];
		$customer_id      = $customer['customer_id'];

  		
		$errors = $this->validetion($customer_id,$customer_name,$customer_address,$customer_street,$customer_zipcode,$customer_tel,$customer_email);
		return $this->render(array(
			'customer'  => $customer,
			'errors'    => $errors,

		));
	}

	public function editAction(){
		if(!$this->session->get('customer')){
			$this->session->clear();
			$this->session->setAuthenticated(false);
		}
		if(!$this->session->isAuthenticated()){
			return $this->redirect('/customer/signin');
		}
		$customer = $this->session->get('customer');

		$customer_id = $customer['customer_id'];
		
		if($this ->request->isPost()){
			$customer_name    = $this->request->getPost('customer_name');
			$customer_address = $this->request->getPost('customer_address');
			$customer_street  = $this->request->getPost('customer_street');
			$customer_zipcode = $this->request->getPost('customer_zipcode');
			$customer_tel     = $this->request->getPost('customer_tel');
			$customer_email   = $this->request->getPost('customer_email');
			$errors           = $this->validetion($customer_id,$customer_name,$customer_address,$customer_street,$customer_zipcode,$customer_tel,$customer_email);
		if(count($errors) == 0){
			$this->db_manager->get('customer')->update($customer_name,$customer_address,$customer_street,$customer_zipcode,
			$customer_tel,$customer_email,$customer_id);
		}


			return $this->render(array(
			'customer'         => $customer,
			'errors'           => $errors,
			'customer_name'    => $customer_name,
			'customer_address' => $customer_address,
			'customer_street'  => $customer_street,
			'customer_zipcode' => $customer_zipcode,
			'customer_tel'     => $customer_tel,
			'customer_email'   => $customer_email,
		));
		}

		$customer_name    = $customer['customer_name'];
		$customer_address = $customer['customer_address'];
		$customer_zipcode = $customer['customer_zipcode'];
		$customer_street  = $customer['customer_street'];
		$customer_tel     = $customer['customer_tel'];
		$customer_email   = $customer['customer_email'];
		$customer_id      = $customer['customer_id'];


		$errors = $this->validetion($customer_id,$customer_name,$customer_address,$customer_street,$customer_zipcode,$customer_tel,$customer_email);
		return $this->render(array(
			'customer'         => $customer,
			'errors'           => $errors,
			'customer_name'    => $customer_name,
			'customer_address' => $customer_address,
			'customer_street'  => $customer_street,
			'customer_zipcode' => $customer_zipcode,
			'customer_tel'     => $customer_tel,
			'customer_email'   => $customer_email,
		));
	}

	public function cartAction(){
		$cart_items  = [];
		$customer    = $this->session->get('customer');
		$cart_items  = $this->db_manager->get('cart')->fetchByCustomer_id($customer['customer_id']);

		return $this->render(array(
			'customer'   => $customer,
			'cart_items' => $cart_items,
		));
	}

	public function orderdAction(){
		$customer           = $this->session->get('customer');
		$customer_id        = $customer['customer_id'];
		$orderd_list        = $this->db_manager->get('order')->fetchAllByCustomerId($customer_id);
		$orderd_detail_list = [];

		foreach($orderd_list as $orderd){
			$orders_id            = $orderd['id'];
			$orderd_details       = $this->db_manager->get('order_details')->fetchAllByOrderdId($orders_id);
			$orderd_detail_list[] =  $orderd_details;
		}

		return $this->render(array(
			'customer'           => $customer,
			'orderd_list'        => $orderd_list,
			'orderd_detail_list' => $orderd_detail_list
		));
	}

	public function purchaseAction(){
		$customer    = $this->session->get('customer');
		$cart_items  = $this->db_manager->get('cart')->fetchByCustomer_id($customer['customer_id']);
		if(count($cart_items) == 0){
			$this ->redirect('/mypage/'.$customer['customer_name'].'/cart');
		}

		$sum_price = 0;
		foreach($cart_items as $item){
			$sum_price = $sum_price  + $item['price'] * $item['amount'];
		}
		return $this->render(
		array(
			'customer'   => $customer,
			'cart_items' => $cart_items,
			'sum_price'  => $sum_price,
		));
	}

	public function purchase_confAction(){
		$customer    = $this->session->get('customer');
		$cart_items  = $this->db_manager->get('cart')->fetchByCustomer_id($customer['customer_id']);
		if(count($cart_items) == 0){
			$this ->redirect('/mypage/'.$customer['customer_name'].'/purchase');
		}

		$sum_price = 0;
		foreach($cart_items as $item){
			$sum_price = $sum_price  + $item['price'];
		}
		return $this->render(
		array(
			'customer'   => $customer,
			'cart_items' => $cart_items,
			'sum_price'  => $sum_price,
		));
	}

	public function address_confAction(){
		if(!$this->session->get('customer')){
			$this->session->clear();
			$this->session->setAuthenticated(false);
		}

		if(!$this->session->isAuthenticated()){
			return $this->redirect('/customer/signin');
		}
		$customer = $this->session->get('customer');
		
		return $this->render(
		array(
			'customer'   => $customer,
			
		));
	}
	public function order_confAction(){
		$customer      = $this->session->get('customer');
		$customer_name = $customer['customer_name'];
		$customer      = $this->db_manager->get('customer')->fetchByUserName($customer_name);
		$cart_items    = $this->db_manager->get('cart')->fetchByCustomer_id($customer['customer_id']);
		$now_tax_rate  = $this->db_manager->get('tax_rate')->now_tax_rate();
		$tax_rate      = $now_tax_rate['tax_rate'];
		$sum_price     = 0;

		if(count($cart_items)== 0){
			$this->redirect('/errorpage');
		}


		$customer_address = $customer['customer_address'];
		$customer_zipcode = $customer['customer_zipcode'];
		$customer_street  = $customer['customer_street'];
		$customer_tel     = $customer['customer_tel'];
		$customer_email   = $customer['customer_email'];
		$customer_id      = $customer['customer_id'];

		foreach($cart_items as $item){
			$sum_price = $sum_price  + $item['price'] * $item['amount'];
		}
		$tax_price    = $sum_price * $tax_rate;
		$in_tax_Price = $sum_price + $tax_price;
		$price        = $in_tax_Price;

		if($this->request->isPost()){
				$orders = $this->db_manager->get('order')->insertOrderAndGetId(
					$customer_id,$customer_name,$customer_address,$customer_street
					,$customer_zipcode,$customer_tel,$customer_email,$price,$tax_rate);
				foreach($cart_items as $item){
					$orders_id     = $orders['id'];
					$product_id    = $item['product_id'];
					$amount        = $item['amount'];
					$product_price = $item['price'];
					$number        = $amount;
 					$this->db_manager->get('order_details')->insertOrderDetail($product_id
 						,$amount,$product_price,$orders_id);
 			     	$number = $amount;
 					$this->db_manager->get('product')->reduce($product_id,$number);
				}
				$this->db_manager->get('order_details')->updateByCustomerID($customer_id,$orders_id);
			

				return $this->redirect('/mypage/'.$customer['customer_name'].'/order_finish');
			
			}

		return $this->render(array(
			'customer'     => $customer,
			'cart_items'   => $cart_items,
			'sum_price'    => $sum_price,
			'tax_price'    =>$tax_price,
			'in_tax_Price' =>$in_tax_Price
		));
	}
	public function order_finishAction(){
		$customer    = $this->session->get('customer');
		return $this->render( array('customer' => $customer ));
	}

	public function cart_changeAction(){
		$customer      = $this->session->get('customer');
		$amount        = $this->request->getPost('amount');
		$cart_id       = $this->request->getPost('cart_id');
		$this->db_manager->get('cart')->cartAmoutChage($amount,$cart_id);

		return $this->redirect('/mypage/'.$customer['customer_name'].'/purchase');
	}


	function validetion($customer_id,$customer_name,$customer_address,$customer_street,$customer_zipcode,$customer_tel,$customer_email){
		$errors = [];
        if(!strlen($customer_id)){
        	$errors[] = "";
        }

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

		return $errors;
	}

 	function mailTo($customer_email){
 	
	 }

	
}
<?php
class OrderController extends Controller
{
	public function orderlistAction()
	{	
		
		$orders      = $this->db_manager->get('order')->fetchAllOrderList();
		return $this->render(array(
			'orders' => $orders,
		));
	}

	public function detailAction(){
		$id    = $this->request->getPost('id');
		$order = $this->db_manager->get('order')->fetchById($id);

		return $this->render(array(
			'id'    => $id,
			'order' => $order,
		));
	}

	public function editAction(){
		
		if(!$this->session->isAuthenticated()){
			return $this->redirect('/account/signin');
		}

		if(!$this->request->isPost()){
			$id               = $this->request->getGet('id');
			$order            = $this->db_manager->get('order')->fetchById($id);
			$customer_name    = $order['customer_name'];
			$customer_address = $order['customer_address'];
			$customer_street  = $order['customer_street'];
			$customer_zipcode = $order['customer_zipcode'];
			$customer_tel     = $order['customer_tel'];
			$customer_email   = $order['customer_email'];
			$product_id       = $order['product_id'];
			$price            = $order['price'];
			$tax_rate         = $order['tax_rate'];
			$updated_at       = $order['updated_at'];	
			$number           = $order['number'];
		}else{
			$id               = $this->request->getPost('id');
			$order            = $this->db_manager->get('order')->fetchById($id);
			$customer_name    = $this->request->getPost('customer_name');
			$customer_address = $this->request->getPost('customer_address');
			$customer_street  = $this->request->getPost('customer_street');
			$customer_zipcode = $this->request->getPost('customer_zipcode');
			$customer_tel     = $this->request->getPost('customer_tel');
			$customer_email   = $this->request->getPost('customer_email');
			$product_id       = $this->request->getPost('product_id');
			$price            = $this->request->getPost('price');
			$tax_rate         = $this->request->getPost('tax_rate');
			$delite           = $this->request->getPost('delite');
			$updated_at       = $order['updated_at'];	
			$number           = $this->request->getPost('number');
		}

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
		}else if(ctype_digit($customer_zipcode) === FALSE ){
			$errors[]         = '住所番号は-無し半角数字で入力してください';
		}else if(mb_strlen($customer_zipcode) != 7){
			$errors[]         = '住所番号は7桁で入力してください';
			$customer_zipcode = '';
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


		if($tax_rate === FALSE ){
			$errors[] = '値段は半角数字で入力してください3';
		}

		if(isset($delite)){
			$this->db_manager->get('order')->delete($id);
			return $this->redirect('/admin/order');
		}
		if(count($errors) == 0){
			$this->db_manager->get('Order')->edit($customer_name,$customer_address,$customer_street,$customer_zipcode,
			$customer_tel,$customer_email,$product_id,$price,$tax_rate,$id,$number);

		}
		return $this->render(array(
			'errors'           => $errors,
			'id'               => $id,
			'order'            => $order,
			'customer_name'    => $customer_name,
			'customer_address' => $customer_address,
			'customer_street'  => $customer_street,
			'customer_zipcode' => $customer_zipcode,
			'customer_tel'     => $customer_tel,
			'customer_email'   => $customer_email,
			'product_id'       => $product_id,
			'price'            => $price,
			'tax_rate'         => $tax_rate,
			'updated_at'       => $updated_at,
			'number'           => $number,
		));
	}
	

}
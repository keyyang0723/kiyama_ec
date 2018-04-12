<?php
class OrderController extends Controller
{
	public function orderlistAction()
	{	
		
		$orders = $this->db_manager->get('order')->fetchAllOrderList();
		return $this->render(array(
			'orders' => $orders,
		));
	}

	public function detailAction(){
		$id = $this->request->getPost('id');
		$order = $this->db_manager->get('order')->fetchById($id);

		return $this->render(array(
			'id'    =>$id,
			'order'=>$order,
		));
	}

	public function editAction(){
		if(!$this->request->isPost()){
			$id = $this->request->getGet('id');
			$order = $this->db_manager->get('order')->fetchById($id);
			$customer_name = $order['customer_name'];
			$customer_address = $order['customer_address'];
			$customer_street = $order['customer_street'];
			$customer_zipcode = $order['customer_zipcode'];
			$customer_tel = $order['customer_tel'];
			$customer_email = $order['customer_email'];
			$product_id = $order['product_id'];
			$price = $order['price'];
			$tax_rate = $order['tax_rate'];
			$updated_at = $order['updated_at'];	
		}else{
			$id = $this->request->getPost('id');
			$order = $this->db_manager->get('order')->fetchById($id);
			$customer_name = $this->request->getPost('customer_name');
			$customer_address = $this->request->getPost('customer_address');
			$customer_street = $this->request->getPost('customer_street');
			$customer_zipcode = $this->request->getPost('customer_zipcode');
			$customer_tel = $this->request->getPost('customer_tel');
			$customer_email = $this->request->getPost('customer_email');
			$product_id = $this->request->getPost('product_id');
			$price = $this->request->getPost('price');
			$tax_rate = $this->request->getPost('tax_rate');
			$updated_at = $order['updated_at'];	
		}



		$delite = $this->request->getPost('delite');
		if(isset($delite)){
			$this->db_manager->get('order')->delete($id);
			return $this->redirect('/order');
		}
		$this->db_manager->get('Order')->edit($customer_name,$customer_address,$customer_street,$customer_zipcode,
		$customer_tel,$customer_email,$product_id,$price,$tax_rate,$id);
		return $this->render(array(
			'id'    =>$id,
			'order'=>$order,
			'customer_name'=>$customer_name,
			'customer_address' =>$customer_address,
			'customer_street' =>$customer_street,
			'customer_zipcode' =>$customer_zipcode,
			'customer_tel' =>$customer_tel,
			'customer_email' =>$customer_email,
			'product_id' =>$product_id,
			'price' =>$price,
			'tax_rate' =>$tax_rate,
			'updated_at' => $updated_at,
		));
	}
}
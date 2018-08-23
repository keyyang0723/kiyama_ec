<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);

class MypageController extends Controller
{
	public function mainAction(){
		$customer = $this->session->get('customer');
		return $this->render(array(
			'customer' => $customer
		));
	}

	public function cartAction(){
		$cart_items = [];
		$customer = $this->session->get('customer');
		$cart_items  = $this->db_manager->get('cart')->fetchByCustomer_id($customer['customer_id']);

		return $this->render(array(
			'customer'   => $customer,
			'cart_items' => $cart_items,
		));
	}

	public function orderdAction(){
		return $this->render();
	}
}
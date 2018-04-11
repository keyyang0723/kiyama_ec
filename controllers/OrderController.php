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

	public function confAction()
	{
		return $this->render(array(
		));
	}
}
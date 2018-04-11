<?php
class FrontController extends Controller
{
	public function frontAction()
	{
		$products =$this->db_manager->get('product')->fetchAllProduct();

		return $this->render(array(
			'products'=>$products,
		));	

	}

	public function formAction()
	{	
		
		
		// $form = $this->request->getGet('form');
		// $_SESSION['form']=$form;

		if(!$this->request->isPost()){
			$id = $this->request->getGet('id');
			$product = $this->db_manager->get('product')->fetchById($id);
			$_SESSION['product'] = $product;

			if(isset($_SESSION['customer_name'])){
				$customer_name = $_SESSION['customer_name'] ;
			}else{
				$customer_name = '';
			}
			if(isset($_SESSION['customer_address'])){
				$customer_address = $_SESSION['customer_address'];
			}else{
				$customer_address = '';
			}
			if(isset($_SESSION['customer_street'])){
				$customer_street= $_SESSION['customer_street'];
			}else{
				$customer_street = '';
			}
			if(isset($_SESSION['customer_zipcode'])){
				$customer_zipcode = $_SESSION['customer_zipcode'];
			}else{
				$customer_zipcode = '';
			}
			if(isset($_SESSION['customer_tel'])){
				$customer_tel = $_SESSION['customer_tel'];
			}else{
				$customer_tel = '';
			}
			if(isset($_SESSION['customer_email'])){
				$customer_email = $_SESSION['customer_email'];
			}else{
				$customer_email = '';
			}

				return $this->render(array(
				'id'	=>$id,
				'product'=>$product,
				'customer_name' =>$customer_name,
				'customer_address'=>$customer_address,
				'customer_street'=>$customer_street,
				'customer_zipcode' =>$customer_zipcode,
				'customer_tel'=>$customer_tel,
				'customer_email'=>$customer_email,
			));
		}else{
			$product =$_SESSION['product'];
		}
		
		// if(isset($_SESSION['customer_name'])){
		// 	$customer_name = $_SESSION['customer_name'] ;
		// }
		// if(isset($_SESSION['customer_address'])){
		// 	$customer_address = $_SESSION['customer_address'];
		// }
		// if(isset($_SESSION['customer_street'])){
		// 	$customer_street= $_SESSION['customer_street'];
		// }
		// if(isset($_SESSION['customer_zipcode'])){
		// 	$customer_zipcode = $_SESSION['customer_zipcode'];
		// }
		// if(isset($_SESSION['customer_tel'])){
		// 	$customer_tel = $_SESSION['customer_tel'];
		// }
		// if(isset($_SESSION['customer_email'])){
		// 	$customer_email = $_SESSION['customer_email'];
		// }


		$customer_name = $this->request->getPost('customer_name');
		$customer_address = $this->request->getPost('customer_address');
		$customer_street= $this->request->getPost('customer_street');
		$customer_zipcode = $this->request->getPost('customer_zipcode');
		$customer_tel = $this->request->getPost('customer_tel');
		$customer_email = $this->request->getPost('customer_email');
		


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

		$_SESSION['product'] = $product;
		$_SESSION['customer_name'] =$customer_name;
		$_SESSION['customer_address']=$customer_address;
		$_SESSION['customer_street']=$customer_street;
		$_SESSION['customer_zipcode'] =$customer_zipcode;
		$_SESSION['customer_tel']=$customer_tel;
		$_SESSION['customer_email']=$customer_email;
		$_SESSION['tax_rate']="1.08";


		if(count($errors)===0){
			
			return $this->redirect('/front/conf');
		}
		
		
		return $this->render(array(
			'product'=>$product,
			'customer_name' =>$customer_name,
			'customer_address'=>$customer_address,
			'customer_street'=>$customer_street,
			'customer_zipcode' =>$customer_zipcode,
			'customer_tel'=>$customer_tel,
			'customer_email'=>$customer_email,
			'errors' =>$errors,
			));
	}

	public function confAction()
	{	
		$customer_name = $_SESSION['customer_name'] ;
		$customer_address = $_SESSION['customer_address'];
		$customer_street= $_SESSION['customer_street'];
		$customer_zipcode = $_SESSION['customer_zipcode'];
		$customer_tel = $_SESSION['customer_tel'];
		$customer_email = $_SESSION['customer_email'];
		$product_id = $_SESSION['product']['id'];
		$price = $_SESSION['product']['price'];
		$tax_rate = $_SESSION['tax_rate'];
		if(!$this->request->isPost()){
		
		return $this->render(array(
		));
		}else{

		// 	$this->db_manager->get('Order')->insertOrder($customer_name,$customer_address,$customer_street,$customer_zipcode,
		// $customer_tel,$customer_email,$product_id,$price,$tax_rate);
			return $this->redirect('/front/finish');
		}
	}

	public function finishAction()
	{

		$customer_name = $_SESSION['customer_name'] ;
		$customer_address = $_SESSION['customer_address'];
		$customer_street= $_SESSION['customer_street'];
		$customer_zipcode = $_SESSION['customer_zipcode'];
		$customer_tel = $_SESSION['customer_tel'];
		$customer_email = $_SESSION['customer_email'];
		//session_destroy();
		return $this->render(array(
			
		));
	}


}
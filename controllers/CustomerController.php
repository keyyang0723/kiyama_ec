<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
//ユーザー用アカウントコントローラー
class CustomerController extends Controller{


	//登録
	public function signupAction(){
		return $this->render(array(
			'customer_name' => '',
			'password'  => '',
		 	'_token'    => $this->generateCsrfToken('customer/signup'),
		));
	}

	//ログイン
	public function signinAction(){
		if($this->session->isAuthenticated()){
			return $this->redirect('/');
		}

		return $this->render(array(
			'customer_name'  => '',
			'password'   => '',
			'_token'     => $this->generateCsrfToken('customer/signin'),
		));
	}


	public function authenticateAction()
	{
		if($this->session->isAuthenticated()){
			return $this->redirect('/');
		}

		if(!$this->request->isPost()){
			$this->forward404();
		}


		$token = $this->request->getPost('_token');
		if(!$this->checkCsrfToken('customer/signin',$token)){
			return $this->redirect('/customer/signin');
		}

		$customer_name = $this->request->getPost('customer_name');
		$password  = $this->request->getPost('password');
		$errors    = array();

		if(!strlen($customer_name)){
			$errors[] = 'ユーザIDを入力してください';
		}
		if(!strlen($password)){
			$errors[] = 'パスワードを入力してください';
		}

		if(count($errors) === 0){
			$user_repository = $this->db_manager->get('customer');
			$user            = $user_repository->fetchByUserName($customer_name);

			if(!$user  || !password_verify ( $password , $user['password'] )
			){
				$errors[] = 'ユーザIDかパスワードが不正です';
			}else{
				$this->session->setAuthenticated(true);
				$this->session->set('customer',$user);

				return $this->redirect('/');
			}
		}

		return $this->render(array(
			'customer_name' => $customer_name,
			'password'  => $password,
			'errors'    => $errors,
			'_token'    => $this->generateCsrfToken('account/signin'),
		),'signin');
	}


	//ログアウト
	public function signoutAction(){
		$this->session->clear();
		$this->session->setAuthenticated(false);

		return $this->redirect('/');
	}

	public function registerAction(){
		if(!$this ->request->isPost()){
			$this->forward404();
		}
	

		$token = $this->request->getPost('_token');
		if(!$this->checkCsrfToken('customer/signup',$token)){
			return $this->redirect('/customer/signup');
		}

		$customer_name = $this->request->getPost('customer_name');
		$password  = $this->request->getPost('password');
		$errors    = array();

		if(!strlen($customer_name)){
			$errors[] ='お名前を入力してください';
		}else if(!preg_match('/^\w{3,20}$/',$customer_name)){
			$errors[] ='お名前は半角英数字およびアンダースコアを３〜２０文字以内で入力してください';
		}else if(!$this->db_manager->get('Customer')->isUniqueUserName($customer_name)){
			$errors[]='そちらのお名前は既に使用されています';
		}

		if(!strlen($password)){
			$errors[] = 'パスワードを入力してください';
		}else if (4 > strlen($password)||strlen($password)>30){
			$errors[] = 'パスワードは4〜３０文字以内で入力してください';
		}

		if(count($errors)=== 0 ){
			$this->db_manager->get('customer')->insert($customer_name,$password);
			$this->session->setAuthenticated(true);

			$user = $this->db_manager->get('customer')->fetchByUserName($customer_name);
			$this->session->set('customer',$user);

			return $this->redirect('/');
		}

		return $this->render(array(
			'customer_name' => $customer_name,
			'password'      => $password,
			'errors'        => $errors,
			'_token'        => $this->generateCsrfToken('customer/signup'),
		),'signup');

	}

	public function indexAction(){
		return $this->render();
	}
}
<?php
class CategoryController extends Controller
{
	public function categoryAction()
	{
		if(!$this->session->isAuthenticated()){
			return $this->redirect('/account/signin');
		}
		$categories = $this->db_manager->get('category')->fetchAllCategories();
		return $this->render(array(
				'categories' => $categories,
				'name'       => '',));
	}

	public function addAction()
	{	
		if(!$this->session->isAuthenticated()){
			return $this->redirect('/account/signin');
		}

		if(!$this->request->isPost()){
			return $this->render(array(
			'name'   => '',));
		}

		$token  = $this->request->getPost('_token');
		$name   = $this->request->getPost('name');
		$errors = array();
		if(!strlen($name)){
			$errors[]='カテゴリを入力してください';
		}else if(mb_strlen($name) > 30){
			$errors[]='カテゴリは３０字以内で登録してください';
		}

		if(count($errors) === 0){
			$this->db_manager->get('category')->insert($name);
			return $this->redirect('/admin/category');
		}

		$categories = $this->db_manager->get('category')
			->fetchAllCategories();

			return $this->render(array(
				'errors'    => $errors,
				'categories'=> $categories,
				'name'      =>'',
				'_token'    =>$this->generateCsrfToken('/admincategory/add/post'),
			));

	}


	public function deleteAction()
	{	
		if(!$this->session->isAuthenticated()){
			return $this->redirect('/account/signin');
		}

		if(!$this->request->isPost()){
		$categories =$this->db_manager->get('category')->fetchAllCategories();
		return $this->render(array(
				'categories' => $categories,
				'id'         => '',));
		}

		$id = $this->request->getPost('id');
		$this->db_manager->get('Category')->delete($id);
		$categories = $this->db_manager->get('category')->fetchAllCategories();
		return $this->render(array(
				'categories' => $categories,
				'id'         => $id,
				));
	}
}
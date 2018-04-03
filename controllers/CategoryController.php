<?php
class CategoryController extends Controller
{
	public function categoryAction()
	{

		$categories =$this->db_manager->get('category')->fetchAllCategories();
		return $this->render(array(
				'categories' =>$categories,
				'name'  =>'',));
	}

	public function addAction()
	{
		if(!$this->request->isPost()){
			return $this->render(array(
			'name'   =>'',));
		}

		$token = $this->request->getPost('_token');
		// if(!$this->checkCsrfToken('category/post',$token)){
		// 	return $this->redirect('/');
		// }

		$name = $this->request->getPost('name');
		$errors = array();
		if(!strlen($name)){

			$errors[]='カテゴリを入力してください';
		}else if(mb_strlen($name) > 30){
			$errors[]='カテゴリは３０字以内で登録してください';
		}


		if(count($errors)===0){
			$this->db_manager->get('Category')->insert($name);

			return $this->redirect('/category');
		}

		$categories = $this->db_manager->get('category')
			->fetchAllCategories();

			return $this->render(array(
				'errors'  => $errors,
				'categories'=> $categories,
				'name'     =>'',
				'_token'  =>$this->generateCsrfToken('category/add/post'),
			));

	}


	public function deleteAction()
	{
		if(!$this->request->isPost()){

		$categories =$this->db_manager->get('category')->fetchAllCategories();
		return $this->render(array(
				'categories' =>$categories,
				'id'  =>'',));
		}

		$id = $this->request->getPost('id');
		$this->db_manager->get('Category')->delete($id);
		$categories =$this->db_manager->get('category')->fetchAllCategories();
		return $this->render(array(
				'categories' =>$categories,
				'id'         =>$id,
				));
	}
}
<?php

class ProductController extends Controller
{
	public function indexAction()
	{
		$products =$this->db_manager->get('product')->fetchAllProduct();

		return $this->render(array(
			'products'=>$products,
			'name'   =>'',
			'_token' =>$this->generateCsrfToken('product/post'),
		));	



	}


	public function registAction()
	{
		$products =$this->db_manager->get('product')->fetchAllProduct();
		$categories =$this->db_manager->get('category')->fetchAllCategories();
		if(!$this->request->isPost()){
		
		return $this->render(array(
			'products'=>$products,
			'name'   =>'',
			'description'=>'',
			'categories'=>$categories,
			'category_id'=>'',
			'price'       =>'',
			'image'	  =>'',
			'stock'	  =>'',
			'fname'  =>'',
			'_token' =>$this->generateCsrfToken('product/post'),
		));	
		}

		$name = $this->request->getPost('name');
		$description = $this->request->getPost('description');
		$price = $this->request->getPost('price');
		$stock = $this->request->getPost('stock');
		$category_id = $this->request->getPost('category_id');
		$image = $this->request->getPost('image');
		$body = $this->request->getPost('body');
		$tempfile = $_FILES['fname']['tmp_name'];

		$errors = array();
		if(!strlen($name)){
			$errors[]='商品名を入力してください';
		}else if(mb_strlen($name) > 50){
			$errors[]='商品名は50文字以内で入力してください';
			$name ='';
		}

		if(!strlen($description)){
			$errors[]='説明を入力してください';
		}else if(mb_strlen($description) > 200){
			$errors[]='説明は200文字以内で入力してください';
			$description ='';
		}
		if(!strlen($price)){
			$errors[]='値段を入力してください';
		}elseif(ctype_digit($price)=== FALSE ){
			$errors[]='値段は半角数字で入力してください';
		}else if(mb_strlen($price) > 10){
			$errors[]='値段は10桁以下で入力してください';
			$price ='';
		}

		if(!isset($category_id)){
			$errors[]='カテゴリを選択してください';
		}

		if(!strlen($stock)){
			$errors[]='個数を入力してください';
		}elseif(!ctype_digit($stock)){
			$errors[]='個数は半角数字で入力してください';
		}else if(mb_strlen($stock) > 10){
			$errors[]='商品名は10桁以内で入力してください';
			$stock ='';
		}

		if(!is_uploaded_file($tempfile)){
			$errors[]=  'ファイルをアップロードできません。画像を登録できませんでした。';
		}
		// if(!isset($image)){
		// 	$errors[]='画像を選択してください';
		// }


		if(count($errors)===0){
			$imageuser = $_SESSION['Admin']['user_name'];
			$imagetime = date('H:i:s');
			$image_name = 'image/'.sha1($imageuser.$imagetime).'.jpg';
			move_uploaded_file($tempfile , $image_name);

			$user = $this->session->get('user');
			$this->db_manager->get('Product')->insert($name,$description,$category_id,$price,$image,$stock,$image_name);
			$product =$this->db_manager->get('product')->fetchByName($name);
			$_SESSION['product'] = $product;

			return $this->redirect('/admin');
		}

		$user = $this->session->get('admin');
		$status = $this->db_manager->get('product')
			->fetchAllProduct();

			return $this->render(array(
				'errors'  => $errors,
				'products'=>$products,
				'name'   =>$name,
				'description'=>$description,
				'categories'=>$categories,
				'category_id'=>$category_id,
				'price'       =>$price,
				'image'	  =>$image,
				'stock'	  =>$stock,
				'_token' =>$this->generateCsrfToken('product/post'),
			));

	}

	public function detailAction()
	{
		$name = $this->request->getPost('name');
		$product = $this->db_manager->get('Product')->fetchByName($name);

		return $this->render(array(
			'name' =>$name,
			'product' =>$product));
	}

	public function editAction()
	{
		$categories =$this->db_manager->get('category')->fetchAllCategories();

		$name = $this->request->getPost('name');
		$description = $this->request->getPost('description');
		$price = $this->request->getPost('price');
		$stock = $this->request->getPost('stock');
		$category_id = $this->request->getPost('category_id');
		$image = $this->request->getPost('image');
		$id = $this->request->getPost('id');
		$is_displayed = $this->request->getPost('is_displayed');
		$delite = $this ->request->getPost('delite');

		$errors = array();
		if(!strlen($name)){
			$errors[]='商品名を入力してください';
		}else if(mb_strlen($name) > 50){
			$errors[]='商品名は50文字以内で入力してください';
			$name ='';
		}

		if(!strlen($description)){
			$errors[]='説明を入力してください';
		}else if(mb_strlen($description) > 200){
			$errors[]='説明は200文字以内で入力してください';
			$description ='';
		}
		if(!strlen($price)){
			$errors[]='値段を入力してください';
		}elseif(ctype_digit($price)=== FALSE ){
			$errors[]='値段は半角数字で入力してください';
		}else if(mb_strlen($price) > 10){
			$errors[]='値段は10桁以下で入力してください';
			$price ='';
		}

		if(!isset($category_id)){
			$errors[]='カテゴリを選択してください';
		}

		if(!strlen($stock)){
			$errors[]='個数を入力してください';
		}elseif(!ctype_digit($stock)){
			$errors[]='個数は半角数字で入力してください';
		}else if(mb_strlen($stock) > 10){
			$errors[]='商品名は10桁以内で入力してください';
			$stock ='';
		}

		if(!isset($image)){
			$errors[]='画像を選択してください';
		}

		if(isset($delite)){
			$this->db_manager->get('product')->delete($id);
			return $this->redirect('/admin');
		}

		if(count($errors)===0){
			
			$this->db_manager->get('Product')->edit($name,$description,$category_id,$price,$image,$stock,$is_displayed,$id);
			return $this->render(array(
				'errors'  => $errors,
				'name'   =>$name,
				'description'=>$description,
				'categories'=>$categories,
				'category_id'=>$category_id,
				'price'       =>$price,
				'image'	  =>$image,
				'stock'	  =>$stock,
				'is_displayed' =>$is_displayed,
				'id'  	 =>$id,
			));
		}

			return $this->render(array(
				'errors'  => $errors,
				'products'=>$products,
				'name'   =>$name,
				'description'=>$description,
				'categories'=>$categories,
				'category_id'=>$category_id,
				'price'       =>$price,
				'image'	  =>$image,
				'stock'	  =>$stock,
				'is_displayed' =>$is_displayed,
				'id'  	 =>$id,
			));
	}

	public function imageAction(){
	$tempfile = $_FILES['fname']['tmp_name'];
	//$filename = 'gazou.php/' .$_SESSION['product']['id'].'.jpg';
	$filename = 'image/'.$_SESSION['product']['id'].'.jpg';
	$comment = "";

	if (is_uploaded_file($tempfile)) {
	    if ( move_uploaded_file($tempfile , $filename )) {
		$comment = "画像をアップロードしました。";
	    } else {
	        $comment =  "ファイルをアップロードできません。画像を登録できませんでした。";
	    }
	} else {
	    $comment =  "ファイルが選択されていません。画像を登録できませんでした。";
	} 
    return $this->render(array(
    	'comment' => $comment,

    ));
}
	public function uploadAction(){

    return $this->render(array(
    	'fname'=>'',

    ));
}
	public function gazouAction(){
		return $this->render(array());
	}


}
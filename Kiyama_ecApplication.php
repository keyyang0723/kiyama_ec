<?php 

class Kiyama_ecApplication extends Application
{
	protected $login_action = array('account','signin');

	public function getRootDir()
	{
	return dirname(__FILE__);
	}

 
	protected function registerRoutes()
	{
		return array(

				'/'
				 =>array('controller'=>'product','action'=>'index'),
				 '/product/regist'
				 =>array('controller'=>'product','action'=>'regist'),
				 '/product/regist/post'
				 =>array('controller'=>'product','action'=>'regist'),
				 '/product/:name'
				 =>array('controller'=>'product','action'=>'detail'),
				 '/product/:name/edit'
				 =>array('controller'=>'product','action'=>'edit'),

				 '/upload'
				  =>array('controller'=>'product','action'=>'gazou'),
				 '/image'
				 =>array('controller'=>'product','action'=>'image'),

				 '/category'
				 =>array('controller'=>'category','action'=>'category'),
				 '/category/:action'
				 =>array('controller'=>'category','action'=>':action'),
				 '/category/add/post'
				 =>array('controller'=>'category','action'=>'add'),
				 '/category/delete/post'
				 =>array('controller'=>'category','action'=>'delete'),

				 '/order'
				 =>array('controller'=>'order','action'=>'orderlist'),
				 '/order/:id'
				 =>array('controller'=>'order','action'=>'detail'),
				  '/order/:id/edit'
				 =>array('controller'=>'order','action'=>'edit'),

				
				'/account'
				 =>array('controller' =>'account','action' =>'index'),
				 '/account/:action'
				 =>array('controller'=> 'account'),

				 '/front'
				 =>array('controller' =>'front','action'=>'front'),
				  '/front/conf'
				 =>array('controller' =>'front','action'=>'conf'),
				 '/front/finish'
				 =>array('controller' =>'front','action'=>'finish'),
				 '/front/:name'
				 =>array('controller' =>'front','action'=>'form'),
				 '/front/:name/detail'
				 =>array('controller' =>'front','action'=>'detail'),
				


		);
	}

	protected function configure()
	{
		$this->db_manager->connect('maseter',array(
		    'dsn'      =>'mysql:dbname=kiyama_ec;host=127.0.0.1',
		    'user'     =>'root',
		    'password'  =>'root',
		 ));
	}
}
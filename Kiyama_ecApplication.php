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

				'/admin'
				 =>array('controller'=>'product','action'=>'index'),
				'/admin/search'
				 =>array('controller'=>'product','action'=>'index'),
				 '/admin/product/regist'
				 =>array('controller'=>'product','action'=>'edit'),
				 '/admin/product/edit'
				 =>array('controller'=>'product','action'=>'edit'),
				 '/admin/product/:id'
				 =>array('controller'=>'product','action'=>'detail'),
				 '/admin/product/:name/edit'
				 =>array('controller'=>'product','action'=>'edit'),
				 '/admin/errorpage'
				 =>array('controller'=>'product','action'=>'errorpage'),

				 '/admin/upload'
				  =>array('controller'=>'product','action'=>'upload'),
				 '/admin/image'
				 =>array('controller'=>'product','action'=>'image'),

				 '/admin/category'
				 =>array('controller'=>'category','action'=>'category'),
				 '/admin/category/:action'
				 =>array('controller'=>'category','action'=>':action'),
				 '/admin/category/add/post'
				 =>array('controller'=>'category','action'=>'add'),
				 '/admin/category/delete/post'
				 =>array('controller'=>'category','action'=>'delete'),

				 '/admin/order'
				 =>array('controller'=>'order','action'=>'orderlist'),
				 '/admin/order/:id'
				 =>array('controller'=>'order','action'=>'detail'),
				  '/admin/order/:id/edit'
				 =>array('controller'=>'order','action'=>'edit'),

				
				'/account'
				 =>array('controller' =>'account','action' =>'index'),
				 '/account/:action'
				 =>array('controller'=> 'account'),

				 '/'
				 =>array('controller' =>'front','action'=>'front'),
				 '/errorpage'
				 =>array('controller' =>'front','action'=>'errorpage'),
				  '/conf'
				 =>array('controller' =>'front','action'=>'conf'),
				 '/conf/post'
				 =>array('controller' =>'front','action'=>'post'),
				 '/finish'
				 =>array('controller' =>'front','action'=>'finish'),
				 '/search'
				 =>array('controller' =>'front','action'=>'front'),
				 '/form'
				 =>array('controller' =>'front','action'=>'form'),
				 // '/:name'
				 // =>array('controller' =>'front','action'=>'form'),
				 '/:name/detail'
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
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
				=>array('controller'=>'status','action'=>'index'),
			'/status/post'
				=>array('controller'=>'status','action'=>'post'),

			'user/:user_name'
				=> array('controller' => 'status','action' => 'user'),

			'user/:user_name/status/:id'
				=> array('controller' => 'status','action' => 'show'),
							
			'/account'
				=>array('controller' => 'account','action'=>'index'),
			'/account/:action'
				=>array('controller' => 'account'),
			'/follow'
				=>array('controller' =>'account','action'=>'follow'),

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
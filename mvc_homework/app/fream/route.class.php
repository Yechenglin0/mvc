<?php
class route {
	private $method;
	private $request_conf;
	private $module;
	private $controller;
	private $action;
	private $path;

	public function __construct() {
		$this->request();
		$this->get_path();
		$this->get_conf();
		$this->new_controller();
	}
	public function request() {
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			$this->method = "POST";
			$this->request_conf = $_POST;
		} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
			$this->method = "GET";
			$this->request_conf = $_GET;
		}	
	}
	public function get_path() {
		$this->module = array_key_exists('m', $this->request_conf) ? $this->request_conf['m'] : "home";
		$this->controller = array_key_exists('c', $this->request_conf) ? $this->request_conf['c'] : "index";
		$this->action = array_key_exists('a', $this->request_conf) ? $this->request_conf['a'] : "index";
		$this->path = './'.$this->module.'/controller/'.$this->controller.'.class.php';
		echo $this->path;
	}
	public function new_controller()
	{
		$action = $this->action;
		require_once($this->path);
		$obj = new $this->controller();
		call_user_func_array(array($obj,$this->action), $this->request_conf);
	}
	public function get_conf() {
		unset($this->request_conf['m']);
		unset($this->request_conf['c']);
		unset($this->request_conf['a']);
		var_dump($this->request_conf);
	}
}
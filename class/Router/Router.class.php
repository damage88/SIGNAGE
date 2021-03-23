<?php 

class Router {

	private $url;
	private $routes = array();

	public function __construct($url){
		$this->url = $url; 
	}

	public function get($path, $callable){
		$route = new Route($path, $callable);
		$this->routes['GET'][] = $route;
	}

	public function post($path, $callable){
		$route = new Route($path, $callable);
		$this->routes['POST'][] = $route;
	}

	public function run(){
		if(!isset($this->route[$_SERVER['REQUEST_METHOD']])){
			throw new Exception('no routes matches');
			
		}
	}


}
<?php 
namespace core;

class Router
{
	protected $routes=[
	'GET'=>[],
	'POST'=>[]
	];

	public static function load($file)
	{
		$router=new static;
		require $file;
		return $router;
	}

	public function get($uri,$controller)
	{
		$this->routes['GET'][$uri]=$controller;
	}

	public function post($uri,$controller)
	{
		$this->routes['POST'][$uri]=$controller;
	}

	public function direct($uri,$requestType)
	{
		$params = [];
		foreach( $this->routes[$requestType] as $url=>$controller ){
			if( $url === '*' ){
				$checkRoute = true;
			}elseif( strpos($url, '{') === FALSE ){
				if( strcmp(strtolower($url), strtolower($uri)) === 0 ){
					$checkRoute = true;
				}else{
					continue;
				}
			}elseif( strpos($url, '}') === FALSE ){
				continue;
			}else{
				$routeParams 	= explode('/', $url);
				$requestParams 	= explode('/', $uri);

				if( count($routeParams) !== count($requestParams) ){
					continue;
				}

				foreach( $routeParams as $k => $rp ){
					if( preg_match('/^{\w+}$/',$rp) ){
						$params[] = $requestParams[$k];
					}
				}

				$checkRoute = true;
			}

			if( $checkRoute === true ){
				$this->callAction(
					explode('@',$controller)[0],explode('@',$controller)[1],$params
					);
				return;
			}else{
				continue;
			}
		}

		throw new Exception('No route definded for this URI.');
	}
	protected function callAction($controller,$action,$params)
	{
		$controller="app\\controllers\\{$controller}";
		$controller=new $controller;
		if(!method_exists($controller,$action)){
			throw new Exception(
				"{$controller} dose not respond to the {$action} action."
				);
		}else{
			call_user_func_array([$controller,$action], $params);
			return;
		}
	}
}
?>
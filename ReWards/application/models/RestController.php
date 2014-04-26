<?php

class Application_Model_RestController {
	
	public function __construct(){
		$this->_handleRouting();
	}
	
	public function _handleRouting(){

		$request = $this->getRequest();
		$path   = $request->getPathInfo();
		$params = $request->getParams();
		
		if ($request->getParam('method')){
			$method = strtolower($request->getParam('method'));
		}else{
			$method = strtolower($this->getRequest()->getMethod());
		}
		Zend_Registry::get('logger')->debug("API Request Method: {$method}");
		
	}
	
}
<?php

class Application_Model_RestController extends Zend_Rest_Controller {
	
	public function init(){
		$this->_helper->viewRenderer->setNoRender(true);
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
		
		//   /Controller/ -> use http method
		//   /Controller/:id -> use http method
		
		$pathComponents = explode( "/", trim( $path, "/"));
		$pathCount = count( $pathComponents );
		
		Zend_Registry::get('log')->debug("API Request Method: {$method}");
		Zend_Registry::get('log')->debug("API Request Components: " . print_r( $pathComponents, true ));
		
		if( $pathCount == 1 ){
			return $this->_forward($method);
		} elseif( $pathCount == 2 ) {
			$request->setParam("id", $pathComponents[1] );
			return $this->_forward($method);
		} elseif( $pathCount == 3 ) {
			$request->setParam("id", $pathComponents[1] );
			return $this->_forward( $pathComponents[2] );
		}
		
		return $this->_forward('index');
		
	}
	
	public function indexAction(){
		
	}
	
	public function getAction(){
		
	}
	
	public function postAction(){
		
	}
	
	public function putAction(){
		
	}
	
	public function deleteAction(){
		
	}
	
	public function headAction(){
		
	}
	
	
}
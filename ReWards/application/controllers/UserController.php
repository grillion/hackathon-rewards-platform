<?php

class UserController extends Application_Model_RestController
{

    public function indexAction()
    {
		echo "Index Action";
    }

    public function getAction(){
    	$id = $this->_getParam("id");
    	if( empty($id) ){
    		echo "ID Required";
    		return;
    	}
    	
    	$userModel = new Application_Model_Db_User();
    	$existingUser = $userModel->fetchRow( "id = '" . $id . "'" );
    	 
    	var_dump($existingUser);
    	die();
    	
    	return $this->getResponse()->setHeader('Content-type', 'application/json')
    	->setHttpResponseCode(200)
    	->appendBody( Zend_Json_Encoder::encode( $id ) );
    	
    }
    
    public function barcodeAction(){
    	$id = $this->_getParam("id");
    	if( empty($id) ){
    		echo "ID Required";
    		return;
    	}
    	
    	// Only the text to draw is required
    	$barcodeOptions = array(
    		'text' => $id,
    		"drawText" => false,
    		"factor" => 3
    	);
    	
    	// No required options
    	$rendererOptions = array();
    	
    	Zend_Barcode::factory(
    		'code39', 'image', $barcodeOptions, $rendererOptions
    	)->render();
    }
    
    public function postAction(){

    	$facebook_token = $this->_getParam("facebook_token");
    	if( empty( $facebook_token  ) ){
    		//error here
    	}
    	
    	$fbUser = json_decode( file_get_contents( "https://graph.facebook.com/me?access_token=" . $facebook_token ), true );
    	
    	$userInfo = array(
    		"firstname" => $fbUser['first_name'],
    		"lastname" => $fbUser['last_name'],
    		"facebook_id" => $fbUser['id']
    	);

    	$userModel = new Application_Model_Db_User();
    	$existingUser = $userModel->fetchRow( "facebook_id = '" . $fbUser['id'] . "'" );
    	
    	if( empty($existingUser ) ){
    		$id = $userModel->insert( $userInfo );
    		$newUser = $userModel->fetchRow( "id = '" . $id . "'" );
    		$userInfo = $newUser->toArray(); 
    	} else {
    		$userInfo = $existingUser->toArray();
    	}
    	
    	return $this->getResponse()->setHeader('Content-type', 'application/json')
    	->setHttpResponseCode(200)
    	->appendBody( Zend_Json_Encoder::encode( $userInfo ) );
    }

    
    public function putAction(){
    	
    }
    
    public function deleteAction(){
    	
    }
    
    public function headAction(){
    	
    }

}


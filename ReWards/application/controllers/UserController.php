<?php

class UserController extends Application_Model_RestController
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		$this->_helper->viewRenderer->setNoRender(true);
		echo "Index Action";
    }

    public function getAction(){
    	
    	$id = $this->_getParam("id");
    	
    	return $this->getResponse()->setHeader('Content-type', 'application/json')
    	->setHttpResponseCode(200)
    	->appendBody( Zend_Json_Encoder::encode( $id ) );
    	
    }
    
    public function postAction(){

    	$facebook_token = $this->_getParam("facebook_token");
    	
    	if( empty( $facebook_token  ) ){
    		//error here
    	}
    	
    	$response = array();
    	$response['facebook_token'] = $facebook_token;
    	
    	$fbUser = json_decode( file_get_contents( "https://graph.facebook.com/me?access_token=" . $facebook_token ), true );
    	
    	$newUser = array(
    		"firstname" => $fbUser['first_name'],
    		"lastname" => $fbUser['last_name'],
    		"facebook_id" => $fbUser['id']
    	);

    	$userModel = new Application_Model_Db_User();
    	$id = $userModel->insert( $newUser );
    	
    	return $this->getResponse()->setHeader('Content-type', 'application/json')
    	->setHttpResponseCode(200)
    	->appendBody( Zend_Json_Encoder::encode( $id ) );
    	
    }

    
    public function putAction(){
    	
    }
    
    public function deleteAction(){
    	
    }
    
    public function headAction(){
    	
    }

}


<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	public function _initConfig(){
		Zend_Registry::set('config', new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV));
		date_default_timezone_set(Zend_Registry::get('config')->phpSettings->default_timezone);
	}
	
	public function _initDB(){
		$resource = $this->getPluginResource('multidb');
		$resource->init();
		Zend_Registry::set('mysql_master', $resource->getDb('mysql_master'));
	}

}


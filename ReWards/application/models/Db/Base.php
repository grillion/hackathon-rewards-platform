<?php

    class Application_Model_Db_Base extends Zend_Db_Table_Abstract {

        public function __construct($options = array()){
            parent::__construct(Zend_Registry::get('mysql_master'));
        }

        public function getDbDate($timestamp = null){
            return new Zend_Db_Expr('NOW()');
        }
        
        public function update(array $data, $where){
            
            $valid_cols = $this->info(Zend_Db_Table_Abstract::COLS);
            foreach ($data as $column => $value){
            	if (!in_array($column, $valid_cols)){
            		unset($data[$column]);
            	}
            }
            
            return parent::update($data, $where);
            
        }
        
    }
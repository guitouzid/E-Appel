<?php
    defined('__FRAMEWORK3IL__') or die ('Accès Interdit');

    abstract class DataTable
    {
        protected $db;
        
        public function __construct() 
        {
            $app = Application::getApplication();
            $this->db = $app->getDb();
        }
    }
?>

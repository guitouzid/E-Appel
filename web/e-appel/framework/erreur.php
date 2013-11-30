<?php
    defined('__FRAMEWORK3IL__') or die ('Accès Interdit');
    
    class Erreur extends Exception
    {
        public function __construct($message) 
        {
            parent::__construct($message);
        }
        
        public function __toString() 
        {
            $cfg = Configuration::getConfiguration();
            $trace = $this->getTrace();
            
            if ($cfg->debugMode == 1)
            {
                require 'erreur_debug.php';
            }
            else
            {
                require 'erreur_production.php';
            }
            die();
        }
    }
?>

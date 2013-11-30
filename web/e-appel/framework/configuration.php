<?php
    defined('__FRAMEWORK3IL__') or die ('Accès Interdit');

    class Configuration
    {
        private $data = null;
        private static $_config = null;
        
        private function __construct($fichier) 
        {
            if (!file_exists($fichier))
            {
                die('Le fichier n\'existe pas.');
            }
            else
            {
                $this->data = parse_ini_file($fichier);
                
                if (is_null($this->data))
                {
                    $this->data = FALSE;
                    die('La lecture du fichier de config a echoué.');
                }
                
            }
        }
        
        public function __get($propriete) 
        {
            if (isset($this->data[$propriete]))
            {
                return $this->data[$propriete];
            }
            else
            {
                die('La proprieté n\'existe pas');
            }
        }
        
        static public function getConfiguration($fichier='')
        {
            if (is_null(self::$_config)===TRUE)
            {
                self::$_config = new Configuration($fichier);
            }
            return self::$_config;
        }
        
        public function demo()
        {
            return $this->data;
        }
    }

?>

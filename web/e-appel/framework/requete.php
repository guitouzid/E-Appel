<?php
    defined('__FRAMEWORK3IL__') or die ('Accès Interdit');
    
    final class Requete
    {
        static public function get($item, $default=NULL)
        {
            return self::fetch($_GET, $item, $default);
        }
        
        static public function post($item, $default=NULL)
        {
            return self::fetch($_POST, $item, $default);
        }
        
        static private function fetch($tab, $item, $default=NULL)
        {
            if (isset($tab[$item]))
            {
                return $tab[$item];
            }
            else
            {
                return $default;
            }
        }
    }
?>

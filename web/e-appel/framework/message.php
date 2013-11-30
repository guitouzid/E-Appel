<?php
    defined('__FRAMEWORK3IL__') or die ('Accès Interdit');

    class Message
    {
        public static function deposer($message)
        {
            $_SESSION['framework3il.message'] = htmlspecialchars($message);
        }
        
        public static function retirer()
        {
            if (isset($_SESSION['framework3il.message']) && !empty($_SESSION['framework3il.message']))
            {
                $message = $_SESSION['framework3il.message'];
                unset($_SESSION['framework3il.message']);
            }
            else
            {
                $message = '';
            }
            
            return $message;
        }
    }
?>

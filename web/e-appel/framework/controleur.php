<?php
    defined('__FRAMEWORK3IL__') or die ('Accès Interdit');
    
    abstract class Controleur
    {
        protected $actionDefaut = '';
        
        
        public function _preAction()
        {
            
        }
        
        public function executer($action)
        {
            $methode = $action.'Action';
            
            if (method_exists($this, $methode))
            {
                $this->_preAction();
                $this->$methode();
            }
            else
            {
                throw new Erreur('Méthode inexistante !');
            }
        }
        
        public function getActionDefaut()
        {
            return $this->actionDefaut;
        }
        
        public function setActionDefaut($action)
        {
            $this->actionDefaut=$action;
        }
        
        public function rediriger($controller, $action, $message = '')
        {
            if (!empty($message)) Message::deposer($message);
            ?>
                <script type="text/javascript">
                    window.location = '<?php echo ('index.php?controller='.$controller.'&action='.$action); ?>';
                </script>
            <?php
        }
    }
?>

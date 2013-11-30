<?php
    define('__FRAMEWORK3IL__','');
    
    session_start();

    require_once 'configuration.php';
    require_once 'application.php';
    require_once 'datatable.php';
    require_once 'erreur.php';
    require_once 'requete.php';
    require_once 'page.php';
    require_once 'controleur.php';
    require_once 'message.php';
    require_once 'authentification.php';
    require_once './application/helpers/menu_principal.helper.php';

    class Application
    {
        private static $_application = null;
        private $db = null;
        private $controleurDefaut = '';
        private $controleur = '';
        private $action = '';
        
        private function __construct($fichierIni)
        {
            $config = Configuration::getConfiguration($fichierIni);
            try 
            {
                $this->db = new PDO("mysql:host=$config->db_hostname;dbname=$config->db_database", $config->db_username, $config->db_password);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
            catch (Exception $e)
            {
                die($e->getMessage());
            }
        }
        
        static public function configurerAuthentification()
        {
            $config = Configuration::getConfiguration();
            Authentification::getAuthentification($config->auth_table, $config->auth_identifiant, $config->auth_login, $config->auth_motdepasse);
        }
        
        static public function getApplication($fichierIni='')
        {
            if (is_null(self::$_application) === TRUE)
            {
                self::$_application = new Application($fichierIni);
            }
            
            return self::$_application;
        }
        
        public function getDb()
        {
            return $this->db;
        }
        
        public function lancer()
        {
            if (empty(Requete::get('controller')))
            {
                $controller = $this->controleurDefaut;
            }
            else
            {
                $controller = Requete::get('controller');
            }
            $this->controleur = $controller;
            
            if (!file_exists('application/controllers/'.$controller.'.controller.php'))
            {
                throw new Erreur('Contrôleur invalide !');
            }
            else
            {
                require_once 'application/controllers/'.$controller.'.controller.php';
            }
            
            $classe = $controller.'Controlleur';
            
            if (class_exists($classe))
            {
                $classe = new $classe;
            }
            else
            {
                throw new Erreur('Classe non trouvée !');
            }
            
            if (empty(Requete::get('action')))
            {
                $action = $classe->getActionDefaut();
            }
            else
            {
                $action = Requete::get('action');
            }
            $this->action = $action;
            
            $classe->executer($action);
            Page::getInstance()->afficher();
        }
        
        public function setControleurDefaut($controller)
        {
            $this->controleurDefaut = $controller;
        }
        
        static public function getControleur()
        {
            if (is_null(self::$_application) === TRUE) 
            {
                die ('L\'application n\'est pas instanciée.');
            }
            else
            {
                return self::$_application->controleur;
            }
        }
        
        static public function getAction()
        {
            if (is_null(self::$_application) === TRUE) 
            {
                die ('L\'application n\'est pas instanciée.');
            }
            else
            {
                return self::$_application->action;
            }
        }
        
        static public function getURL()
        {
            $url = 'http://'.$_SERVER['HTTP_HOST'];
            
            if ($_SERVER['SERVER_PORT'] != 80)
            {
                $url .= ':'.$_SERVER['SERVER_PORT'];
            }
            
            $url .= $_SERVER['SCRIPT_NAME'].'?controller='.self::getControleur().'&action='.self::getAction();
            
            return $url;
        }
    }
?>

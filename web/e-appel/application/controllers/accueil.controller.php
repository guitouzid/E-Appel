<?php
    defined('__EAPPEL__') or die('Accès interdit');
    
    class AccueilControlleur extends Controleur
    {
        public function __construct() 
        {
            $this->setActionDefaut('accueil');
        }
        
        public function _preAction() 
        {
            if (!Authentification::getAuthentification()->estConnecte())
            {
                $this->rediriger('index', 'index');
            }
        }

        public function accueilAction()
        {
            $page = Page::getInstance();
            $page->setTemplate('application');
            $page->setVue('accueil');
            $page->ajouterCSS('e-appel');
            $page->message = '';
        }
        
        
    }
?>
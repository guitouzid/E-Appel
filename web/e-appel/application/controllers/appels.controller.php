<?php
    defined('__EAPPEL__') or die('Accès interdit');
    
    class AppelsControlleur extends Controleur
    {
        public function __construct() 
        {
            $this->setActionDefaut('lister');
        }
        
        public function _preAction() 
        {
            if (!Authentification::getAuthentification()->estConnecte())
            {
                $this->rediriger('index', 'index');
            }
        }

        public function listerAction()
        {
            $page = Page::getInstance();
            $page->setTemplate('application');
            $page->ajouterCSS('e-appel');
            $page->setVue('appels');
            $page->message = '';
        }
        
        public function choixGroupeAction()
        {
            $page = Page::getInstance();
            $page->setTemplate('application');
            $page->ajouterCSS('e-appel');
            $page->setVue('choix_groupe');
            $page->message = '';
        }
    }
?>
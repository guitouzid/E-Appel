<?php
    defined('__EAPPEL__') or die('Acces interdit');
    
    class indexControlleur extends Controleur {
        public function __construct() {
            $this->setActionDefaut('index');
        }
        
        public function _preAction() 
        {
            if (Authentification::getAuthentification()->estConnecte())
            {
                $this->rediriger('accueil', 'accueil');
            }
        }
                        
        public function indexAction()
        {
            $page = Page::getInstance();
            $page->setTemplate('index');
            $page->setVue('index');
            $page->ajouterCSS('index');
            $page->message = "";
            $page->login = "";
            $page->motdepasse = "";
            
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $page->login = trim(Requete::post('login',''));
                $page->motdepasse = trim(Requete::post('motdepasse',''));
                
                if($page->login==''){
                    $page->message = "Login manquant";
                    return;
                }
                
                if($page->motdepasse == ''){
                    $page->message = "Mot de passe manquant";
                    return;
                }
                
                /* POINT D'INSERTION */
                if (Authentification::authentifier($page->login, $page->motdepasse))
                {
                    $this->rediriger('accueil', 'accueil');;
                }
                $page->message = "Login / mot de passe incorrect";
               
            }
        }
    }


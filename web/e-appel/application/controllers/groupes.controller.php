<?php
    defined('__EAPPEL__') or die('Accès interdit');
    
    class GroupesControlleur extends Controleur
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
            require_once 'application/data/groupes.data.php';
            $groupes_data = new Groupes();
            
            $groupes = $groupes_data->lister();
            
            $page = Page::getInstance();
            $page->setTemplate('application');
            $page->setVue('groupes');
            $page->ajouterCSS('e-appel');
            $page->ajouterCSS('liste_groupes');
            $page->ajouterScript('jquery-1.10.2.min');
            $page->ajouterScript('liste_groupes');
            $page->groupes = $groupes;
        }
        
        public function detailAction()
        {
            require_once 'application/data/groupes.data.php';
            $page = Page::getInstance();
            $page->setTemplate('ajax');
            $page->setVue('groupe_ajax');
            $id = Requete::get('id', 0);
            if (!filter_var($id, FILTER_VALIDATE_INT)) die('erreur');
            
            $groupes_data = new Groupes();
            $groupe = $groupes_data->getGroupe($id);
            $page->data = json_decode($groupe['eleves']);
            $page->groupe = $groupe['groupe'];
        }
    }
?>
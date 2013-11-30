<?php
    defined('__EAPPEL__') or die('Accès interdit');
    
    class UtilisateursControlleur extends Controleur
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
            require_once 'application/data/utilisateurs.data.php';
            $utilisateurs_data = new Utilisateurs();
            
            // Tri
            if (in_array(Requete::get('order'), array('login', 'nom', 'prenom', 'email', 'type')))
            {
                $order = strtolower(Requete::get('order'));
            }
            else
            {
                $order = 'login';
            }
            
            if (in_array(Requete::get('dir'), array('asc', 'desc')))
            {
                $dir = strtolower(Requete::get('dir'));
            }
            else
            {
                $dir = 'asc';
            }
            
            $utilisateurs = $utilisateurs_data->lister($order, $dir);
            
            $page = Page::getInstance();
            $page->setTemplate('application');
            $page->setVue('utilisateurs');
            $page->ajouterCSS('e-appel');
            $page->ajouterCSS('liste_enseignants');
            $page->utilisateurs = $utilisateurs;
            $page->message = Message::retirer();
            $page->tri=array('order' => $order, 'dir' => $dir);
        }
        
        public function creerAction()
        {
            $this->editerAction(FALSE);
        }
        
        public function editerAction($edition = TRUE)
        {
            require_once 'application/data/utilisateurs.data.php';
            $utilisateurs_data = new Utilisateurs();
            
            $page = Page::getInstance();
            $page->setTemplate('application');
            $page->setVue('utilisateur');
            $page->ajouterCSS('e-appel');
            
            if ($edition) 
            {
                $page->edition = "readonly=\"readonly\"";
                $page->id = Requete::get('id');
                $utilisateur = $utilisateurs_data->utilisateur($page->id);
                
                $page->login = $utilisateur['login'];
                $page->nom = $utilisateur['nom'];
                $page->prenom = $utilisateur['prenom'];
                $page->email = $utilisateur['email'];
                $page->titre = 'Edition d\'un utilisateur';
            }
            else 
            {
                $page->id = 0;
                $page->edition = '';
                $page->login = '';
                $page->nom = '';
                $page->prenom = '';
                $page->confirmation = '';
                $page->motPasse = '';
                $page->email = '';
                $page->titre = 'Création d\'un nouvel utilisateur';
            }
            
            // Login
            if (!empty($_POST))
            {
                if ($page->id == 0)
                {
                    $page->login = trim(Requete::post('login'));
                    if (strlen($page->login)<=4)
                    {
                        $page->erreurs[] = 'Longueur insuffisante pour le Login !';
                        return ;
                    }
                    $page->login = filter_var($page->login, FILTER_SANITIZE_STRING);
                }
                
                // Nom
                $page->nom = trim(Requete::post('nom'));
                if (!empty($page->nom))
                {
                    $page->nom = filter_var($page->nom, FILTER_SANITIZE_STRING);
                }
                else
                {
                    $page->erreurs[] = 'Le nom ne doit pas être vide !';
                    return ;
                }

                // Prénom
                $page->prenom = trim(Requete::post('prenom'));
                if (!empty($page->prenom))
                {
                    $page->prenom = filter_var($page->prenom, FILTER_SANITIZE_STRING);
                }
                else
                {
                    $page->erreurs[] = 'Le prénom ne doit pas être vide !';
                    return ;
                }

                // Email
                $page->email = trim(Requete::post('email'));
                if (!empty($page->email))
                {
                    $page->email = filter_var($page->email, FILTER_SANITIZE_EMAIL);
                    if (filter_var($page->email, FILTER_VALIDATE_EMAIL)===FALSE) $page->erreurs[] = 'L\'email n\'est pas valide !';
                }
                else
                {
                    $page->erreurs[] = 'L\'email ne doit pas être vide !';
                    return ;
                }

                // Mot de Passe
                if (!empty($page->motPasse))
                {
                    $page->motPasse = trim(Requete::post('motPasse'));
                    if (strlen($page->motPasse)>=7)
                    {
                        $page->motPasse = filter_var($page->motPasse, FILTER_SANITIZE_STRING);
                    }
                    else
                    {
                        $page->erreurs[] = 'Longueur insuffisante pour le mot de passe !';
                        return ;
                    }

                    // Confirmation
                    $page->confirmation = trim(Requete::post('confirmation'));
                    if (strlen($page->confirmation)>=7)
                    {
                        $page->confirmation = filter_var($page->confirmation, FILTER_SANITIZE_STRING);

                        if ($page->motPasse != $page->confirmation) 
                        {
                            $page->erreurs[] = 'Les deux mots de passe ne correspondent pas !';
                            return ;
                        }
                    }
                    else
                    {
                        $page->erreurs[] = 'Longueur insuffisante pour la confirmation du mot de passe !';
                        return ;
                    }
                }
                else
                {
                    $page->motPasse = '';
                }
                
                
                // Création / Update
                if ($page->id == 0)
                {
                    $utilisateurs_data->modifier($page->login, $page->nom, $page->prenom, $page->email, $page->motPasse);
                    $message = 'Utilisateur enregistré !';
                }
                else
                {
                    $utilisateurs_data->creer($page->id, $page->nom, $page->prenom, $page->email, $page->motPasse);
                    $message = 'Utilisateur modifié !';
                }
                
                $this->rediriger('utilisateurs', 'lister');
            }
        }
        
        public function supprimerAction()
        {
            require_once 'application/data/utilisateurs.data.php';
            $utilisateurs_data = new Utilisateurs();
            
            // On filtre l'ID
            if (filter_var(Requete::get('id'), FILTER_VALIDATE_INT) === FALSE)
            {
                throw new Erreur('L\'ID n\'est pas correct !');
            }
            else
            {
                $utilisateurs_data->supprimer(filter_var(Requete::get('id')));
            }
            $this->rediriger('utilisateurs', 'lister', 'Utilisateur supprimé !');
        }
        
        public function deconnecterAction()
        {
            Authentification::getAuthentification()->deconnecter();
            
            $this->rediriger('index', 'index');
        }
    }
?>
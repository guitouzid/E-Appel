<?php
    defined('__EAPPEL__') or die('Accès interdit');
    
    class MenuPrincipal
    {
        static public function afficher()
        {
            $menu = array(
                'Accueil' => array('controleur' => 'accueil', 'action' => 'accueil'),
                'Faire un Appel' => array('controleur' => 'appels', 'action' => 'choixGroupe'),
                'Liste des Appels' => array('controleur' => 'appels', 'action' => 'lister'),
                'Groupes' => array('controleur' => 'groupes', 'action' => 'lister'),
                'Enseignants' => array('controleur' => 'utilisateurs', 'action' => 'lister')
            );
            
            $html = '<ul>';
            foreach ($menu as $k => $m)
            {
                $html .= '<li>';
                if (Application::getControleur()==$m['controleur'])
                {
                    $active = "class='active'";
                }
                else
                {
                    $active = '';
                }
                $html .= "<a href='index.php?controller=".$m['controleur']."&action=".$m['action']."' ".$active." >".$k."</a>";
                
                $html .= '</li>';
            }
            $html .= '</ul>';
            
            echo ($html);
        }
    }
?>
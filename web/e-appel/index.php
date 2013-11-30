<?php
    define('__EAPPEL__','');
    require_once 'framework/application.php';
    require_once 'application/controllers/utilisateurs.controller.php';
    
    $application = Application::getApplication('application/config.ini');
    $application->setControleurDefaut('index');
    $application->configurerAuthentification();
    $application->lancer();
    
    
    
?>

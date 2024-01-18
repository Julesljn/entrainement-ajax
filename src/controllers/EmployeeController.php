<?php

namespace Trombistock\controllers;


use Trombistock\models\EmployeeManager;
use Trombistock\models\Employee;


// CETTE CLASSE REGROUPE TOUTES LES FONCTIONALITES CONCERNANT UN OBJET DE TYPE Employee
class EmployeeController
{
    //on déclare un attribut de type Employee
    private $EmployeeManager;

    //Méthode constructeur de la classe
    public function __construct()
    {
        //on instancie un objet de type employeeManager
        $this->EmployeeManager = new EmployeeManager();
    }

    /** HomePage **/
    public function index()
    {
        require VIEWS . 'Layout.php';
    }


    public function showCreateEmployee()
    {
        //ON INSTANCIE LE CONTROLLER QUI S'OCCUPE DES SERVICES ']
        $ServiceController = new ServiceController();
        //ON APPELLE LA METHODE 'getAll' qui renvoit la liste de toutes les services
        $services = $ServiceController->getAll();
        //ON ENVOIE LA LISTE DE SERVICES AU FORMULAIRE DE CREATION D'UNE FICHE EMPLOYE QUE L'ON AFFICHE
        require VIEWS . 'FormCreateEmployee.php';
    }

    /*************** CREATION D'UNE NOUVELLE FICHE EMPLOYE ***********************/
//Si le formulaire de création d'un employee a été posté
    public function create()
    {
        //On met les informations du formulaire en SESSION
        $_SESSION['POST'] = $_POST;
        //Si un service n'a pas été sélectionné,
        if (!$_POST['serviceId']) {
            // on crée un message d'erreur
            $_SESSION['POST']['erreur'] = "<p class='erreur'> Veuillez sélectionner un service !</p>";
            // on rappelle la fonction qui affiche le formulaire de création
            $this->showCreateEmployee();
        } else {
            //On instancie un objet Employee en appelant le constructeur
            $employee = new Employee();
            //On set les attributs de l'objet Employee avec les valeurs postées par le formulaire
            $employee->setEmployeeName(htmlspecialchars($_POST['employeeName']));
            $employee->setEmployeeSurname(htmlspecialchars($_POST['employeeSurname']));
            $employee->setServiceId($_POST['serviceId']);
            $employee->setEmployeeImage("default.png");

            //téléchargement de l'image dans le dossier assets/img/
            if ($_FILES['employeeImage']['error'] !== UPLOAD_ERR_NO_FILE) {
                $uploaddir = 'img/';
                $uploadfile = $uploaddir . basename($_FILES['employeeImage']['name']);
                move_uploaded_file($_FILES['employeeImage']['tmp_name'], $uploadfile);
                $employee->setEmployeeImage($_FILES['employeeImage']['name']);
            }
            //On appelle la fonction du Manager qui va insérer le employee en base de données
            //Cette fonction renvoie le dernier Id inséré
            $employeeId = $this->EmployeeManager->store($employee);
            //On set l'id du nouveau employee et on transmet le employeee pour affichage
            $employee = $this->EmployeeManager->getEmployeebyId($employeeId);
            $contenu = $this->showEmployee($employee);
            require VIEWS . 'Layout.php';
        }
    }

    public function showEmployeeMenu($contenu = null)
    {
        //ON INSTANCIE LE CONTROLLER QUI S'OCCUPE DES SERVICES 
        $ServiceController = new ServiceController();
        //ON APPELLE LA METHODE 'getAll' qui renvoit la liste des services
        $services = $ServiceController->getAll();
        //ON ENVOIE LA LISTE DE SERVICES AU FORMULAIRE DE RECHERCHE QUI VA S’AFFICHER
        require VIEWS . 'FormSearchEmployee.php';
    }

    /** recherche d'un employé par son id**/
    public function getEmployeeById($employeeId)
    {
        //On appelle la fonction du Manager qui va supprimer l'employee en base de données
        $employee = $this->EmployeeManager->getEmployeeById($employeeId);
        $contenu = $this->showEmployee($employee);
        $this->showEmployeeMenu($contenu);
    }


    /** Filtrer les employés par service **/
    public function searchByservice()
    {
        //On appelle la fonction du Manager qui va chercher la liste des employee en base de données
        $employee = $this->EmployeeManager->getEmployeeByservice();
        $nbProd = count($employee);
        if ($nbProd >= 1) {
            $contenu = "<p class='message'> $nbProd résultat(s) pour votre recherche</p>";
        } else {
            $contenu = "<p class='erreur'> aucun résultat pour votre recherche</p>";
        }
        //On parcourt le tableau de résultats et on envoie chaque employee à la fonction "afficheremployé"
        foreach ($employee as $employee) {
            $contenu .= $this->showEmployee($employee);
        }
        $contenu .= "</article>";

        $this->showEmployeeMenu($contenu);
    }


    /** Recherche par nom de employee SANS AJAX**/
    public function searchByName()
    {
        //On appelle la fonction du Manager qui va chercher la liste des employee en base de données
        $employees = $this->EmployeeManager->getEmployeeByName();
        $nbProd = count($employees);
        if ($employees) {
            $contenu = "<p class='message'> $nbProd résultat(s) pour votre recherche</p>";
        } else {
            $contenu = "<p class='erreur'> aucun résultat pour votre recherche</p>";
        }

        //On parcourt le tableau de résultats et on envoie chaque employee à la fonction "afficheremployé"
        foreach ($employees as $employee) {
            $contenu .= $this->showEmployee($employee);
        }
        $this->showEmployeeMenu($contenu);
    }

    /** Recherche par nom ou prénom d'employé avec AJAX**/
    public function searchByNameAjax()
    {   //on vérifie que la data a bien été postée
        if (!$_POST['employeeName']) {
            // si non on rappelle la fonction qui affiche le formulaire de création
            $this->showEmployeeMenu();
        } else {     //si oui On appelle la fonction du Manager qui va chercher la liste des employee en base de données
            $employees = $this->EmployeeManager->getEmployeeByName();
            $outputForJs = "";
            //On parcourt le tableau de résultats et on construit le html qui sera renvoyé au fichier js
            if ($employees) {
                foreach ($employees as $key => $employee) {
                    $id = $employee->getEmployeeId();
                    $outputForJs .= "<a href='/employee/$id'>" . $employee->getEmployeeName() . "  "
                        . $employee->getEmployeeSurname() . " (service " . $employee->getServiceName() . " )</div>";
                }
            }
            // On renvoit le html à JS pour qu'il l'affiche dans la div au dessous de la barre de recherche,
            //dans la div "response-container"
            echo $outputForJs;
        }
    }
    /*************** FONCTION D'AFFICHAGE D'UNE FICHE EMPLOYE  ***********************/
//Fonction qui permet d'afficher un employee du catalogue
    public function showEmployee(Employee $employee, $message = null)
    {
        static $count = 0;
        $boutons = "";
        $retour = "";
        //Bouton pour supprimer
        $boutons = "<br><div><input type='submit' name='deleteEmployee' id='delete' value='supprimer' onclick=\"return confirm('Êtes-vous sur de vouloir supprimer ce employee ?')\"></div>";
        $count++;
        if ($count == 1) {
            $retour .= "<article class='articles-wrapper'>";
        }
        if ($count == 6) {
            $retour .= "</article><article class='articles-wrapper'>";
        }
        return "  
              $retour&nbsp;&nbsp;<div class='article' >
                    <h1>" . $employee->getEmployeeName() . "  " . $employee->getEmployeeSurname() . "</h1>
                     <h3>Service " . $employee->getServiceName() . "</h3>
                 
              <div class='containerPhoto'><img class='image' src = '/img/" . $employee->getEmployeeImage() . " ' alt=''></div>
         
               <form action='/employee/delete/" . $employee->getEmployeeId() . "' method='post' >
               <input type='hidden' value = " . $employee->getEmployeeId() . "  name = 'employeeId'>
                $boutons 
               </form></div >";
    }


    /** Suppression d'un employé **/
    public function delete($employeeId)
    {
        //On appelle la fonction du Manager qui va supprimer l'employee en base de données
        $this->EmployeeManager->delete($employeeId);
        $contenu = "<p class='message'>Ce employee a été supprimé</p>";
        require VIEWS . 'Layout.php';
    }

}

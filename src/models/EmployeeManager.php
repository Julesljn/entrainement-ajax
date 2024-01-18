<?php
namespace Trombistock\models;

//ON DESIGNE LE FICHIER QUI CONTIENT LES VARIABLES POUR LA CONNEXION BDD
//require_once('config/Config.php');


/** Class EmployeeManager **/
class EmployeeManager
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /** Enregistrement d'un employé **/
    public function store(Employee $employee)
    {

        $stmt = $this->connexion->prepare("INSERT INTO employee (employeeName, serviceId, employeeSurname, employeeImage) VALUES (? ,?,?,?)");
        $stmt->execute(array(
            $employee->getEmployeeName(),
            $employee->getServiceId(),
            $employee->getEmployeeSurname(),
            $employee->getEmployeeImage()
        ));
        //on renvoit le dernier id inséré au contrôleur
        return $this->connexion->lastInsertId();
    }

    // Récupération de toutes les fiches employés
    public function getAll()
    {
        //REQUETE AVEC JOINTURE QUI PERMET DE RECUPERER TOUS LES EMPLOYESS ET LE NOM DE LEUR SERVICE
        //EN UTILISANT LEUR ID EN COMMUN :  serviceId
        $stmt = $this->connexion->prepare('SELECT * FROM employee INNER JOIN services ON  employee.serviceId = employee_service.serviceId ORDER BY employeeSurname');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Employee::class);
    }

    /** Récupération d'un employé à partir de son id**/
    public function getEmployeeById($id)
    {
        //REQUETE AVEC JOINTURE QUI PERMET DE RECUPERER UN EMPLOYE ET LE NOM DE SON SERVICE
        //EN UTILISANT LEUR ID EN COMMUN :  productCategoryId
        $stmt = $this->connexion->prepare('SELECT * FROM employee INNER JOIN services ON  employee.serviceId = services.serviceId WHERE employeeId = ?');
        $stmt->execute(array(
            $id
        ));
        return $stmt->fetchObject(Employee::class);
    }


    /** Récupération des Employee selon son nom ou partie de son nom **/
    public function getEmployeeByName()
    {
        //REQUETE AVEC JOINTURE QUI PERMET DE RECHERCHER DES EMPLOYES PAR LEUR NOM OU PARTIE DU NOM
        //EN UTILISANT LE TEXTE ENTRE DANS LA BARRE DE RECHERCHE
        $stmt = $this->connexion->prepare('SELECT * FROM employee INNER JOIN services ON  employee.serviceId = services.serviceId WHERE (employeeSurname like ?) OR (employeeName like ?) ORDER BY employeeSurname');
        $stmt->execute(array(
            "%" . $_POST['employeeName'] . "%",
            "%" . $_POST['employeeName'] . "%"
        ));
        //retourne un array list d'objets de type Employee.php
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Employee::class);
    }

    /** Récupération des Employee selon un service **/
    public function getEmployeeByservice()
    {
        //REQUETE AVEC JOINTURE QUI PERMET DE RECUPERER LES EMPLOYES PAR SERVICE
        $stmt = $this->connexion->prepare('SELECT * FROM employee INNER JOIN services ON  employee.serviceId = services.serviceId WHERE employee.serviceId like ? ORDER BY employeeSurname');
        $stmt->execute(array(
            $_POST['serviceId']
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Employee::class);
    }

    /** Suppression du employee **/
    public function delete($employeeId)
    {
        $stmt = $this->connexion->prepare('DELETE FROM employee WHERE employeeId = ?');
        $stmt->execute(array(
            $employeeId
        ));
    }

}

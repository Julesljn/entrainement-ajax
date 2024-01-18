<?php
namespace Trombistock\models;

use Trombistock\models\service;


/** Class EmployeeManager **/
class ServiceManager
{
    private $connexion;

    public function __construct()
    {
        $this->connexion = new \PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8;', USER, PASSWORD);
        $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /** Récupération de tous les services**/
    public function getAll()
    {
        //REQUETE POUR RECUPERER TOUT LES services
        $stmt = $this->connexion->prepare('SELECT * FROM services ORDER BY serviceName ASC');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Service::class);
    }
    public function addService($serviceName) {
        try {
            $stmt = $this->connexion->prepare("INSERT INTO services (serviceName) VALUES (:serviceName)");
            $stmt->bindParam(':serviceName', $serviceName, \PDO::PARAM_STR);
            $stmt->execute();

            return $this->connexion->lastInsertId();
        } catch (\PDOException $e) {
            var_dump('echec envoie bdd');
            return false;
        }
    }
}

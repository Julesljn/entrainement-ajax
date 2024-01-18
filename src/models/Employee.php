<?php
namespace Trombistock\models;

// CETTE CLASSE PERMET D'INSTANCIER DES OBJETS DE TYPE Employee
class Employee
{
    //DECLARATION DES ATTRIBUTS DE LA CLASSE
    private $employeeId;
    private $employeeName;
    private $employeeSurname;
    private $employeeImage;
    private $serviceId;


    private $serviceName;

    //Méthode constructeur de la classe
    public function __construct()
    {
    }

    //Méthode qui initialise tous les attributs
    public function setAll($employeeId, $employeeName, $employeeDescription, $employeeImage, $employeePrice, $serviceId, $serviceName)
    {
        $employeeId == null ?: $this->setEmployeeId($employeeId);
        $this->setEmployeeId($employeeId);
        $this->setEmployeeName($employeeName);
        $this->setEmployeeDescription($employeeDescription);
        $this->setEmployeeImage($employeeImage);
        $this->setEmployeePrice($employeePrice);
        $this->setServiceId($serviceId);
        $serviceName == null ?: $this->setServiceName($serviceName);
    }

    //**************METHODES ACCESSEURS (GETTERS AND SETTERS************)
    //setter pour l'attribut employeeId permet d'accéder en écriture à l'attribut
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
    }

    //getter pour l'attribut employeeId permet d'accéder en lecture à l'attribut
    //cette méthode est une fonction (elle renvoie un résultat )
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    public function setEmployeeName($employeeName)
    {
        $this->employeeName = $employeeName;
    }

    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    public function setEmployeeSurname($employeeSurname)
    {
        $this->employeeSurname = $employeeSurname;
    }

    public function getEmployeeSurname()
    {
        return $this->employeeSurname;
    }

    public function setEmployeeImage($employeeImage)
    {
        $this->employeeImage = $employeeImage;
    }

    public function getEmployeeImage()
    {
        return $this->employeeImage;
    }

    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    public function getServiceId()
    {
        return $this->serviceId;
    }

    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;
    }

    public function getServiceName()
    {
        return $this->serviceName;
    }

}

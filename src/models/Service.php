<?php
namespace Trombistock\models;


// CETTE CLASSE PERMET D'INSTANCIER DES OBJETS DE TYPE service
class service
{
    //DECLARATION DES ATTRIBUTS DE LA CLASSE
    private $serviceId;
    private $serviceName;

    //Méthode constructeur de la classe
    public function __construct()
    {
    }

    //Méthode qui initialise tous les attributs
    public function setAll($serviceId, $serviceName)
    {
        $this->setServiceId($serviceId);
        $this->setServiceName($serviceName);
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

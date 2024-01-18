<?php
namespace Trombistock\controllers;

use Trombistock\models\service;
use Trombistock\models\ServiceManager;

class ServiceController
{
    private $ServiceManager;

    public function __construct()
    {
        $this->ServiceManager = new ServiceManager();
    }

    public function getAll()
    {
        return $this->ServiceManager->getAll();
    }

    // Méthode pour ajouter un service
    public function addService()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $serviceName = $data['new_service'];

        $newServiceId = $this->ServiceManager->addService($serviceName);

        if ($newServiceId) {
            echo json_encode(['success' => true, 'id' => $newServiceId]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}

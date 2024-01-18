<?php
session_start();

require '../src/config/Config.php';
require '../vendor/autoload.php';
//On instancie un Router en utilisant la classe Router.php
$router = new Trombistock\Router($_SERVER['REQUEST_URI']);

//Route appelée pour arriver à la Home page
$router->get('/', "EmployeeController@index");


//ROUTES EN GET
//********************************
//Route pour afficher le menu de recherche d'employés
$router->get('/employee/search', "EmployeeController@showEmployeeMenu");
//Route pour afficher le formulaire de création d'un employé
$router->get('/employee/create', "EmployeeController@showCreateEmployee");
//Route pour afficher un employé à partir de son Id
$router->get('/employee/:idEmploye', "EmployeeController@getEmployeeById");


//ROUTES EN POST
//*******************************
// Route permettant de chercher les employés par leur nom en utilisant AJAX
$router->post('/employee/searchAjax/name', "EmployeeController@searchByNameAjax");

$router->post('/employee/createAjax', "ServiceController@createServiceAjax");

// Route permettant de chercher les employés par leur nom
$router->post('/employee/search/name', "EmployeeController@searchByName");
// Route permettant de chercher les employés par service
$router->post('/employee/search/service', "EmployeeController@searchByService");
//Route pour stocker un nouvel employé dans la base de données
$router->post('/employee/create', "EmployeeController@create");//Route pour stocker un nouvel employé dans la base de données
// Route pour supprimer un employé de la base de données
$router->post('/employee/delete/:employeeId', "EmployeeController@delete");


$router->run();

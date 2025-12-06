<?php
class Router
{

 public function dispatch(string $url = '/') 
{
  // Suppression des / en début et fin de chaine
  $url = trim($url, '/');
  // Découpe en tableau l'URL
  $url = explode('/', $url);

  
  if (empty($url[0])) {
    // Si l'URL est vide, on force le contrôleur et la méthode par défaut (Accueil)
    $controllerName = 'ActivitiesController'; // Nom du contrôleur
    $methodName = 'home'; // Nom de la méthode
    $params = []; // Pas de paramètres
    
    // 
    // Charge le controleur par défaut
    if (file_exists("./app/controllers/$controllerName.php")) {
        require_once "./app/controllers/$controllerName.php";
        $controller = new $controllerName;
        // Appel la méthode home() avec 0 paramètres
        call_user_func_array([$controller, $methodName], $params);
        return; 
    } 
     else {
        // Redirection vers la 404 si le contrôleur n'existe pas
        die('<p>Controleur introuvable</p>');
    }
    

  } 

  // Défini le nom du controller (Logique initiale du professeur)
  $controllerName = ucfirst($url[0]) . 'Controller';

  // Le second élément de l'URL est la méthode
  if (isset($url[1])) {
   $methodName = $url[1];
  } else {
   $methodName = 'findAll';
  }

  // Extrait la suite de l'URL
  $params = array_slice($url, 2);

  // Vérification de l'existence du contrôleur
  if (file_exists("./app/controllers/$controllerName.php")) {
   // Charge le controleur
   require_once "./app/controllers/$controllerName.php";
   // Initialise le controleur
   $controller = new $controllerName;

   // Vérification de l'existence de la méthode dans le contrôleur
   if (method_exists($controller, $methodName)) {
    // Appel la méthode du controleur et envoie les paramètres
    call_user_func_array([$controller, $methodName], $params);
   } else {
    die('<p>Méthode introuvable</p>');
   }
  } else {
   die('<p>Controleur introuvable</p>');
  }
 }
}
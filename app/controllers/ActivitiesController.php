<?php
class ActivitiesController
{
use Render;
// fonction pour afficher toutes les activités
public function home()
{
   //j'utilise mon model pour recup les activités de la bdd
    $activitieModel = new ActivitiesModel();
    $activities = $activitieModel->getAllActivities();
//je les envoie a ma vue grace une fonction crée dans le Render 
    $this->renderView('activities/home',  [
        'activities' =>  $activities,
        'title' => 'Accueil'
    ]);
}

//la cette fonction sert a recuperer une seul activité grace a son id 
public function details($id)
{
    //j'utilise mon model pour recup l'activité de la bdd selon son id
    $activitieModel = new ActivitiesModel();
    $activitie = $activitieModel->getActivityById($id);
    //si l'activité n'existe pas je redirige vers la homepage
    if(!$activitie){
         header('Location: /activities/home');
    }
//j'envoie les info a ma vue
    $this->renderView('activities/details',  [
        'activitie' =>  $activitie,
        'title' => 'Details'
    ]);
}

//fonction pour ajouter une activité
public function add()
{
    //je verifie si l'utilisateur est admin 
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        //si non je le redirige vers la homepage 
        header('Location: /activities/home');
        exit;
    }
    //j'utilise mon model pour faire l'insert de l'activité dans la bdd
    $activitieModel = new ActivitiesModel();
    //si j'ai un post de mon form 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $imagelink = '';
        //si j'ai une image 
        if (isset($_FILES['image'])) {
          //j'utilise pathinfo pour avoir l'extention de l'image 
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            //ici je crée un id unique pour chaque image pour pas en avoir avec le meme nom 
            $imagelink = uniqid() . '.' . $ext;
            //je deplace l'image dans mon dossier images
            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $imagelink);
        }
        //je recupere toute les donnée du form dans un tableau
        $data = [
            'nom' => $_POST['nom'],
            'type_id' => $_POST['type_id'],
            'places' => $_POST['places'],
            'description' => $_POST['description'],
            'date' => $_POST['date'],
            'duree' => $_POST['duree'],
            'image' => $imagelink 
        ];
//j'appelle ma fonction addActivity du model avec les donnée du form et puis je redirige
        if ( $activitieModel->addActivity($data)) {
            header('Location: /activities/home');
            exit;
        }
    }
    //je recupere le type pour le mette dans le select de mon form 
    $types =  $activitieModel->getTypes();

    $this->renderView('activities/add', [
        'types' => $types
    ]);
}
//Ma fonction pour supprimer une activité
public function delete($id)
{
    //verifie si l'utilisateur est admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /activities/home');
        exit;
    }
    //j'utilise mon model pour supprimer l'activité selon son id 
    //(sa supprime aussi les reservation j'ai tout mis dans la fonction deleteActivity() de mon model)
$activitieModel = new ActivitiesModel();
$activitieModel->deleteActivity($id);
header('Location: /activities/home');

}
//ma fonction pour mettre a jour une activité
public function update($id)
{
    //pas besoin de me repeter
     if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /activities/home');
        exit;
    }
//j'utilise mon model pour recup l'activité selon son id
    $activitieModel = new ActivitiesModel();
    $activitie = $activitieModel->getActivityById($id);
//meme principe que pour l'ajout
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        //gere l'erreur au cas ou l'utilisateur ne change pas l'image car value ne marche pas pour les input file
        $imagelink = $activitie['image'];
        if (isset($_FILES['image']) && ($_FILES['image']['error'] === 0)) {
          
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imagelink = uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $imagelink);
        }
    

    $data = [
            'nom' => $_POST['nom'],
            'type_id' => $_POST['type_id'],
            'places' => $_POST['places'],
            'description' => $_POST['description'],
            'date' => $_POST['date'],
            'duree' => $_POST['duree'],
            'image' => $imagelink
        ];

        if ($activitieModel->updateActivity($id, $data)) {
           
            header('Location: /activities/details/' . $id);
            exit;
        }
    }
    $types = $activitieModel->getTypes();
//ici je renvoie activities aussi pour pourvoir pre remplir les inputs
    $this->renderView('activities/update', [
        'activitie' => $activitie, 
        'types' => $types
    ]);

}





}
<?php
class ActivitiesController
{
use Render;

public function home()
{
   
    $activitieModel = new ActivitiesModel();
    $activities = $activitieModel->getAllActivities();

    $this->renderView('activities/home',  [
        'activities' =>  $activities,
        'title' => 'Accueil'
    ]);
}

public function details($id)
{
    $activitieModel = new ActivitiesModel();
    $activitie = $activitieModel->getActivityById($id);

    if(!$activitie){
         header('Location: /activities/home');
    }

    $this->renderView('activities/details',  [
        'activitie' =>  $activitie,
        'title' => 'Details'
    ]);
}
public function add()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /activities/home');
        exit;
    }

    $activitieModel = new ActivitiesModel();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $imagelink = '';

        if (isset($_FILES['image'])) {
          
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

        if ( $activitieModel->addActivity($data)) {
            header('Location: /activities/home');
            exit;
        }
    }
    $types =  $activitieModel->getTypes();

    $this->renderView('activities/add', [
        'types' => $types
    ]);
}

public function delete($id)
{
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /activities/home');
        exit;
    }
$activitieModel = new ActivitiesModel();
$activitieModel->deleteActivity($id);
header('Location: /activities/home');

}

public function update($id)
{
     if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /activities/home');
        exit;
    }

    $activitieModel = new ActivitiesModel();
    $activitie = $activitieModel->getActivityById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
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

    $this->renderView('activities/update', [
        'title' => 'Modifier l\'activité',
        'activitie' => $activitie, 
        'types' => $types
    ]);

}





}
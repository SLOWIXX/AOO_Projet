<?php
class ActivitiesController
{
use Render;

public function home()
{
    if (!isset($_SESSION['user'])) {
        header('Location: /user/login');
        exit;
    }
    $activitieModel = new ActivitiesModel();
    $activities = $activitieModel->getAllActivities();

    $this->renderView('activities/home',  [
        'activities' =>  $activities,
        'title' => 'Accueil'
    ]);
}

public function details($id)
{
    if (!isset($_SESSION['user'])) {
        header('Location: /user/login');
        exit;
    }

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

}
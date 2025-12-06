<?php

class ReservationController
{
    use Render; 

public function create($activityId)
{
    //verifie si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header('Location: /user/login');
        exit;
    }
    //J'utilise mes 2 model pour recup l'activité et rajouter une reservation 
    $activityModel = new ActivitiesModel();
    $reservationModel = new ReservationModel();
    $activity = $activityModel->getActivityById($activityId);
    //si l'activité a plus de place je redirige avec une erreur qui dit que c'est plein
    if (!$activity || $activity['places_disponibles'] <= 0) {
        header('Location: /activities/home?error=complet');
        exit;
    }
    //je recup l'id de l'utilisateur connecté
    $userId = $_SESSION['user']['id'];
    //j'appelle ma fonction de mon model pour créer la reservation et je lui file en paramettre l'id de l'activité et de l'utilisateur
    if ($reservationModel->createReservation($userId, $activityId)) {
        //je redirige
        header('Location: /reservation/home');
        exit;
    } 
}

// ma fonction pour afficher les reservation 
public function home()
{
    //je verifie si j'ai un user
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
        header('Location: /user/login');
        exit;
    }
        //je recup l'id de l'utilisateur connecter 
    $userId = $_SESSION['user']['id'];
    //j'utilise la fonction de mon model pour recup les activité reserver 
    $reservationModel = new ReservationModel();
    $reservations = $reservationModel->getReservationsByUserId($userId);

    //j'envoie les info a ma vue 
    $this->renderView('reservation/home', [
        'reservations' => $reservations
    ]);
}
// ma fonction pour annuler une reservation 
public function cancel($reservationId)
{
   //je verifie si y'a un user connecter 
    if (!isset($_SESSION['user']['id'])) {
        header('Location: /user/login');
        exit;
    }
//j'utilise mon model 
    $reservationModel = new ReservationModel();
    //Recupere la clé étrangere de la tables reservation 
    $details = $reservationModel->getReservationDetails($reservationId);
    //je stock l'id de l'activité dans une variable 
    $activityId = $details['activite_id'];
    //puis j'utilise ma fonction qui supprime la reservation et remet une place dans l'activité
    $reservationModel->deleteReservation($reservationId, $activityId);

    header('Location: /reservation/home');
    exit;
}
}
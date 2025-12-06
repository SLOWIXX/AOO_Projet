<?php

class ReservationController
{
    use Render; 

    public function create(int $activityId)
{

    if (!isset($_SESSION['user'])) {
        header('Location: /user/login');
        exit;
    }
    $activityModel = new ActivitiesModel();
    $reservationModel = new ReservationModel();
    $activity = $activityModel->getActivityById($activityId);
    
    if (!$activity || $activity['places_disponibles'] <= 0) {
        header('Location: /activities/home?error=full');
        exit;
    }

    $userId = $_SESSION['user']['id'];
    
    if ($reservationModel->createReservation($userId, $activityId)) {
        
        
        header('Location: /reservation');
        exit;
    } 
    
}
   
}
<?php
class ReservationModel extends Bdd
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createReservation(int $userId, int $activityId): bool
{

    $sql_insert = "INSERT INTO reservations (user_id, activite_id, date_reservation, etat) 
     VALUES (:user_id, :activity_id, NOW(), TRUE)"; 
    
    $stmt_insert = $this->co->prepare($sql_insert);
    $success_insert = $stmt_insert->execute([
        'user_id' => $userId,
        'activity_id' => $activityId
    ]);

    if ($success_insert) {
        $sql_update = "UPDATE activities SET places_disponibles = places_disponibles - 1 
                       WHERE id = :activity_id AND places_disponibles > 0";
                       
        $stmt_update = $this->co->prepare($sql_update);
        $success_update = $stmt_update->execute(['activity_id' => $activityId]);
        
        return $success_update;
    }
    return false; 
}


public function deleteReservations(int $activityId): bool
{
    $sql = "DELETE FROM reservations WHERE activite_id = :id";
    
    $stmt = $this->co->prepare($sql); 
    
    
    return $stmt->execute(['id' => $activityId]);
}


}
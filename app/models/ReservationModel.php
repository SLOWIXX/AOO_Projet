<?php
class ReservationModel extends Bdd
{
    public function __construct()
    {
        parent::__construct();
    }
//la j'ai ma fonction pour créer une reservation 
    public function createReservation($userId, $activityId): bool
{
//ma requete insert pour mettre dans la bdd la reservation avec les deux clé étrangere de mon user et de l'activité 
    $sql_insert = "INSERT INTO reservations (user_id, activite_id, date_reservation, etat) 
     VALUES (:user_id, :activity_id, NOW(), TRUE)"; 
    
    $stmt_insert = $this->co->prepare($sql_insert);
    $success_insert = $stmt_insert->execute([
        'user_id' => $userId,
        'activity_id' => $activityId
    ]);
//si ma requete reussie j'enleve une place dans l'activité grace a la requete ci-dessous 
    if ($success_insert) {
        $sql_update = "UPDATE activities SET places_disponibles = places_disponibles - 1 
                       WHERE id = :activity_id AND places_disponibles > 0";
                       
        $stmt_update = $this->co->prepare($sql_update);
        $success_update = $stmt_update->execute(['activity_id' => $activityId]);
        //je retourne le resultat de la deuxieme requete
        return $success_update;
    }
    //si la premiere requete marche pas je retourne false
    return false; 
}

//ma fonction pour annuler une reservation
public function deleteReservation($reservationId, $activityId): bool
{
    //Je supprime la reservation selon son id 
    $sql_delete = "DELETE FROM reservations WHERE id = :reservation_id";
    $stmt_delete = $this->co->prepare($sql_delete);
    $stmt_delete->execute(['reservation_id' => $reservationId]);
//je remet une place dans l'activité grace a l'id de l'activité
    $sql_update = "UPDATE activities SET places_disponibles = places_disponibles + 1 
            WHERE id = :activity_id";
    $stmt_update = $this->co->prepare($sql_update);
       
    return $stmt_update->execute(['activity_id' => $activityId]); 
}

//ici c'es ma function pour recup toute les reservation d'un user selon son id
public function getReservationsByUserId($userId): array
{
    //requete un peu compliquer :) qui join mes 3 tables user, reservation, et activities pour recup toute les info dont j'ai besoin pour l'affichage des reservation 
    //ici c'est une relation ManytoMany entre user et activities grace a la relation reservation 
    $sql = "SELECT 
            r.id AS reservation_id, 
            r.date_reservation, 
            r.activite_id,               
            a.nom AS activite_nom, 
            a.description,               
            a.places_disponibles,         
            a.datetime_debut,
            a.duree,
            a.image,
            t.nom AS nom_type            
        FROM 
            reservations r
        JOIN 
            activities a ON r.activite_id = a.id
        JOIN 
            type_activite t ON a.type_id = t.id 
        WHERE 
            r.user_id = :user_id
        ORDER BY 
            a.datetime_debut DESC";
                
    $stmt = $this->co->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    //Je retourne un tableau associatif
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//fonction pour avoir les clef etrangere de ma table reservation
public function getReservationDetails($reservationId): ?array
{
    //je recupere seulement les clef etrangere
    $sql = "SELECT user_id, activite_id FROM reservations WHERE id = :id";
    
    $stmt = $this->co->prepare($sql);
    $stmt->execute(['id' => $reservationId]);
    $details = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $details ?: null;
}



}
<?php

class ActivitiesModel extends Bdd
{
public function __construct()
{
parent::__construct();
}

public function getAllActivities(): array
 {
    $activities = $this->co->prepare('SELECT activities.*, type_activite.nom as nom_type FROM activities JOIN type_activite ON activities.type_id = type_activite.id');
    $activities->execute();

    return $activities->fetchAll(PDO::FETCH_ASSOC);
}


public function getActivityById(int $id) : array{
    $activitie = $this->co->prepare('SELECT activities.*, type_activite.nom as nom_type FROM activities 
            JOIN type_activite ON activities.type_id = type_activite.id WHERE activities.id = :id');
    $activitie->execute(['id' => $id]);
    $result = $activitie->fetch(PDO::FETCH_ASSOC);

    return $result ?: [];
}


public function addActivity(array $data): bool
{
    $sql = 'INSERT INTO activities (nom, type_id, places_disponibles, description, datetime_debut, duree, image) 
            VALUES (:nom, :type_id, :places, :description, :date, :duree, :image)';
    
    $stmt = $this->co->prepare($sql);
    
    return $stmt->execute([
        'nom' => $data['nom'],
        'type_id' => $data['type_id'],
        'places' => $data['places'],
        'description' => $data['description'],
        'date' => $data['date'],
        'duree' => $data['duree'],
        'image' => $data['image']
    ]);
}

public function getTypes(): array
{
    $stmt = $this->co->query('SELECT * FROM type_activite');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function deleteActivity(int $id): bool
{

    $reservationModel = new ReservationModel();
    $reservationModel->deleteReservations($id);
    $stmt = $this->co->prepare('DELETE FROM activities WHERE id = :id');
    return $stmt->execute(['id' => $id]);

}


public function updateActivity(int $id, array $data): bool
{
    $sql = 'UPDATE activities SET 
                nom = :nom, 
                type_id = :type_id, 
                places_disponibles = :places, 
                description = :description, 
                datetime_debut = :date, 
                duree = :duree, 
                image = :image 
            WHERE id = :id';
    
    $stmt = $this->co->prepare($sql);
    
    return $stmt->execute([
        'id' => $id,
        'nom' => $data['nom'],
        'type_id' => $data['type_id'],
        'places' => $data['places'],
        'description' => $data['description'],
        'date' => $data['date'],
        'duree' => $data['duree'],
        'image' => $data['image']
    ]);
}

public function getPlacesLeft(int $activityId): int
{
    
    $stmt_places = $this->co->prepare("SELECT places_disponibles FROM activities WHERE id = :id");
    $stmt_places->execute(['id' => $activityId]);
    $capacity = $stmt_places->fetchColumn(); 
    
    if (!$capacity) {
        return 0; 
    }

    $stmt_count = $this->co->prepare("SELECT COUNT(id) FROM reservations WHERE activite_id = :id AND etat = TRUE");
    $stmt_count->execute(['id' => $activityId]);
    $reservedCount = $stmt_count->fetchColumn();

    return $capacity - $reservedCount;
}
}
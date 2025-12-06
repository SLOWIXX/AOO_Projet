<?php

class ActivitiesModel extends Bdd
{
public function __construct()
{
parent::__construct();
}
//ici c'est ma fonction pour qui me permet de recup toutes les activitées de la bdd
public function getAllActivities(): array
 {
    //ici j'ai du faire un join car je voulais le type de l'activité donc je l'ai fait la ou type_id est a l'id de la table type_activité
    $activities = $this->co->prepare('SELECT activities.*, type_activite.nom as nom_type FROM activities 
    JOIN type_activite ON activities.type_id = type_activite.id');
    $activities->execute();

    return $activities->fetchAll(PDO::FETCH_ASSOC);//je retourne un tableau associatif 
}

//ici c'est ma fonction qui recup seulement une activité grace a son id 
public function getActivityById($id) : array{
    //meme requete sauf que j'ai un where pour recup seulement une activité selon l'id
    $activitie = $this->co->prepare('SELECT activities.*, type_activite.nom as nom_type FROM activities 
    JOIN type_activite ON activities.type_id = type_activite.id WHERE activities.id = :id');
    $activitie->execute(['id' => $id]);
    $result = $activitie->fetch(PDO::FETCH_ASSOC);

    return $result ?: [];
}

//ici c'est ma fonction pour rajouter une activité
public function addActivity($data): bool
{
    //ma requete pour inserer chaque element de mon form au bonne endroit dans la bdd
    $sql = 'INSERT INTO activities (nom, type_id, places_disponibles, description, datetime_debut, duree, image) 
            VALUES (:nom, :type_id, :places, :description, :date, :duree, :image)';
    
    $stmt = $this->co->prepare($sql);
    //je retourne le resultat de ma requete avec les donnée du form
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
//pour recup les type d'activité et les mettre dans mon select
public function getTypes(): array
{
    $stmt = $this->co->query('SELECT * FROM type_activite');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//ma fonction pour supprimer une activité de la bdd 
public function deleteActivity($id): bool
{
  //je supprime dans un premier temps les reservation lié a l'activité que je veut enlever 
    $sql_delete_reservations = "DELETE FROM reservations WHERE activite_id = :activity_id";
    $stmt_delete_reservations = $this->co->prepare($sql_delete_reservations);
    $stmt_delete_reservations->execute(['activity_id' => $id]); 
   //dans un deuxieme temps je supprime l'activité grace a son id 
    $sql_delete_activity = "DELETE FROM activities WHERE id = :id";
    $stmt_delete_activity = $this->co->prepare($sql_delete_activity);
    
    
    return $stmt_delete_activity->execute(['id' => $id]);
}

//ma fonction pour mettre a jour une activité 
public function updateActivity($id, $data): bool
{
    //ici c'est ma requete pour mettre a jour chaque element selon les element du form set selon l'id de l'activité
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
    //je retourne le resultat de ma requete avec les donnée du form et l'id de l'activité
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
//Ma fonction qui verifie en bdd commbien de place y a dans une activité 
public function getPlacesLeft(int $activityId): int
{
    //grace a l'id de l'acivité je recup le nombre de place total
    $stmt_places = $this->co->prepare("SELECT places_disponibles FROM activities WHERE id = :id");
    $stmt_places->execute(['id' => $activityId]);
    $capacity = $stmt_places->fetchColumn(); 
    //si c'est null je retourne 0
    if (!$capacity) {
        return 0; 
    }
    //compte le nombre de reservation dans l'activité
    $stmt_count = $this->co->prepare("SELECT COUNT(id) FROM reservations WHERE activite_id = :id AND etat = TRUE");
    $stmt_count->execute(['id' => $activityId]);
    $reservedCount = $stmt_count->fetchColumn();
  //et la ducoup j'ai le nombre de place restante
    return $capacity - $reservedCount;
}
}
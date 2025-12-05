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
    $activitie = $this->co->prepare('SELECT * FROM activities WHERE id = :id LIMIT 1');
    $activitie->execute(['id' => $id]);
    $result = $activitie->fetch(PDO::FETCH_ASSOC);

    return $result ?: [];
}
}
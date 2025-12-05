<?php
class Activities{
private int $id;
private string $nom;
private int $type_id;
private int $places_disponibles;
private string $description;
private string $datetime_debut ;
private string $duree;


public function getId() : int
{
    return $this->id;
}

public function getNom() : string
{
    return $this->nom;
}

public function getType() : int
{
    return $this->type_id;
}

public function getPlaces() : int
{
    return $this->places_disponibles;
}

public function getDescription() : string
{
    return $this->description;
}

public function getDate() : Datetime
{
    return new DateTime ($this->datetime_debut);
}

public function getDuree() : int
{
    return $this->duree;
}


}
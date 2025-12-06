<?php
class User //je crées ici une classe user 
{
    private int $id;
    private string $email;
    private string $password; 
    private string $prenom;
    private string $nom;
    private string $role;
    //la je mets tout les variables qui sont dans ma table user et je fait les getter et setter pour chacun 

 public function getId(): int
 {
  return $this->id;
 }


 public function getEmail(): string
 {
  return $this->email;
 }

public function getPrenom(): string
{
 return $this->prenom;
}


public function getNom(): string
{
 return $this->nom;
}

public function getRole(): string
{
 return $this->role;
}

 public function getPassword(): string
 {
  return $this->password;
 }
}

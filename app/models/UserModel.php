<?php
//Pour reseumer se fichier ressemble toutes les requete sql qui vont concerner mon utilisateur 
// et va lier les données de ma bdd avec la classe user  
class UserModel extends Bdd
{

 public function __construct()
 {
  parent::__construct();
 }
//la je recupere tout les utilisateur 
public function findAll(): array
{
$users = $this->co->prepare('SELECT * FROM Users');
$users->execute();

return $users->fetchAll(PDO::FETCH_CLASS, 'User');
}

//la je recupere mon utilisateur grace a son id (sert a rien car j'utilise l'email pour ca)
public function findOneById(int $id): User | false
{
$users = $this->co->prepare('SELECT * FROM Users WHERE id = :id LIMIT 1');
$users->setFetchMode(PDO::FETCH_CLASS, 'User');
$users->execute([
'id' => $id
]);

return $users->fetch();
}

//ici je crée une fonction qui fait du sql pour rajouter un utilisateur dan la bdd
public function create(string $nom, string $prenom, string $email, string $password): bool
{
    try {
        $req = $this->co->prepare('INSERT INTO users (nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)');
        
        return $req->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $password
        ]);
    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}

//ici je crée une fonction qui compare l'email d'un form avec celui da la bdd
    public function findByEmail(string $email)
{
    $stmt = $this->co->prepare('SELECT * FROM users WHERE email = :email');//la requete ici sert a chercher dans ma table user tout les données de l'utilisateur qui a cet email 
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');//je cree un objet avec la class user avec  tout se qui concerne cette utilisateur dans ma bdd
    $stmt->execute(['email' => $email]);

    return $stmt->fetch();
}

}

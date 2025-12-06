<?php
require_once './app/utils/Render.php';

class UserController
{
use Render;
public function findAll(): void
{
$userModel = new UserModel();
$users = $userModel->findAll();

// Prépatation du tableau à envoyer au layout
$data = [
    'title' => 'Liste des utilisateurs',
    'users' => $users
];

// Rendu avec layout
$this->renderView('user/all', $data);
}

public function findOneById(int $id): void
{
$userModel = new UserModel();
$user = $userModel->findOneById($id);

// Prépatation du tableau à envoyer au layout
$data = [
    'title' => 'Un utilisateur',
    'user' => $user
];

// Rendu avec layout
$this->renderView('user/one', $data);
}

public function register(): void
{
// Si j'ai un post d'un formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //je recupere les valeur du form
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hashage du mot de passe 
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);


    //la je vais utiliser mon model et lui donner les valeur du form 
    // puis j'appelle ma fonction create du model pour ajouter l'utilisateur dans ma bdd et donner a l'utilisateur la classe user
    $userModel = new UserModel();
    if ($userModel->create($nom, $prenom, $email, $passwordHash)) {
        // Redirection si ça marche (vers la liste ou login)
        header('Location: /user/login'); 
        exit;
    } else {
        $error = "Erreur lors de l'inscription.";
    }
}

$this->renderView('user/register',);
}







public function login(): void
{
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userModel = new UserModel();
    $user = $userModel->findByEmail($email);


if ($user && password_verify($password, $user->getPassword())) { 
    $_SESSION['user'] = [
        'id' => $user->getId(),
        'email' => $user->getEmail(),
        'prenom' => $user->getPrenom(),
        'nom' => $user->getNom(),
        'role' => $user->getRole()
    ];
    header('Location: /activities/home');
    exit;
} else {
    $error = "Identifiants incorrects.";
}
}

$this->renderView('user/login', [
    'title' => 'Connexion',
    'error' => $error
]);
}

public function logout(): void
{
session_destroy();
header('Location: /activities/home');

}

}

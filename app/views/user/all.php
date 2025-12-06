<?php
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /activities/home');
        exit;
    }
echo "<h1>Liste des utilisateurs</h1>";
if (count($users) > 0) {
 foreach ($users as $user) {
  echo '<h2>' . $user->getEmail() . '</h2>';
 }
} else {
 echo '<p>Aucun utilisateur</p>';
}

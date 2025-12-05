<!DOCTYPE html>
<html lang="fr">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?= $title ?? 'Mon titre par défaut' ?></title>
 <link rel="stylesheet" href="/app/views/css/style.css">
 
</head>

<body>
 <header>
    <h1>Bienvenue dans Eveny</h1>
    <div class="droite-header">
    <nav>
        <a href="../activities/home">Accueil</a>
        <a href="../activities">Mes reservation</a>
    </nav>
    
    <a href="../User/register"><button class="button-secondary">Inscription</button></a>
    <a href="../User/login"><button>Connexion</button></a>
    </div>
 </header>

 <main>
  <?= $content ?? '<p>Aucun contenu à afficher</p>' ?>
 </main>

 <footer>
  <p>Tous droits réservés</p>
 </footer>
</body>

</html>
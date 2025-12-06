<!DOCTYPE html>
<html lang="fr">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?= $title ?? 'Eveny' ?></title>
 <link rel="stylesheet" href="/app/views/css/style.css">
 
</head>

<body>
 <header>
     <!-- Ici c'est mon header qui va etre charger sur tout le site -->
    <h1>Bienvenue dans Eveny</h1>
    <div class="droite-header">
    <nav>
        <!-- Je gere les bouton selon si l'utilisateur est connecter -->
        <a href="../../activities/home">Accueil</a>
        <?php if (!isset($_SESSION['user'])): ?>
        <a href="../../User/login">Mes reservation</a>
        <?php else: ?>
            <a href="../../reservation/home">Mes reservation</a>
        <?php endif; ?>
    </nav>
    
    <?php if (!isset($_SESSION['user'])): ?>
    <a href="../User/register"><button class="button-secondary">Inscription</button></a>
    <a href="../User/login"><button>Connexion</button></a>
    <?php else: ?>
         <!-- Si l'utilisateur est admin il a un boutton ajout dans le header qui apparait-->
        <?php if ($_SESSION['user']['role'] == 'admin'): ?>
            <a href="../../activities/add"><button class="button-secondary">ajouter</button></a>
        <?php endif; ?>
        <a href="../../../User/logout"><button>Déconnexion</button></a>
    <?php endif; ?>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Bienvenue <?= $_SESSION['user']['prenom'] ?> !</h2>

    
        
        <div class="activity">
            <a href="../../activities/home">Retour</a>
            <h3><?= $activitie['nom']?></h4>
            <p><?= $activitie['description'] ?></p>
            <p>Places : <?= $activitie['places_disponibles']?></p>
            <p>Date : <?= $activitie['datetime_debut']?></p>
        </div>
        

</body>


</html>
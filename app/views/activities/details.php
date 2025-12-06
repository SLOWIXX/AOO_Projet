
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="body-details">
    <!--Pareil que home sauf que je boucle pas j'affiche que l'activité qui a son id dans l'url -->
        <a href="../../activities/home"><img src="/images/Back.png" alt=""></a>
        <div class="activity activity-details">
            <div class="activity-gauche">
            <img src="/images/<?= $activitie['image'] ?>" style="width: 100%; border-radius: 26px; ">
            <a href="../../reservation/create/<?= $activitie['id'] ?>" class="bouton-details"><button class="Bouton-principal bouton-details">Reserver</button></a>
            </div>
            
            <div class="activity-info ">
                <div class="align">
                <h3 class="title"><?= $activitie['nom']?></h4>
                <p>Durée : <?= $activitie['duree']?> min</p>
                </div>
            
            <div class="description description-details">
                <p class="date " > Prevu pour le : <?= $activitie['datetime_debut'] ?></p>

            <p><?= $activitie['description'] ?></p>
            </div>
           
            <div class="bas_activity align">  
                 <div class="type type-details">
                    <p><?= $activitie['nom_type']?> </p>
                </div>
                  <p> Nombre de places : <?= $activitie['places_disponibles']?></p>    
            </div>
            </div>
        </div>
        

</body>


</html>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
     <?php foreach ($reservations as $reservation): ?>
       
        <div class="activity">
            <img src="/images/<?= $reservation['image'] ?>">
            <div class="haut-activity">
                <h3><?= $reservation['activite_nom']?></h4>
                <p class="date"><?= date('d/m/Y', strtotime($reservation['datetime_debut'])) ?></p>
            </div>
            <div class="description">
            <p><?= mb_strimwidth($reservation['description'], 0, 200, "...") ?></p>
            </div>
            <div class="type">
                <p><?= $reservation['nom_type']?> </p>
            </div>
            <div class="bas_activity">
                <div class="iconText">
                    <img src="/images/Time_Span.png"><p><?= $reservation['duree']?> min</p>
                    <img src="/images/Person.png" style="margin-bottom: 4px;"><p><?= $reservation['places_disponibles']?></p>
                </div>
                <a href="/reservation/cancel/<?= $reservation['reservation_id'] ?>"><button class="Bouton-principal button-delete">Annuler</button></a>   
            </div>
        </div>
        
    <?php endforeach; ?>
</div>


</body>


</html>
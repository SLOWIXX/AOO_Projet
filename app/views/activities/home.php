
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
     <?php foreach ($activities as $activity): ?>
       
        <div class="activity">
            <img src="/images/<?= $activity['image'] ?>">
            <div class="haut-activity">
                <h3><?= $activity['nom']?></h4>
                <p class="date"><?= date('d/m/Y', strtotime($activity['datetime_debut'])) ?></p>
            </div>
            <div class="description">
            <p><?= mb_strimwidth($activity['description'], 0, 200, "...") ?></p>
            </div>
            <div class="type">
                <p><?= $activity['nom_type']?> </p>
            </div>
            <div class="bas_activity">
                <div class="iconText">
                    <img src="/images/Time_Span.png"><p><?= $activity['duree']?> min</p>
                    <img src="/images/Person.png" style="margin-bottom: 4px;"><p><?= $activity['places_disponibles']?></p>
                </div>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
            <a href="../../activities/delete/<?= $activity['id'] ?>"><button class="button-delete ">supprimer</button></a>
            <a href="/activities/update/<?= $activity['id'] ?>"><button class="Bouton-principal">Modifier</button></a>
        <?php endif; ?>
            <?php if (!isset($_SESSION['user']) || $_SESSION['user']['role'] === 'user'): ?>
                <a href="/activities/details/<?= $activity['id'] ?>"><button class="Bouton-principal">Reserver</button></a>
            <?php endif; ?>
                
            </div>
        </div>
        
    <?php endforeach; ?>
</div>


</body>


</html>


<main class="loginRegister">
    
<form  class="formulaire" action="" method="POST" enctype="multipart/form-data">
    <h1 style="margin-bottom:20px;">Modification : "<?= $activitie['nom'] ?>"</h1>
    
        <label for="nom">Nom de l'activité</label>
        <input type="text" name="nom" id="nom" value="<?= $activitie['nom'] ?>" required>

    
        <label for="type_id">Type</label>
        <select name="type_id" id="type_id" style="width: 80%; border-radius:6px;" required>
            <?php foreach ($types as $type): ?>
                <option value="<?= $type['id'] ?>"><?= $type['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    

    
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="5" style="width: 80%; border-radius:6px;" required><?= $activitie['description'] ?></textarea>
    

    
        <label for="date">Date et Heure de début</label>
        <input type="datetime-local" name="date" id="date" required>
    

    
        <label for="duree">Durée (en minutes)</label>
        <input type="number" name="duree" id="duree"  value="<?= $activitie['duree'] ?>"  required>
    

    
        <label for="places">Nombre de places</label>
        <input type="number" name="places" id="places"  value="<?= $activitie['places_disponibles'] ?>" required>
    

    
        <label for="image">Image</label>
        <input type="file" name="image" id="image" accept="image/*"  >
                

    <button type="submit">Enregistrer l'activité</button>
</form>
</main>
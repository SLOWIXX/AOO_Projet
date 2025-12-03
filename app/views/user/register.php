<h1>Inscription</h1>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    

<link rel="stylesheet" href="../css/style.css">
<form action="../user/register" method="POST">
    
    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
    <br>

    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" placeholder="Nom" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>
    <br>

    <button type="submit">S'inscrire</button>
</form>
</body>

<p>Vous avez déjà un compte ? <a href="/user/login">Connectez-vous ici</a></p>
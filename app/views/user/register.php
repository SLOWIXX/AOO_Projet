
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<main class="loginRegister">
<form class="formulaire" action="../user/register" method="POST">
    <h1>Inscription</h1>
    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
    <br>

    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" placeholder="Nom" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Email" required>
    <br>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
    <br>

    <button type="submit">S'inscrire</button>
    <p class="black">Vous avez déjà un compte ? <a href="/user/login">Connectez-vous ici</a></p>
</form>
</main>
</body>


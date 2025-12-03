<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <form action="/register" method="POST" class="register-form">
            <h1 class="h1">Inscription</h1>

        <label for="nom" class="label">Nom:</label>
        <input type="text" id="nom" class="input" name="nom" required>
        <br>
        <label for="prenom" class="label">Prénom:</label>
        <input type="text" id="prenom" class="input" name="prenom" required>
        <br>
        <label for="email" class="label">Email:</label>
        <input type="email" id="email" class="input" name="email" required>
        <br>
        <label for="password" class="label">Password:</label>
        <input type="password" id="password" class="input" name="password" required>
        <br>
        <button type="submit" class="submit-button">Register</button>
    </form>

    <p>Vous avez déja un compte ? <a href="./login.php">Connectez-vous ici</a></p>


</body>
</html>
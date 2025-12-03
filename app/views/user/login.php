<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Login</h1>
    <form action="../user/login" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password" class="label">Password:</label>
        <input type="password" id="password" name="password" class="input" required>
        <br>
        <button type="submit" class="submit-button">Login</button>
    </form>

    <p>C'est votre première connexion ? <a href="./register.php">S'inscrire</a></p>

</body>
</html>

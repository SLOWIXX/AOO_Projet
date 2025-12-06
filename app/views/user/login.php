<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    
</head>
<body>
    <main class="loginRegister">
    <h1>Login</h1>
    <form class="formulaire" action="../user/login" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
        <p class="black">C'est votre première connexion ? <a href="/user/login">Connectez-vous ici</a></p>
    </form>

    
    

</body>
</main>
</html>

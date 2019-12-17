<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>- Livres - <?php echo $title; ?></title>
    <link rel="stylesheet" href="/style.css">
    <script src="https://kit.fontawesome.com/c1d0ab37d6.js" crossorigin="anonymous"></script>
</head>
<body class="bg-purple-100 text-gray-900">
    <header class="bg-purple-500 border-t-8 border-purple-900 text-white">
        <div class="container mx-auto flex justify-between">
            <a href="/" class="p-4 hover:bg-purple-600 text-2xl font-bold">Mes Livres</a>
            <nav class="flex">
                <?php if (isLogin()): ?>
                    <a href="/logout" class="p-4 hover:bg-purple-600 flex items-center">Déconnexion</a>
                <?php else: ?>
                    <a href="/login" class="p-4 hover:bg-purple-600 flex items-center">Login</a>
                    <a href="/register" class="p-4 hover:bg-purple-600 flex items-center">Register</a>
                <?php endif; ?>
                <a href="/livres" class="p-4 hover:bg-purple-600 flex items-center">Voir Livres</a>
            </nav>
        </div>
    </header>
​
    <main class="container mx-auto p-4">
        <?php echo $content; ?>
    </main>
</body>
</html>
<?php
unset($_SESSION['errors']);
unset($_SESSION['old']);

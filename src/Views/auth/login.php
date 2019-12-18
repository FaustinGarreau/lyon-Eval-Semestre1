<?php
$title = "Connexion";
ob_start();
?>

<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">

    <h1 class="mb-8 text-2xl font-bold">Connexion</h1>
    <div class="card bg-white rounded shadow relative border-l-4 border-purple-900">
        <form action="/login" method="post">
            <header class="p-4 flex items-center">
                <label for="username"><i class="fas fa-user mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="username" type="text" name="username" value="<?php echo old("username"); ?>" class="rounded border py-2 px-4 w-full" placeholder="Votre nom">
                    <span class="text-red-500 font-bold"><?php echo error("username"); ?></span>
                </div>
            </header>
            <div class="p-4 flex items-center border-t">
                <label for="password"><i class="fas fa-key mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="password" type="password" name="password" value="" class="rounded border py-2 px-4 w-full" placeholder="Mot de passe">
                    <span class="text-red-500 font-bold"><?php echo error("password"); ?></span>
                </div>
            </div>
            <footer class="p-4 flex justify-between items-center">
                <a href="/login" class="underline text-blue-500">Vous n'avez pas de compte ?</a>
                <div class="actions flex text-white">
                    <button type="submit" class="bg-green-500 py-2 px-4 rounded">Se Connecter</button>
                </div>
            </footer>
        </form>
    </div>
</div>

<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';
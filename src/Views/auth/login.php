<?php
$title = "Login";
ob_start();
?>

<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">

    <h1 class="mb-8 text-2xl font-bold"><i class="fas fa-user-tie mr-4 text-purple-900"></i>Connexion au Compte</h1>
    <div class="card bg-white rounded shadow relative">
        <form action="/login" method="post">
            <header class="p-4 flex items-center">
                <label for="username"><i class="fas fa-user mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input type="text" name="username" value="<?php echo old("username");?>" class="rounded border py-2 px-4 w-full"  placeholder="username">
                    <span class="text-red-500 font-bold"><?php echo error("username");?></span>
                </div>
            </header>
            <div class="p-4 flex items-center border-t">
                <label for="password"><i class="fas fa-key mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input type="password" name="password" value="<?php echo old("password");?>" class="rounded border py-2 px-4 w-full" placeholder="password">
                    <span class="text-red-500 font-bold"><?php echo error("password");?></span>
                </div>
            </div>
            <span class="text-red-500 font-bold"><?php echo error("message");?></span>
            <footer class="p-4 flex justify-between items-center">
                <div class="flex">
                    <p class="text-blue-500">Vous n'avez pas de compte : <a href="/register" class="text-purple-900 underline">Créez le</a></p>
                </div>
                <div class="actions flex text-white">
                    <button type="submit" class="bg-green-500 py-2 px-4 rounded">Connexion</button>
                </div>
            </footer>
        </form>
    </div>
</div>

<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';

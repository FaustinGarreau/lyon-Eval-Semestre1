<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>
<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">
    <h1 class="mb-8 text-2xl font-bold"><i class="fas fa-book mr-4 text-purple-900"></i>Connexion</h1>
    <div class="card bg-white rounded shadow relative">
        <form action="/login" method="post">
            <div class="p-4 flex items-center border-t">
                <label for="username"><i class="fas fa-user mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="username" type="text" class="rounded border py-2 px-4 w-full" type="username" autocomplete="name" name="login" placeholder="e-mail ou nom d'utilisateur" required>
                    <span class="text-red-500 font-bold"><?php echo getError("author") ?></span>
                </div>
            </div>
            <div class="p-4 flex items-center border-t">
                <label for="password"><i class="fas fa-key mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="password" type="password" class="rounded border py-2 px-4 w-full" name="password" autocomplete="password" placeholder="Mot de passe" required>
                </div>
            </div>
            <footer class="p-4 flex justify-between items-center">
                <span class="text-red-500 font-bold"><?php echo getError("error") ?></span>
                <div class="actions flex text-white">
                    <button type="submit" class="bg-green-500 py-2 px-4 rounded">Connexion</button>
                </div>
            </footer>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require VIEWS.'layout.php'; ?>

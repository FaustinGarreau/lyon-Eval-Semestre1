<?php $title = 'Créer un compte'; ?>

<?php ob_start(); ?>
<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">
    <h1 class="mb-8 text-2xl font-bold"><i class="fas fa-book mr-4 text-purple-900"></i>Créer un compte</h1>
    <div class="card bg-white rounded shadow relative">
        <form action="/register" method="post">
            <div class="p-4 flex items-center border-t">
                <label for="username"><i class="fas fa-user mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="username" type="text" class="rounded border py-2 px-4 w-full" type="username" autocomplete="name" name="username" placeholder="Nom d'utilisateur" required>
                    <span class="text-red-500 font-bold"><?php echo getError("username") ?></span>
                </div>
            </div>
            <div class="p-4 flex items-center border-t">
                <label for="email"><i class="fas fa-envelope mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="email" type="email" class="rounded border py-2 px-4 w-full" type="email" autocomplete="email" name="email" placeholder="E-mail" required>
                    <span class="text-red-500 font-bold"><?php echo getError("email") ?></span>
                </div>
            </div>
            <div class="p-4 flex items-center border-t">
                <label for="password"><i class="fas fa-key mr-4 text-purple-900"></i></label>
                <div class="flex-grow flex">
                    <input id="password" type="password" class="rounded border py-2 mr-2 px-4 flex-grow" name="password" autocomplete="new-password" placeholder="Mot de passe" required>
                    <input id="password_repeat" type="password" class="rounded border py-2 ml-2 px-4 flex-grow" name="password_repeat" autocomplete="new-password" placeholder="Validation" required>
                    <span class="text-red-500 font-bold"><?php echo getError("password") ?></span>
                </div>
            </div>
            <footer class="p-4 flex justify-end items-center">
                <div class="actions text-white">
                    <button type="submit" class="bg-green-500 py-2 px-4 rounded">Créer mon compte</button>
                </div>
            </footer>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require VIEWS.'layout.php'; ?>

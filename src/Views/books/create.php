<?php
$title = "Créer un nouveau livre";
ob_start();
?>

<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">
    <h1 class="mb-8 text-2xl font-bold"><i class="fas fa-book mr-4 text-purple-900"></i>Créer un Livre</h1>
    <div class="card bg-white rounded shadow relative">
        <form action="/livres/nouveau" method="post">
            <header class="p-4 flex items-center">
                <label for="title"><i class="fas fa-heading mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="title" type="text" name="title" value="<?php echo old('newBook','title');?>" class="rounded border py-2 px-4 w-full" placeholder="Votre titre">
                    <?php error("newBook", "title"); ?>
                </div>
            </header>
            <div class="p-4 flex items-center border-t">
                <label for="author"><i class="fas fa-user mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="title" type="text" name="author" value="<?php echo old('newBook','author');?>" class="rounded border py-2 px-4 w-full" placeholder="Votre auteur">
                    <?php error("newBook", "author"); ?>
                </div>
            </div>
            <div class="content border-t border-b p-4 flex-grow flex items-center">
                <label for="description"><i class="fas fa-book-open mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <textarea name="description" id="description" rows="8" class="w-full rounded border py-2 px-4" placeholder="Votre description"><?php echo old('newBook','description');?></textarea>
                    <?php error("newBook", "description"); ?>
                </div>
            </div>
            <div class="p-4 flex border-b items-center">
                <label for="slug"><i class="fas fa-globe mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="slug" type="text" name="slug" value="<?php echo old('newBook','slug');?>" class="w-full rounded border py-2 px-4" placeholder="Votre URL">
                    <?php error("newBook", "slug"); ?>
                </div>
            </div>
            <footer class="p-4 flex justify-between items-center">
                <div class="flex">
                    <label for="date" class="mr-4"><i class="far fa-clock mr-4 font-bold text-purple-900"></i>Sortie le</label>
                    <div class="">
                        <input type="date" class="rounded border py-2 px-4" name="date" id="date" value="<?php echo old('newBook','date');?>">
                        <?php error("newBook", "data"); ?>
                    </div>
                </div>
                <div class="actions flex text-white">
                    <button type="submit" class="bg-green-500 py-2 px-4 rounded">Créer</button>
                </div>
            </footer>
        </form>
    </div>
</div>

<?php

unset($_SESSION["value"]["newBook"]);
unset($_SESSION["error"]["newBook"]);

$content = ob_get_clean();

require VIEWS . 'layout.php';
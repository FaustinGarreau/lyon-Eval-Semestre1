<?php
$title = "Créer une nouvelle catégorie";
ob_start();
?>

<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">


    <h1 class="mb-8 text-2xl font-bold"><i class="fas fa-bookmark mr-4 text-purple-900"></i>Créer une Catégorie</h1>

    <div class="card bg-white rounded shadow relative">
        <form action="/category/nouveau" method="post">
            <header class="p-4 flex items-center">
                <label for="title"><i class="fas fa-heading mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="category" type="text" name="category" value="<?php echo old('category');?>" class="rounded border py-2 px-4 w-full" placeholder="Votre categorie">
                    <span class="text-red-500 font-bold"><?php echo error("category");?></span>
                </div>
            </header>
            <footer class="p-4 flex justify-between items-center">
                <div class="flex">
                    <label for="slug"><i class="fas fa-globe mr-4 text-purple-900"></i></label>
                    <div class="flex-grow">
                        <input id="slug" type="text" name="slug" value="<?php echo old('slug');?>" class="w-full rounded border py-2 px-4" placeholder="URL categorie">
                        <span class="text-red-500 font-bold"><?php echo error("slug");?></span>
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

$content = ob_get_clean();

require VIEWS . 'layout.php';

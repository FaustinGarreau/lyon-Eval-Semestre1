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
                    <input id="title" type="text" name="title" value="<?php echo old('title');?>" class="rounded border py-2 px-4 w-full" placeholder="Votre titre">
                    <span class="text-red-500 font-bold"><?php echo error("title");?></span>
                </div>
            </header>
            <div class="p-4 flex items-center border-t">
                <label for="author"><i class="fas fa-user mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="title" type="text" name="author" value="<?php echo old('author');?>" class="rounded border py-2 px-4 w-full" placeholder="Votre auteur">
                    <span class="text-red-500 font-bold"><?php echo error("author");?></span>
                </div>
            </div>
            <div class="p-4 flex items-center border-t">
                <label for="author"><i class="fas fa-bookmark mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <select name="category">
                        <option value="">Choisissez une catégorie</option>
                        <?php
                            foreach ($categorys as $category) {
                                ?>
                                    <option value="<?php echo $category["id"]; ?>"><?php echo $category["category"]; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <span class="text-red-500 font-bold"><?php echo error("category");?></span>
                </div>
            </div>
            <div class="content border-t border-b p-4 flex-grow flex items-center">
                <label for="description"><i class="fas fa-book-open mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <textarea name="description" id="description" rows="8" class="w-full rounded border py-2 px-4" placeholder="Votre description"><?php echo old('description');?></textarea>
                    <span class="text-red-500 font-bold"><?php echo error("description");?></span>
                </div>
            </div>
            <div class="p-4 flex border-b items-center">
                <label for="slug"><i class="fas fa-globe mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="slug" type="text" name="slug" value="<?php echo old('slug');?>" class="w-full rounded border py-2 px-4" placeholder="Votre URL">
                    <span class="text-red-500 font-bold"><?php echo error("slug");?></span>
                </div>
            </div>
            <footer class="p-4 flex justify-between items-center">
                <div class="flex">
                    <label for="date" class="mr-4"><i class="far fa-clock mr-4 font-bold text-purple-900"></i>Sortie le</label>
                    <div>
                        <input type="date" class="rounded border py-2 px-4" name="date" id="date" value="<?php echo old('date');?>">
                        <span class="text-red-500 font-bold"><?php echo error("date");?></span>
                    </div>
                </div>
                <div class="actions flex text-white">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION["user"]["id"]; ?>">
                    <button type="submit" class="bg-green-500 py-2 px-4 rounded">Créer</button>
                </div>
            </footer>
        </form>
    </div>
</div>

<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';

<?php
$title = $category['title'];
ob_start();
?>

<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">
<h1 class="mb-8 text-2xl font-bold"><i class="fas fa-book mr-4 text-purple-900"></i>Editer une Category</h1>
    <div class="card bg-white rounded shadow relative border-l-4 border-purple-900">
        <form action="/category/<?php echo $category["slug"]; ?>" method="post">
            <header class="p-4 flex items-center">
                <label for="category"><i class="fas fa-heading mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="category" type="text" name="category" value="<?php echo isset($_SESSION["old"]) ? old("category") : escape($category["category"])?>" class="w-10/12 rounded border py-2 px-4">
                    <span class="text-red-500 font-bold w-full"><?php echo error("category"); ?></span>
                </div>
            </header>

            <footer class="p-4 flex justify-between items-center">
                <div class="flex">
                    <label for="slug"><i class="fas fa-globe mr-4 text-purple-900"></i></label>
                    <div class="flex-grow">
                        <input id="slug" type="text" name="slug" value="<?php echo isset($_SESSION["old"]) ? old("slug") : escape($category["slug"])?>" class="w-full rounded border py-2 px-4">
                        <span class="text-red-500 font-bold"><?php echo error("slug"); ?></span>
                    </div>
                </div>
                <div class="actions flex text-white">
                    <button type="submit" class="bg-green-500 w-10 h-10">OK</button>
                </div>
            </footer>
        </form>
        <form action="/category/<?php echo $category["slug"]; ?>/delete" method="post" class="absolute top-0 right-0 mt-4 mr-4 text-white">
            <button type="submit" class="ml-4 bg-red-500 w-10 h-10 flex justify-center items-center"><i class="fas fa-trash-alt"></i></button>
        </form>
    </div>
</div>

<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';

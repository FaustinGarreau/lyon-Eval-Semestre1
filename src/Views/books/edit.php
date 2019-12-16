<?php
$title = $book['title'];
ob_start();
?>

<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">
    <div class="card bg-white rounded shadow">
        <form action="/livres/<?php echo escape($book['slug']);?>" method="post">
            <header class="p-4 flex items-center">
                <label for="title"><i class="fas fa-heading mr-4 text-purple-900"></i></label>
                <input id="title" type="text" name="title" value="<?php echo escape($book['title']);?>" class="flex-grow rounded border py-2 px-4">
            </header>
            <div class="content border-t border-b p-4 flex-grow flex items-center">
                <label for="description"><i class="fas fa-book-open mr-4 text-purple-900"></i></label>
                <textarea name="description" id="description" rows="10" class="flex-grow rounded border py-2 px-4"><?php echo escape($book['description']);?></textarea>
            </div>
            <div class="p-4 flex border-b items-center">
                <label for="slug"><i class="fas fa-globe mr-4 text-purple-900"></i></label>
                <input id="slug" type="text" name="title" value="<?php echo escape($book['slug']);?>" class="flex-grow rounded border py-2 px-4">
            </div>
            <footer class="p-4 flex justify-between items-center">
                <div class="">
                    <label for="date"><i class="far fa-clock mr-4 font-bold text-purple-900"></i>Sortie le</label>
                    <input type="date" class="rounded border py-2 px-4" name="date" id="date" value="<?php echo escape(date('d/m/Y', strtotime($book['date']))); ?>">
                </div>
                <div class="actions flex text-white">
                    <button type="submit" class="bg-green-500 w-10 h-10">OK</button>
                    <form action="/livres/<?php echo escape($book['slug']);?>/delete" method="post">
                        <button type="submit" class="ml-4 bg-red-500 w-10 h-10 flex justify-center items-center"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>
            </footer>
        </form>
    </div>
</div>

<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';
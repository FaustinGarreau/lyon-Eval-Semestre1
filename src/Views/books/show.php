<?php
$title = $book['title'];
ob_start();
?>

<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">
    <div class="card bg-white rounded shadow border-l-4 border-purple-900">
        <header class="p-4 font-bold tracking-widest">
            <h3><i class="fas fa-heading mr-4 text-purple-900"></i><?php echo $book['title']; ?></h2>
        </header>
        <div class="content border-t p-4 flex-grow flex items-center">
            <i class="fas fa-user mr-4 text-purple-900"></i>
            <p><?php echo $book['author']; ?></p>
        </div>
        <div class="content border-t border-b p-4 flex-grow flex items-center break-all">
            <i class="fas fa-book-open mr-4 text-purple-900"></i>
            <?php echo $book['description']; ?>
        </div>
        <footer class="p-4 flex justify-between items-center">
            <p class="text-sm"><i class="far fa-clock mr-4 font-bold text-purple-900"></i><?php echo $book['date']; ?></p>
            <div class="actions flex">
                <a href="/livres/<?php echo $book['slug']; ?>/edit" class="w-10 h-10 bg-yellow-500 hover:bg-yellow-600 text-white flex justify-center items-center">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="/livres/<?php echo $book['slug']; ?>/delete" method="post">
                    <button type="submit" class="ml-4 bg-red-500 w-10 h-10 text-white flex justify-center items-center"><i class="fas fa-trash-alt"></i></button>
                </form>
            </div>
        </footer>
    </div>
</div>

<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';
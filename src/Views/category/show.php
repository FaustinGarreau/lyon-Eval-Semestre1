<?php
$title = "La category";
ob_start();
?>

<div>
    <h2 class="mb-8 text-2xl font-bold"><i class="fas fa-bookmark mr-4 text-purple-900"></i><?php echo $category["category"]; ?>
    </h2>
    <div class="flex flex-wrap -mx-4">

        <?php
            foreach ($books as $book) {
                ?>
                <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
                    <div class="card bg-white rounded shadow h-full flex flex-col border-l-4 border-purple-900">
                        <header class="p-4 font-bold tracking-widest">
                            <h3><i class="fas fa-heading mr-4 text-purple-900"></i><?php echo escape($book["title"]); ?></h2>
                        </header>
                        <div class="content border-t border-b p-4 flex-grow flex items-center">
                            <i class="fas fa-book-open mr-4 text-purple-900"></i>
                            <?php echo strlen($book['description']) > 100 ? escape(substr(escape($book['description']), 0 ,100)."...") : escape($book['description']);?>
                        </div>
                        <footer class="p-4 flex justify-between">
                            <p class="text-sm"><i class="far fa-clock mr-4 font-bold text-purple-900"></i><?php echo escape($book["date"]); ?></p>
                            <div class="actions">
                                <a href="/livres/<?php echo escape($book["slug"]); ?>" class="p-2 bg-blue-500 hover:bg-blue-600 text-white">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </footer>
                    </div>
                </div>
                <?php
            }
        ?>

    </div>
</div>

<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';

<?php
$title = "Tout les livres";
ob_start();
?>
<div class="mb-5">
    <h2 class="mb-8 text-2xl font-bold"><i class="fas fa-bookmark mr-4 text-purple-900"></i>Catégories
        <a href="category" class="py-2 px-4 bg-green-500 hover:bg-green-600 float-right text-white text-base rounded">Voir +</a>
    </h2>
    <div class="flex flex-wrap -mx-4">

        <?php
            foreach ($categoryFive as $category) {
                ?>
                    <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
                        <a href="/category/<?php echo escape($category["slug"]); ?>" class="pointer">
                            <div class="card bg-white rounded shadow h-full flex flex-col border-l-4 border-purple-900">
                                <header class="p-4 font-bold tracking-widest">
                                    <h3><i class="fas fa-bookmark mr-4 text-purple-900"></i><?php echo escape($category["category"]); ?></h2>
                                </header>
                            </div>
                        </a>
                    </div>
                <?php
            }
        ?>

    </div>
</div>

<div>
    <h2 class="mb-8 text-2xl font-bold"><i class="fas fa-book mr-4 text-purple-900"></i>Tout Les Livres
        <?php
            if (isset($_SESSION["user"])) {
                ?>
                    <a href="/livres/nouveau" class="py-2 px-4 bg-green-500 hover:bg-green-600 float-right text-white text-base rounded">Créer</a>
                <?php
            }
         ?>
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
                            <div class="content border-t p-4 flex-grow flex items-center">
                                <i class="fas fa-bookmark mr-4 text-purple-900"></i>
                                <?php echo escape($book["category"]); ?>
                            </div>
                            <div class="content border-t border-b p-4 flex-grow flex items-center">
                                <i class="fas fa-book-open mr-4 text-purple-900"></i>
                                <?php echo strlen($book['description']) > 100 ? escape(substr($book['description'], 0 ,100)."...") : $book['description'];?>
                            </div>
                            <footer class="p-4 flex justify-between">
                                <p class="text-sm"><i class="far fa-clock mr-4 font-bold text-purple-900"></i><?php echo $book["date"]; ?></p>
                                <div class="actions">
                                    <a href="/livres/<?php echo escape($book["bookSlug"]); ?>" class="p-2 bg-blue-500 hover:bg-blue-600 text-white">
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

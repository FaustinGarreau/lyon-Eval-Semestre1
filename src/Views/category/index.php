<?php
$title = "Toutes les catégories";
ob_start();
?>

<div>
    <h2 class="mb-8 text-2xl font-bold"><i class="fas fa-bookmark mr-4 text-purple-900"></i>Catégories
    </h2>
    <div class="flex flex-wrap -mx-4">

        <?php
            foreach ($categorys as $category) {
                ?>
                    <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
                        <a href="/category/<?php echo escape($category["slug"]); ?>" class="pointer">
                            <div class="card bg-white rounded shadow h-full flex flex-col border-l-4 border-purple-900">
                                <header class="p-4 font-bold tracking-widest">
                                    <h3><i class="fas fa-bookmark mr-4 text-purple-900"></i></i><?php echo escape($category["category"]); ?></h2>
                                </header>
                            </div>
                        </a>
                    </div>
                <?php
            }
        ?>

    </div>
</div>

<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';

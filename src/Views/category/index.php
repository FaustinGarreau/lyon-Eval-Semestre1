<?php
$title = "Toutes les catégories";
ob_start();
?>

<div>
    <h2 class="mb-8 text-2xl font-bold"><i class="fas fa-bookmark mr-4 text-purple-900"></i>Catégories
        <?php
            if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] == "admin") {
                ?>
                    <a href="/category/nouveau" class="py-2 px-4 bg-green-500 hover:bg-green-600 float-right text-white text-base rounded">Créer</a>
                <?php
            }
         ?>
    </h2>
    <div class="flex flex-wrap -mx-4">

        <?php
            foreach ($categorys as $category) {
                ?>
                    <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
                        <a href="/category/<?php echo escape($category["slug"]); ?>" class="pointer">
                            <div class="card bg-white rounded shadow h-full flex flex-col border-l-4 border-purple-900">
                                <header class="p-4 font-bold tracking-widest flex justify-between items-center">
                                    <h3><i class="fas fa-bookmark mr-4 text-purple-900"></i></i><?php echo escape($category["category"]); ?></h2>
                                    <?php
                                        if (isset($_SESSION["user"]) && ($book["user_id"] == $_SESSION["user"]["id"]) || $_SESSION["user"]["role"] == "admin") {
                                            ?>
                                                <div class="actions flex">
                                                    <a href="/category/<?php echo escape($category["slug"]); ?>/edit" class="w-10 h-10 bg-yellow-500 hover:bg-yellow-600 text-white flex justify-center items-center">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="/category/<?php echo escape($category["slug"]); ?>/delete" method="post">
                                                        <button type="submit" class="ml-4 bg-red-500 w-10 h-10 text-white flex justify-center items-center"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            <?php
                                        }
                                    ?>
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

<?php
$title = "Tout les livres";
ob_start();
?>
<h1 class="mb-8 text-2xl font-bold"><i class="fas fa-book mr-4 text-purple-900"></i>Tout Les Livres <a href="/nouveau" class="py-2 px-4 bg-green-500 hover:bg-green-600 float-right text-white text-base rounded">Créer</a></h1>
<div class="flex flex-wrap -mx-4">

    <?php
    foreach ($books as $data):
        // Sous windows, le %e doit être remplacé par %d
        $date = strftime("%e %B %G", strtotime(escape($data["date"])));
    ?>
        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
            <div class="card bg-white rounded shadow h-full flex flex-col border-l-4 border-purple-900">
                <header class="p-4 font-bold tracking-widest">
                    <h3><i class="fas fa-heading mr-4 text-purple-900"></i><?php echo escape($data["title"]) ?></h2>
                </header>
                <div class="content border-t border-b p-4 flex-grow flex items-center">
                    <i class="fas fa-book-open mr-4 text-purple-900"></i>
                    <?php echo substr(escape($data["description"]), 0, 30) . (strlen(escape($data["description"])) > 30 ? "..." : ""); ?>
                </div>
                <footer class="p-4 flex justify-between">
                    <p class="text-sm"><i class="far fa-clock mr-4 font-bold text-purple-900"></i>Sortie le <?php echo $date ?></p>
                    <div class="actions">
                        <a href="/livres/<?php echo escape($data["slug"]) ?>" class="p-2 bg-blue-500 hover:bg-blue-600 text-white">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </footer>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';

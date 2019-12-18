<?php
$title = "Tout les livres";
ob_start();
?>
<div class="mb-8 flex justify-between">
    <div class="flex">
        <h1 class="text-2xl font-bold mr-8"><i class="fas fa-book mr-4 text-purple-900"></i>Tout Les Livres</h1>
        <form action="/livres/category" method="post" class="flex flex items-center">
            <label for="category"><i class="fas fa-bookmark mr-4 text-purple-900"></i></label>
            <div class="flex-grow mr-8">
                <select id="category" name="category" class="block appearance-none rounded border py-2 px-4 w-full">
                    <option value="" selected disabled>Choisissez une category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value=<?php echo $category["id"]; ?> <?php echo escape($category["id"]);?>><?php echo escape($category["category"]); ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="text-red-500 font-bold"><?php echo error("category"); ?></span>
            </div>
            <div class="actions flex text-white">
                <button type="submit" class="bg-purple-500 py-2 px-4 rounded">Search</button>
            </div>
        </form>
    </div>

    <a href="/livres/nouveau" class="py-2 px-4 bg-green-500 hover:bg-green-600 self-end text-white text-base rounded">Créer</a>
</div>
<div class="flex flex-wrap -mx-4">
    <?php foreach ($books as $book): ?>
        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-4">
            <div class="card bg-white rounded shadow h-full flex flex-col border-l-4 border-purple-900">
                <header class="p-4 font-bold tracking-widest">
                    <h3><i class="fas fa-heading mr-4 text-purple-900"></i><?php echo $book["title"] ?></h2>
                </header>
                <div class="content border-t border-b p-4 flex-grow flex items-center">
                    <i class="fas fa-book-open mr-4 text-purple-900"></i>
                    <?php echo substr($book["description"],0,50).(strlen($book["description"]) >50 ? ". . ." : ""); ?>
                </div>
                <footer class="p-4 flex justify-between">
                    <p class="text-sm"><i class="far fa-clock mr-4 font-bold text-purple-900"></i>Sortie le <?php echo strftime("%a %d %b %G", strtotime($book["date"])); ?></p>
                    <div class="actions">
                        <a href="/livres/<?php echo $book["slug"] ?>" class="p-2 bg-blue-500 hover:bg-blue-600 text-white rounded">
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

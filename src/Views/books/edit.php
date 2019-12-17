<?php
$bookInfo = getBook();
$title = $bookInfo['title'];
ob_start();
?>

<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">
<h1 class="mb-8 text-2xl font-bold"><i class="fas fa-book mr-4 text-purple-900"></i>Editer un Livre</h1>
    <div class="card bg-white rounded shadow relative border-l-4 border-purple-900">
        <form action="/livres/<?php echo $bookInfo["slug"]; ?>/edit" method="post">
            <input type="hidden" name="id" value="<?php echo $bookInfo["id"]; ?>"/>
            <input type="hidden" name="url" value="/livres/<?php echo $bookInfo["slug"]; ?>/edit"/>
            <header class="p-4 flex items-center">
                <label for="title"><i class="fas fa-heading mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="title" type="text" name="title" value="<?php echo isset($_SESSION["value"]["editBook"]["title"]) ? old("editBook", "title"): $bookInfo["title"]; ?>" class="w-10/12 rounded border py-2 px-4">
                    <?php error("editBook", "title"); ?>
                </div>
            </header>
            <div class="p-4 flex items-center border-t">
                <label for="author"><i class="fas fa-user mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="title" type="text" name="author" value="<?php echo isset($_SESSION["value"]["editBook"]["author"]) ? old("editBook", "author"): $bookInfo["author"]; ?>" class="rounded border py-2 px-4 w-full" placeholder="Votre auteur">
                    <?php error("editBook", "author"); ?>
                </div>
            </div>
            <div class="content border-t border-b p-4 flex-grow flex items-center">
                <label for="description"><i class="fas fa-book-open mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <textarea name="description" id="description" rows="10" class="w-full rounded border py-2 px-4"><?php echo isset($_SESSION["value"]["editBook"]["description"]) ? old("editBook", "description"): $bookInfo["description"]; ?></textarea>
                    <?php error("editBook", "description"); ?>
                </div>
            </div>
            <div class="p-4 flex border-b items-center">
                <label for="slug"><i class="fas fa-globe mr-4 text-purple-900"></i></label>
                <div class="flex-grow">
                    <input id="slug" type="text" name="slug" value="<?php echo isset($_SESSION["value"]["editBook"]["slug"]) ? old("editBook", "slug"): $bookInfo["slug"]; ?>" class="w-full rounded border py-2 px-4">
                    <?php error("editBook", "slug"); ?>
                </div>
            </div>
            <footer class="p-4 flex justify-between items-center">
                <div class="flex">
                    <label for="date" class="mr-4"><i class="far fa-clock mr-4 font-bold text-purple-900"></i>Sortie le</label>
                    <div class="flew-grow">
                        <input type="date" class="rounded border py-2 px-4" name="date" id="date" value="<?php echo isset($_SESSION["value"]["editBook"]["date"]) ? old("editBook", "date"): $bookInfo["date"]; ?>">
                        <?php error("editBook", "date"); ?>
                    </div>
                </div>
                <div class="actions flex text-white">
                    <button type="submit" class="bg-green-500 w-10 h-10">OK</button>
                </div>
            </footer>
        </form>
        <form action="/livres/<?php echo $bookInfo["slug"]; ?>/delete" method="post" class="absolute top-0 right-0 mt-4 mr-4 text-white">
            <input type="hidden" name="id" value="<?php echo $bookInfo["id"]; ?>"/>
            <button type="submit" class="ml-4 bg-red-500 w-10 h-10 flex justify-center items-center"><i class="fas fa-trash-alt"></i></button>
        </form>
    </div>
</div>

<?php
unset($_SESSION["value"]["editBook"]);
unset($_SESSION["error"]["editBook"]);

$content = ob_get_clean();

require VIEWS . 'layout.php';
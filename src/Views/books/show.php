<?php
$bookInfo = getBook();
$title = $bookInfo['title'];
ob_start();
?>

<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">
    <div class="card bg-white rounded shadow border-l-4 border-purple-900">
        <header class="p-4 font-bold tracking-widest">
            <h3><i class="fas fa-heading mr-4 text-purple-900"></i><?php echo $bookInfo["title"]; ?></h2>
        </header>
        <div class="content border-t p-4 flex-grow flex items-center">
            <i class="fas fa-user mr-4 text-purple-900"></i>
            <p><?php echo $bookInfo["author"]; ?></p>
        </div>
        <div class="content border-t border-b p-4 flex-grow flex items-center">
            <i class="fas fa-book-open mr-4 text-purple-900"></i>
            <?php echo $bookInfo["description"]; ?>
        </div>
        <footer class="p-4 flex justify-between items-center">
            <p class="text-sm"><i class="far fa-clock mr-4 font-bold text-purple-900"></i><?php echo $bookInfo["date"]; ?></p>
            <?php
                if (isset($_SESSION["user"])) {
                    ?>
                        <div class="actions flex">
                            <a href="/livres/<?php echo $bookInfo["slug"]; ?>/edit" class="w-10 h-10 bg-yellow-500 hover:bg-yellow-600 text-white flex justify-center items-center">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="/livres/<?php echo $bookInfo["slug"]; ?>/delete" method="post">
                                <input type="hidden" name="id" value="<?php echo $bookInfo["id"]; ?>"/>
                                <button type="submit" class="ml-4 bg-red-500 w-10 h-10 text-white flex justify-center items-center"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    <?php
                        }
                    ?>
        </footer>
    </div>
</div>

<?php
$content = ob_get_clean();

require VIEWS . 'layout.php';
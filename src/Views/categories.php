<?php
$title = "Toutes les catégories";
ob_start();
?>
<h1 class="mb-8 text-2xl font-bold"><i class="fas fa-bookmark mr-4 text-purple-900"></i>Toutes les catégories
<?php if (isLogin()): ?>
    <form action="/categories/nouvelle" class="mt-3 sm:mt-0 sm:float-right text-base" method="post">
        <div class="flex">
            <input type="text" name="category" class="mr-2 rounded border px-2 text-base" placeholder="Catégorie" value="<?php echo getOld("category") ?>">
            <button type="submit" class="py-2 px-4 bg-green-500 hover:bg-green-600 text-white rounded">Créer</button>
        </div>
        <span class="text-red-500 font-bold"><?php echo getError("new") ?></span>
    </form>
<?php endif; ?>
</h1>
<div class="flex flex-wrap">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="w-10/12 px-4 py-2 text-left">Categorie</th>
                <?php if (isLogin()): ?>
                    <th class="px-4 py-2">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo escape($category["category"]) ?></td>
                    <?php if (isLogin()): ?>
                        <td class="border px-4 py-2 flex justify-center">
                            <form action="/categories/nouvelle" class="mt-3 sm:mt-0 sm:float-right text-base" method="post">
                                <div class="flex">
                                    <input type="text" name="edit" class="mr-2 rounded border px-2 text-base" placeholder="Catégorie" value="<?php echo getOld("edit") ?: escape($category["category"]); ?>">
                                    <button type="submit" class="w-10 h-10 bg-yellow-500 hover:bg-yellow-600 text-white"><i class="fas fa-edit"></i></button>
                                </div>
                                <span class="text-red-500 font-bold"><?php echo getError("edit") ?></span>
                            </form>
                            <form action="/category/<?php echo escape($category["slug"]) ?>/delete" method="post">
                                <button type="submit" class="ml-4 bg-red-500 w-10 h-10 text-white flex justify-center items-center"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php

$content = ob_get_clean();

require VIEWS . 'layout.php';

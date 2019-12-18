<?php
$title = "Tous les tags";
ob_start();
?>
<h1 class="mb-8 text-2xl font-bold"><i class="fas fa-tags mr-4 text-purple-900"></i>Toutes les tags
<?php if (isLogin()): ?>
    <form action="/tags/nouvelle" class="mt-3 sm:mt-0 sm:float-right text-base" method="post">
        <div class="flex">
            <input type="text" name="tag" class="mr-2 rounded border px-2 text-base" placeholder="Tag" value="<?php echo getOld("tag") ?>">
            <button type="submit" class="py-2 px-4 bg-green-500 hover:bg-green-600 text-white rounded">Créer</button>
        </div>
        <span class="text-red-500 font-bold"><?php echo getError("error") ?></span>
    </form>
<?php endif; ?>
</h1>
<div class="flex flex-wrap">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="w-10/12 px-4 py-2 text-left">Tags</th>
                <?php if (isLogin()): ?>
                    <th class="px-4 py-2">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tags as $tag): ?>
                <tr>
                    <td class="border px-4 py-2"><a href="/livres/tags/<?php echo escape($tag["slug"]) ?>" class="block w-100 h-100"><?php echo escape($tag["tag"]) ?></a></td>
                    <?php if (isLogin()): ?>
                        <td class="border px-4 py-2 flex justify-center">
                            <form action="/tags/edit/<?php echo escape($tag["slug"]) ?>/" class="mt-3 sm:mt-0 sm:float-right text-base" method="post">
                                <div class="flex">
                                    <input type="text" name="edit" class="mr-2 rounded border px-2 text-base" placeholder="Catégorie" value="<?php echo escape($tag["tag"]); ?>">
                                    <button type="submit" class="w-10 h-10 bg-yellow-500 hover:bg-yellow-600 text-white"><i class="fas fa-edit"></i></button>
                                </div>
                                <span class="text-red-500 font-bold"><?php echo getError(escape($tag["slug"])) ?></span>
                            </form>
                            <form action="/tags/delete/<?php echo escape($tag["slug"]) ?>/" method="post">
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

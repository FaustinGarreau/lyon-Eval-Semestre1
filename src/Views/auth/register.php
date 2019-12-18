<?php
$title = "Créer un compte";
ob_start();
?>

<div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 mx-auto p-4">
    <h1 class="mb-8 text-2xl font-bold"><i class="fas fa-sign-in-alt mr-4 text-purple-900"></i>register</h1>
    <div class="card bg-white rounded shadow relative">
        <form action="/register" method="post">
            <div class="p-4 flex items-center border-t">
                <label for="username">username</label>     
                    <div class="flex-grow">
                        <input id="username" name="username" value="<?php old("register", "username"); ?>" class="rounded border py-2 px-4 w-full"/>
                        <?php error("register", "username"); ?>
                    </div>
                </div>
            <div class="p-4 flex items-center border-t">
                <label for="password">password</label>     
                <div class="flex-grow">
                    <input type="password" id="password" name="password" value="<?php old("register", "username"); ?>" class="rounded border py-2 px-4 w-full"/>
                    <?php error("register", "password"); ?>
                </div>
            </div>
            <footer class="p-4 flex justify-between items-center">
            <div class="actions flex text-white">
                
                <input type="submit" value="register" class="bg-green-500 w-10 h-10"/>
            </div>
            </footer>
        </form>
    </div>
</div>

<?php
    unset($_SESSION["value"]["register"]);
    unset($_SESSION["error"]["register"]);

    $content = ob_get_clean();

    require VIEWS . 'layout.php';
?>
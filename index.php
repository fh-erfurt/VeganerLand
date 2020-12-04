<? require_once 'helper.php'?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?$title?></title>
    </head>
    <body>
        <section>
            <? include 'login.php' ?>

            <?if (isset($error)) : ?>
            <div class="error">
                <?=$error?>
            </div>
            <?endif;?>
        </section>
    </body>
</html>

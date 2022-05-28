<!DOCTYPE html>
<html lang="de">
    <head>
        <title><?=$title?></title>
        <meta charset="UTF-8 ger">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?=CSS_PATH.'design.css'?>">
        <link rel="stylesheet" href="<?=CSS_PATH.'navigation.css'?>">
        <link rel="stylesheet" href="<?=CSS_PATH.'responsive.css'?>">
        <link rel="stylesheet" href="<?=CSS_PATH.'aswesomeFonts.css'?>">
        <link rel="stylesheet" href="<?=ASSETS_PATH . 'fontawesome/css/all.css'?>">
        <link rel="stylesheet" href="<?=CSS_PATH.'normalMode.css'?>">
    </head>
    <body>
        <?php include __DIR__ . '/shared/navMenuBar.php'; ?>
        <?=$body?>
    </body>
</html>
<script src="<?=JAVA_SCRIPT_PATH . 'script.js'?>"></script>
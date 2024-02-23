<div class="ErrorPage">
    <h1>Ups... Da lief wohl etwas schief! <?=$_GET['test'] ?? 'nix'?></h1>
    <br>
    <?$gif = crateDataOfFilesFromDirectory("assets/images/errorGif", 1);?>
    <img class="ErrorImg" src="<?=ERROR_GIF_PATH.$gif?>" alt = "Errormeldung 404">
</div>
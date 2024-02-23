<!--solver Page-->
<div class="Content">
    <a href="?c=pages&a=solver&newResult">
        <button type="button">Erzeuge Solver-Ergebnis</button>
    </a>
    <br>
    <div class="solverResult">
        <?php if(isset($solverResult)) : ?>
            <p><?=$solverResult?></p>
        <?php else : ?>
            <p>no solver result here</p>
        <?php endif; ?>
    </div>
</div>
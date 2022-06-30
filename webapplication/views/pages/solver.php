<!--solver Page-->
<div class="Content">
    <a href="?c=pages&a=solver">
        <button type="button">Erzeuge Solver-Ergebnis</button>
    </a>
    <div class="test">
        <p>nothing to see here really</p>
        <?php if(isset($solverResult)) : ?>
            <p>this is the solver result</p>
            <p><?=$solverResult?></p>
        <?php else : ?>
            <p>no solver result here</p>
        <?php endif; ?>
    </div>
</div>
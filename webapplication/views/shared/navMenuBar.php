<div class="NavContent">
    <div class="logoNav">
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=start">
            <h2>PNS Solution</h2>
        </a>
    </div>
    <div class="menuLinksFlexContainer">
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=start" class="menuLinksFlexItem">
            <h4 <?=($_GET['a'] == 'start') ? 'class="navSelected"' : ''?>>Grafana</h4>
        </a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=cultureManagement" class="menuLinksFlexItem">
            <h4 <?=($_GET['a'] == 'plantManagement') ? 'class="navSelected"' : ''?>>Pflanzenverwaltung</h4>
        </a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=fertilizerManagement" class="menuLinksFlexItem">
            <h4 <?=($_GET['a'] == 'fertilizerManagement') ? 'class="navSelected"' : ''?>>Düngerverwaltung</h4>
        </a>
    </div>
</div>
<div class="NavContent">
    <div class="logoNav">
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=start">
            <!--        <img src="--><?//=PAGE_IMAGE_PATH.'/blocknroll/NUR_Kopf_Rot.png'?><!--">-->
            <h2>PNS Solution</h2>
        </a>
    </div>
    <div class="menuLinksFlexContainer">
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=start" class="menuLinksFlexItem">
            <h4 <?=($_GET['a'] == 'start') ? 'class="navSelected"' : ''?>>Arduinoüberwachung</h4>
        </a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=CultureManagement" class="menuLinksFlexItem">
            <h4 <?=($_GET['a'] == 'plantManagement') ? 'class="navSelected"' : ''?>>Pflanzenverwaltung</h4>
        </a>
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=fertilizerManagement" class="menuLinksFlexItem">
            <h4 <?=($_GET['a'] == 'fertilizerManagement') ? 'class="navSelected"' : ''?>>Düngerverwaltung</h4>
        </a>
        <a href="https://play.grafana.org/d/000000012/grafana-play-home?orgId=1" target="_blank" class="menuLinksFlexItem">
            <h4>Grafana</h4>
        </a>
    </div>
</div>
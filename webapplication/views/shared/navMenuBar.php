<nav>
    <input type="checkbox" id="responsive-nav">
    <label for="responsive-nav" class="responsive-nav-label">&#9776;</label>
    <div class="navfloat">
        <div class="dropdown">
<!--            <button class="dropbtn"><i id="menuIcon" class="fa fa-user" aria-hidden="true"></i>-->
<!--                <i id="menuIcon" class="fa fa-caret-down"></i>-->
<!--            </button>-->
<!--            <div class="dropdown-content">-->
<!--               For All -->
<!--                <a href="--><?//=$_SERVER['SCRIPT_NAME']?><!--/?c=pages&a=plantManagement"><i id="icon" class="fas fa-sign-out-alt"></i> Pflanzenverwaltung</a>-->
<!--                <a href="--><?//=$_SERVER['SCRIPT_NAME']?><!--/?c=pages&a=fertilizerManagement"><i id="icon" class="fas fa-sign-out-alt"></i> Düngerverwaltung</a>-->
<!--            </div>-->
        </div>
    </div>
</nav>
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
        <a href="<?=$_SERVER['SCRIPT_NAME']?>/?c=pages&a=plantManagement" class="menuLinksFlexItem">
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
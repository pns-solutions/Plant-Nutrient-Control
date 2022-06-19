<?php
$plantId = (isset($_GET['plantId']) && isset($plant)) ? '&plantId=' . $plant['id'] : '';
?>

<!--FORM-->
<div class="Content">
    <form autocomplete="off" action="?c=pages&a=addPlant<?=$plantId?>" method="post" id="formAddPlant">

        <div>
            <h1 style="color: #ffffff">Pflanze <?=isset($_GET['plantId']) ? 'bearbeiten!' : 'anlegen!'?></h1>
        </div>

        <div class="error" style="display: <?=isset($inputError)?'':'none'?>;" id="error">
            <?php foreach($inputError as $error) :?>
                <?=$error?><br>
            <?php endforeach;?>
        </div>

        <!-- Plant name -->
        <div class="input">
            <label for="plantName">Pflanzenname</label>
            <input type="text" id="plantName" name="plantName" required
                   value="<?=isset($plant['name']) ? htmlspecialchars($plant['name']) :  $oldValues['name'] ?? '' ?>">
            <span class="error-message" id="errorPlantName"></span>
        </div>

        <?php if(isset($_GET['plantId'])) : ?>
            <div class="tab">
                <?php foreach ($plant['growthStages'] as $stage) : ?>
                    <button type="button" class="tablinks" onclick="openStage(event, 'growthStage<?=$stage['growthStageId']?>//')"><?=$stage['name']?></button>
                <?php endforeach;?>
                <button type="button" class="tablinks" onclick="openStage(event, 'addGrowthStage')">Hinzufügen</button>
            </div>
            <?php foreach ($plant['growthStages'] as $stage) : ?>

                <div id="growthStage<?=$stage['id']?>" class="tabcontent">
                    <h3><?=$stage['name']?></h3>
                    <table id="nutritionTable">
                        <tr>
                            <th colspan="2" onclick="sortTable(this, 'nutritionTable')">Nährstoff <i class="fas fa-sort"></i></th>
                            <th colspan="2" onclick="sortTable(this, 'nutritionTable')">Menge <i class="fas fa-sort"></i></th>
                        </tr>
                        <?php foreach ($stage['nutrientArray'] as $nutrition) : ?>
                            <tr>
                                <td colspan="2"><?=$nutrition['element']?></td>
                                <td colspan="2"><?=$nutrition['amount']?></td>
                            </tr>
                        <?php endforeach;?>
                        <table>
                            <tr>
                                <td><input type="text" placeholder="Nährstoffname"></td>
                                <td><input type="text" placeholder="Menge"></td>
                                <td>
                                    <button type="submit"><i class="fa-solid fa-floppy-disk"></i></button>
                                </td>
                            </tr>
                        </table>
                    </table>
                </div>
            <?php endforeach;?>
        <?php endif;?>

        <!-- buttons -->
        <div class="formButtonsBottom">
            <button type="submit" name="submitAddPlant" id="submitAddPlant"> <?=isset($_GET['plantId']) ? 'Speichern' : 'Anlegen'?><i class="far fa-paper-plane" aria-hidden="true"></i></button>
            <button type="reset">Eingaben Löschen<i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
    </form>
</div>
<script src="<?=JAVA_SCRIPT_PATH . 'sweetalert2.min.js'?>"></script>
<script>
    if ('<?=isset($_GET['success'])?>' === '1') {
        if ('<?=$_GET['success'] ?? ''?>' === 'true') {
            Swal.fire({
                // position: 'bottom-end',
                icon: 'success',
                title: '<?=$_GET['msg'] ?? ""?>',
                footer: 'Pflanzen-Nährstoff-Steuerung',
                showConfirmButton: false,
                timer: 3000,
                heightAuto: false,
                timerProgressBar: true
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?=$_GET['msg'] ?? ""?>',
                heightAuto: false
            })
        }
    }
</script>
<script>
    function openStage(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
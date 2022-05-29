<?php
$plantId = isset($_GET['plantId']) ? '&plantId=' . base64_encode(urlencode($plant['ID'])) : '';
?>

<!--FORM-->
<div class="Content">
    <form autocomplete="off" action="?c=pages&a=addPlant<?=$plantId?>" method="post" id="formAddPlant">

        <div>
            <h1>Pflanze <?=isset($_GET['plantId']) ? 'bearbeiten!' : 'anlegen!'?></h1>
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
                   value="<?=isset($plant['NAME']) ? htmlspecialchars($plant['NAME']) :  $oldValues['NAME'] ?? '' ?>">
            <span class="error-message" id="errorPlantName"></span>
        </div>

        <!-- Growth stages -->
        <div class="input">
            <label for="growthStages">Wachstumsstufen</label>
            <input type="text" id="growthStages" name="growthStages" required
                   value="<?=isset($plant['GROWTHSTAGES']) ? htmlspecialchars($plant['GROWTHSTAGES']) :  $oldValues['GROWTHSTAGES'] ?? '' ?>">
            <span class="error-message" id="errorGrowthStages"></span>
        </div>
        <!-- Nutrition Table -->

        <?php if(isset($_GET['plantId'])) : ?>
            <table id="nutritionTable">
                <tr>
                    <th colspan="2" onclick="sortTable(this, 'nutritionTable')">Nährstoff <i class="fas fa-sort"></i></th>
                    <th colspan="2" onclick="sortTable(this, 'nutritionTable')">Menge <i class="fas fa-sort"></i></th>
                </tr>
                <?php if(isset($plant['NUTRITION'])) : ?>
                    <?php foreach ($plant['NUTRITION'] as $nutrition) :?>
                        <tr>
                            <td colspan="2"><?=$nutrition['NAME']?></td>
                            <td colspan="2"><?=$nutrition['AMOUNT'] . ' ' . $nutrition['UNIT']?></td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
            </table>
        <?php endif;?>

        <?php if(isset($_GET['plantId'])) : ?>
            <table>
                <tr>
                    <td><input type="text" placeholder="Nährstoffname"></td>
                    <td><input type="text" placeholder="Menge"></td>
                    <td><input type="text" placeholder="Einheit"></td>
                    <td>
                        <button type="submit"><i class="fa-solid fa-floppy-disk"></i></button>
                    </td>
                </tr>
            </table>
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
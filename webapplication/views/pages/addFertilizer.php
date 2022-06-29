<?php
$fertilizerId = (isset($_GET['fertilizerId']) && isset($fertilizer)) ? '&fertilizerId=' . $fertilizer['id'] : '&newFertilizer';
?>

<!--FORM-->
<div class="Content">
    <form autocomplete="off" action="?c=pages&a=addFertilizer<?=$fertilizerId?>" method="post" id="formAddFertilizer">

        <div>
            <h1 style="color: #ffffff">Dünger <?=isset($_GET['fertilizerId']) ? 'bearbeiten!' : 'anlegen!'?></h1>
        </div>

        <div class="error" style="display: <?=isset($inputError)?'':'none'?>;" id="error">
            <?php foreach($inputError as $error) :?>
                <?=$error?><br>
            <?php endforeach;?>
        </div>

        <!-- Fertilizer name -->
        <div class="input">
            <label for="fertilizerName">Düngername</label>
            <input type="text" id="fertilizerName" name="fertilizerName" required
                   value="<?=isset($fertilizer['name']) ? htmlspecialchars($fertilizer['name']) :  $oldValues['name'] ?? '' ?>">
            <span class="error-message" id="errorFertilizerName"></span>
        </div>

        <?php if(isset($_GET['fertilizerId'])) : ?>
            <table id="nutritionTable">
                <tr>
                    <th colspan="2">Nährstoff</th>
                    <th colspan="2">Menge</th>
                </tr>
                <?php $index = 1?>
                <?php foreach ($fertilizer['nutrientArray'] as $nutrition) : ?>
                    <tr>
                        <td colspan="2">
                            <select id="<?='nutrient' . $index . '_' . $nutrition['name']?>">
                                <?php foreach (NUTRIENTS_ELEMENT_TO_NAME as $elementShort => $elementLong) : ?>
                                    <option value="<?=$elementShort?>" <?=($nutrition['element'] == $elementShort) ? 'selected' : ''?>><?=$elementLong?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                        <td colspan="2">
                            <input type="text" id="<?=$index . '_' . $nutrition['name']?>" name="<?='nutrient' . $index . '_' . $nutrition['name']?>" placeholder="Menge" value="<?=$nutrition['amount']?>">
                        </td>
                    </tr>
                    <?php $index++?>
                <?php endforeach;?>
                <tr>
                    <td colspan="2">
                        <select id="newNutrient" name="newNutrient">
                            <option value="" selected>Bitte auswählen</option>
                            <?php foreach (NUTRIENTS_ELEMENT_TO_NAME as $elementShort => $elementLong) : ?>
                                <option value="<?=$elementLong?>"><?=$elementLong?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td colspan="2"><input type="text" id="newAmount" name="newAmount" placeholder="Menge"></td>
                </tr>
            </table>
        <?php endif;?>

        <!-- buttons -->
        <div class="formButtonsBottom">
            <button type="submit" name="<?=isset($_GET['newFertilizer']) ? 'submitAddNewFertilizer' : 'submitAddFertilizer'?>" id="<?=isset($_GET['newFertilizer']) ? 'submitAddNewFertilizer' : 'submitAddFertilizer'?>"> <?=isset($_GET['fertilizerId']) ? 'Speichern' : 'Anlegen'?><i class="far fa-paper-plane" aria-hidden="true"></i></button>
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
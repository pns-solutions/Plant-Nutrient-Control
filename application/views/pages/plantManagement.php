<!--plant Page-->
<div class="Content">
    <table id="plantTable">
        <tr>
            <th onclick="sortTable(this, 'plantTable')">Pflanzenname <i class="fas fa-sort"></i></th>
            <th onclick="sortTable(this, 'plantTable')">Wachstumsstufen <i class="fas fa-sort"></i></th>
            <th onclick="sortTable(this, 'plantTable')">Verwendete Nährstoffe <i class="fas fa-sort"></i></th>
            <th>Optionen</th>
        </tr>
        <?php if (isset($plants)) : ?>
            <?php foreach ($plants as $plant) : ?>
                <tr>
                    <td><?=$plant['NAME']?></td>
                    <td><?=$plant['GROWTHSTAGES']?></td>
                    <td><?= $plant['NUTRITIONINFO']?></td>
                    <td>
                        <a href="?c=pages&a=addPlant&plantId=<?=base64_encode(urlencode($plant['ID']))?>">
                            <button type="button">Bearbeiten</button>
                        </a>
                        <a href="?c=pages&a=plantManagement&plantId=<?=base64_encode(urlencode($plant['ID']))?>">
                            <button type="button">Löschen</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4"><b>Keine Daten vorhanden!</b></td>
            </tr>
        <?php endif; ?>
    </table>
</div>
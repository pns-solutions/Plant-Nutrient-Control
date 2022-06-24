<!--plant Page-->
<div class="Content">
    <table id="plantTable">
        <tr>
            <th onclick="sortTable(this, 'plantTable')">Pflanzenname <i class="fas fa-sort"></i></th>
            <th onclick="sortTable(this, 'plantTable', true)">Erstellt am  <i class="fas fa-sort"></i></th>
            <th onclick="sortTable(this, 'plantTable', true)">Bearbeitet am <i class="fas fa-sort"></i></th>
            <th>Optionen</th>
        </tr>
        <?php if(isset($plants)) : ?>
            <?php foreach ($plants as $plant) : ?>
                <tr>
                    <td><?=$plant['name']?></td>
                    <td><?=date_format(new DateTime($plant['createdAt']), 'd.m.Y')?></td>
                    <td><?=date_format(new DateTime($plant['updatedAt']), 'd.m.Y')?></td>
                    <td>
                        <a href="?c=pages&a=addCulture&plantId=<?=$plant['id']?>">
                            <button type="button">Bearbeiten</button>
                        </a>
                        <a href="?c=pages&a=cultureManagement&plantId=<?=$plant['id']?>">
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
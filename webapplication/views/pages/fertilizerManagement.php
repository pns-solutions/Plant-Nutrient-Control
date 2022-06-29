<!--fertilizer Page-->
<div class="Content">
    <a href="?c=pages&a=addFertilizer&newFertilizer">
        <button type="button">Neuen Dünger anlegen</button>
    </a>
    <table id="fertilizerTable">
        <tr>
            <th onclick="sortTable(this, 'fertilizerTable')">Düngername <i class="fas fa-sort"></i></th>
            <th onclick="sortTable(this, 'fertilizerTable', true)">Erstellt am  <i class="fas fa-sort"></i></th>
            <th onclick="sortTable(this, 'fertilizerTable', true)">Bearbeitet am <i class="fas fa-sort"></i></th>
            <th>Optionen</th>
        </tr>
        <?php if(isset($fertilizers)) : ?>
            <?php foreach ($fertilizers as $fertilizer) : ?>
                <tr>
                    <td><?=$fertilizer['name']?></td>
                    <td><?=date_format(new DateTime($fertilizer['createdAt']), 'd.m.Y')?></td>
                    <td><?=date_format(new DateTime($fertilizer['updatedAt']), 'd.m.Y')?></td>
                    <td>
                        <a href="?c=pages&a=addFertilizer&fertilizerId=<?=$fertilizer['id']?>">
                            <button type="button">Bearbeiten</button>
                        </a>
                        <a href="?c=pages&a=fertilizerManagement&fertilizerId=<?=$fertilizer['id']?>">
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
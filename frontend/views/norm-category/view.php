<?php if (!empty($arrayWithData)): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th><strong>GIP gedragscomponent</strong></th>
            <th>Normscore</th>
            <th>Score</th>
            <th>max</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($arrayWithData as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['normScore'] ?></td>
                <td><?= $item['score'] ?></td>
                <td><?= $item['max'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

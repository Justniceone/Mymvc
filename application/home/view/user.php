<table border="1">
    <tr>
        <th>id</th>
        <th>name</th>
    </tr>
    <?php foreach ($lists as $v):?>
    <tr>
        <td><?=$v['id']?></td>
        <td><?=$v['username']?></td>
    </tr>
    <?php endforeach;?>
</table>
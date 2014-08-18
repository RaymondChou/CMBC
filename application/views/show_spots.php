<h4 class="ui black block header">
    查看景区
</h4>
<?php if($msg&&$msg_type):?>
    <div class="ui <?=$msg_type?> message">
        <i class="close icon"></i>
        <div class="header">
            <?=$msg?>
        </div>
    </div>
<?php endif;?>
<table class="ui small table segment">
    <thead>
    <tr><th>ID</th>
        <th>景区名</th>
        <th>操作</th>
    </tr></thead>
    <tbody>
    <?php foreach($query as $row):?>
        <tr>
            <td><?=$row['id']?></td>
            <td><?=$row['name']?></td>
            <td>
                <a  href="<?php echo site_url()?>spots/edit?id=<?=$row['id']?>"<div  class="mini ui secondary button">修改</div></a>&nbsp;
            </td>
        </tr>
    <?php endforeach;?>

    </tbody>
</table>

<div style="float:right" class="ui pagination menu">
    <?=$pages?>
</div>

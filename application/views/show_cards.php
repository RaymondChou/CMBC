<h4 class="ui black block header">
    查看年卡
</h4>

<div style="width: 25%"  class="ui input">
    <input id="realname" type="text" placeholder="按姓名搜索" value="">
</div>
<div style="width: 25%" class="ui input">
    <input id="no" type="text" placeholder="按卡号搜索" value="">
</div>
<div style="width: 25%" id="name_search" class="ui input">
    <input id="id_no" type="text" placeholder="按身份证搜索" value="">
</div>
<div style="width: 20%" id="search_cards" class="ui labeled icon button">
    <i class="search icon"></i>
    搜索
</div>
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
    <tr><th>姓名</th>
        <th>卡号</th>
        <th>身份证</th>
        <th>过期时间</th>
        <th>更新时间</th>
        <th>&nbsp;操作</th>
    </tr></thead>
    <tbody>
    <?php foreach($query as $row):?>
        <tr>
            <td><?=$row['realname']?></td>
            <td><?=$row['no']?></td>
            <td><?=$row['id_no']?></td>
            <td><?=$row['expire']?></td>
            <td><?php echo date('Ymd',$row['updated']);?></td>
            <td>
                <a  href="<?php echo site_url()?>cards/edit?id=<?=$row['id']?>"<div id="edit_user" class="mini ui secondary button">修改</div></a>&nbsp;
            </td>
        </tr>
    <?php endforeach;?>

    </tbody>
</table>

<div style="float:right" class="ui pagination menu">
    <?=$pages?>
</div>

<script>
    $('document').ready(function(){
        $('input').bind('keypress',function(event){
            if(event.keyCode == "13")
            {
                $('#search_cards').click();
            }
        });
    });

</script>

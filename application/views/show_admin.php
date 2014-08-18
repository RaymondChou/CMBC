<h4 class="ui black block header">
查看管理员
</h4>

<div style="width: 26%" class="ui input">
    <input id="realname" type="text" placeholder="按姓名搜索" value="">
</div>
<div style="width: 26%" class="ui input">
    <input id="username" type="text" placeholder="按帐号搜索" value="">
</div>
<div style="width: 19%" id="type_sel" class="ui selection dropdown">
    <input type="hidden" id="type" value="">
    <div class="text">用户组选择</div>
    <i class="dropdown icon"></i>
    <div class="menu ui mini transition hidden">
        <div class="item active" data-value="all">全部</div>
        <div class="item" data-value="1">超级管理员</div>
        <div class="item" data-value="2">旅游局</div>
        <div class="item" data-value="3">柜员</div>
        <div class="item" data-value="4">收费员</div>
    </div>
</div>
<div style="width: 20%" id="search_admins" class="ui labeled icon button">
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
        <th>帐号</th>
        <th>用户组</th>
        <th>创建时间</th>
        <th>更改时间</th>
        <th>&nbsp;操作</th>
    </tr></thead>
    <tbody>
    <?php foreach($query as $row):?>
    <tr>
        <td><?=$row['realname']?></td>
        <td><?=$row['username']?></td>
        <td><?php if($row['type'] == 1){
                echo '超级管理员';
            }
            elseif($row['type'] == 2){
                echo '旅游局';
            }
            elseif($row['type'] == 3){
                echo '柜员';
            }
            else{
                echo '收费员';
            }?></td>
        <td><?php echo date('Y-m-d',$row['created']);?></td>
        <td><?php echo date('Y-m-d',$row['updated']);?></td>
        <td>
            <a  href="<?php echo site_url()?>admin/edit?user_id=<?=$row['id']?>"<div id="edit_user" class="mini ui secondary button">修改</div></a>&nbsp;
            <a onclick="javascript:if(!window.confirm('确定要删除吗?'))return false" href="<?php echo site_url()?>admin/del?user_id=<?=$row['id']?>"<div id="del_user" class="mini ui primary button">删除</div></a>
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
                $('#search_admins').click();
            }
        });
    });

</script>
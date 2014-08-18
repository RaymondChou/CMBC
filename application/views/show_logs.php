<h4 class="ui black block header">
    查看刷卡记录
</h4>
<div style="width:23%" class="ui input">
    <input id="realname" type="text" placeholder="按姓名搜索"value=""/>
</div>
<div style="width:24%" class="ui input">
    <input id="no" type="text" placeholder="按卡号搜索" value=""/>
</div>
<div  id="add_admin_sel_spot" class="ui selection dropdown">
    <input type="hidden" id="spot_sel" value="">
    <div class="text">按景区搜索</div>
    <i class="dropdown icon"></i>
    <div class="menu ui mini transition hidden">
        <?php foreach($spots_list as $row):?>
            <div class="item" data-value="<?=$row['spot_id']?>"><?=$row['spot_name']?></div>
        <?php endforeach;?>
    </div>
</div>
<div style="width: 20%" id="search_logs" class="ui labeled icon button">
    <i class="search icon"></i>
    搜索
</div>
<table class="ui table segment">
    <thead>
    <tr>
        <th>姓名</th>
        <th>卡号</th>
        <th>时间</th>
        <th>景区</th>
    </tr></thead>
    <tbody>
    <?php foreach($query as $row):?>
        <tr>
            <td><?=$row['realname']?></td>
            <td><?=$row['no']?></td>
            <td><?php echo date('Y-m-d H:i:s',$row['created']);?></td>
            <td><?=$row['name']?></td>
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
                $('#search_logs').click();
            }
        });
    });

</script>

<h4 class="ui black block header">
    增加管理员
</h4>
<?php if($msg&&$msg_type):?>
    <div class="small ui <?=$msg_type?> message">
        <i class="close icon"></i>
        <div class="header"><?=$msg?></div>
    </div>
<?php endif;?>
<div class="small ui form segment">
    <form method="post" action="">
    <div class="field">
        <label>姓名</label>
        <input name="realname" value="<?php echo set_value('realname'); ?>" type="text">
    </div>
    <div class="field">
        <label>帐号</label>
        <input name="username" value="<?php echo set_value('username'); ?>" type="text">
    </div>
<div class="two fields">
    <div class="field">
        <label>密码</label>
        <input name="password" value="<?php echo set_value('password'); ?>" type="password">
    </div>
    <div class="field">
        <label>重复密码</label>
        <input name="passconf" value="<?php echo set_value('passconf'); ?>" type="password">
    </div>
</div>
 <div class="two fields">
    <div id="add_admin_sel_type" class="field">
        <label id="add_admin_type">帐号类型:</label>
        <div class="ui radio checkbox">
            <input type="radio" name="root" value="4"  checked=""/>
            <label>收费员</label>
        </div>
        <div class="ui radio checkbox">
            <input type="radio" name="root" value="3" />
            <label>柜员</label>
        </div>
        <div class="ui radio checkbox">
            <input type="radio" name="root" value="2" />
            <label>旅游局</label>
        </div>
        <div class="ui radio checkbox">
            <input type="radio" name="root" value="1" />
            <label>超级管理员</label>
        </div>
    </div>
    <div class="field">
        <div id="add_admin_sel_spot" class="ui selection dropdown">
            <input type="hidden" name="spot_id" value="">
            <div class="text">所属景区</div>
            <i class="dropdown icon"></i>
            <div class="menu ui mini transition hidden">
                <?php foreach($spots_list as $row):?>
                <div class="item" data-value="<?=$row['id']?>"><?=$row['name']?></div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
 <button type="submit" class="ui blue submit button">提交</button>
</form>

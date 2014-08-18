<h4 class="ui black block header">
    年卡修改
</h4>
<?php if($msg&&$msg_type):?>
    <div class="small ui <?=$msg_type?> message">
        <i class="close icon"></i>
        <div class="header"><?=$msg?></div>
    </div>
<?php endif;?>
<div class="small ui form segment">
    <form method="post" action="" id="add_card_form">
        <div class="two fields">
            <div class="field">
                <label>姓名<span class="notic">[必填]</span> </label>
                <input name="realname" value="<?=$realname?>" type="text">
            </div>

            <div class="field">
                <label>手机号</label>
                <input name="phone" value="<?=$phone?>" type="text">
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label>卡号<span class="notic">[不可改]</span></label>
                <input placeholder="<?=$no?>" readonly="readonly" type="text">
            </div>
            <div class="field">
                <label>到期时间<span class="notic">[必填]</span></label>
                <input  type="text" name="expire" value="<?=$expire?>" onFocus="WdatePicker({dateFmt:'yyyyMMdd'})">
            </div>
        </div>
        <div class="field">
            <label>身份证<span class="notic">[不可改]</span></label>
            <input placeholder="<?=$id_no?>" readonly="readonly" type="text">
        </div>
        <div class="field">
            <label>备注</label>
            <input name="remark" value="<?=$remark?>" type="text">
        </div>
        <div id="add_card_sub" class="ui blue submit button">提交</div>
</div>

</form>

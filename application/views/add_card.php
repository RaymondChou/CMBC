<h4 class="ui black block header">
    年卡充值
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
            <input name="realname" value="<?php echo set_value('realname'); ?>" type="text">
        </div>

        <div class="field">
            <label>手机号</label>
            <input name="phone" value="<?php echo set_value('phone'); ?>" type="text">
        </div>
    </div>
  <div class="two fields">
        <div class="field">
            <label>卡号<span class="notic">[必填]</span></label>
            <input name="no" placeholder="卡号为16位纯数字" value="<?php echo set_value('no'); ?>" type="text">
        </div>
        <div class="field">
            <label>到期时间<span class="notic">[必填]</span></label>
            <input  type="text"  name="expire"  onFocus="WdatePicker({dateFmt:'yyyyMMdd'})"/>
        </div>
   </div>
        <div class="field">
            <label>身份证<span class="notic">[必填]</span></label>
            <input name="id_no" value="<?php echo set_value('id_no'); ?>" type="text">
        </div>
        <div class="field">
            <label>备注</label>
            <input name="remark" value="<?php echo set_value('remark'); ?>" type="text">
        </div>
        <div id="add_card_sub" class="ui blue submit button">提交</div>
</div>

</form>

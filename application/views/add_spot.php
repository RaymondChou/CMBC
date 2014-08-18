<h4 class="ui black block header">
    增加景区
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
            <label>景区名</label>
            <input name="name" value="<?php echo set_value('name'); ?>" type="text">
        </div>
        <button type="submit" class="ui blue submit button">提交</button>
</div>

</form>

$('.ui.radio.checkbox')
.checkbox();
$('.close.icon').on('click', function(){
   $(this).parent().remove();;
});
$('.ui.selection.dropdown')
    .dropdown()
;
$('#add_card_sub').on('click',function(){
    //alert('正在提交表单');
    $('#add_card_form').submit();
});
$('#search_admins').on('click', function(){
    var username = $('#username').val();
    var realname = $('#realname').val();
    var type = $('#type').val();
    self.location='../admin/search?username=' + username + '&realname=' + realname + '&type=' + type ;
});
$('#search_logs').on('click', function(){
    var no = $('#no').val();
    var spot_id = $('#spot_sel').val();
    var realname = $('#realname').val();
    self.location='../logs/search?realname=' + realname + '&spot_id=' + spot_id + '&no=' + no ;
});
$('#search_cards').on('click', function(){
    var no = $('#no').val();
    var id_no = $('#id_no').val();
    var realname = $('#realname').val();
    self.location='../cards/search?realname=' + realname + '&id_no=' + id_no + '&no=' + no ;
});
$("#add_admin_sel_type").click(function(){
    if($('input:radio:checked').val()=="4"){
        $('#add_admin_sel_spot').attr('style','');
    }else{
        $('#add_admin_sel_spot').attr('style','display:none');
    }
});





<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="#" method="post">
<!-- <button type="button" onClick="confSubmit(this.form);" id="delete" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-danger pull-right" style="margin-left: 2px;">
        <?php echo get_phrase('delete'); ?>
</button> -->
<button type="button" onclick="window.location.href = '<?php echo base_url();?>index.php?superadmin/new_message'" class="btn btn-primary pull-right">
        <?php echo get_phrase('new_message'); ?>
</button>
<div style="clear:both;"></div>
<br>
 <!-- <div class="col-sm-6">
    <div class="list-group">
    <a href="#" class="list-group-item list-group-item-action active" style="cursor:default">
   Individual Messages
  </a>
    <?php $i=1;foreach ($private_message_data as $row) { 
       /* $message1=explode(',',$row['user_to']);
        for($m1=0;$m1<count($message1);$m1++){
            if($message1[$m1]=='users-user-1'){*/
                $last=date('Y-m-d', strtotime('last month'));
            if($row['created_at']<$last){
                $this->db->where('message_id',$row['message_id']);
                $this->db->delete('private_messages');
            }
        $message1=explode(',',$row['created_by']);
        $message2=explode(',',$row['user_to']);
        if((($row['created_by']==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id')) or ($row['user_to']==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id'))) and (date('Y-m-d',strtotime($row['created_at']))==date('Y-m-d')))
              {
        ?>
    <a href="<?php echo base_url();?>index.php?superadmin/read_message/1/<?php echo $row['message_id'];?>" class="list-group-item"> <input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['nurse_id'] ?>" style="width: 20px;"> <?php if($row['created_by']==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id')){?><i class="glyphicon glyphicon-upload"></i><?php }elseif($row['user_to']==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id')){?><i class="glyphicon glyphicon-download"></i><?php }?>&nbsp;&nbsp;<label><?php echo $row['title'];?></label><span class="pull-right"><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?></span></a>
    <?php /*}}*/}}?>
    </div>
 </div> -->
 <div class="col-sm-12">
    <div class="list-group">
      <!--   <a href="" class="list-group-item list-group-item-action active" style="cursor:default">
   Group Messages
  </a> -->
    <?php $i=1;foreach ($message_data as $row) { 
        if($row['created_at']<$last){
                $this->db->where('message_id',$row['message_id']);
                $this->db->delete('messages');
            }
            /*$message1=explode(',',$row['created_by']);*/
            /*print_r(explode(',',$row['user_to']));*/
            /*$message2=explode(',',$row['user_to']);*/
            if(($row['created_by']==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id')) and (date('Y-m-d',strtotime($row['created_at']))==date('Y-m-d')))
              {
        ?>
    <a href="<?php echo base_url();?>index.php?superadmin/read_message/<?php echo $row['message_id'];?>" class="list-group-item"><!-- <input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['nurse_id'] ?>" style="width: 20px;"> --><?php if($row['created_by']==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id')){?><i class="glyphicon glyphicon-upload"></i><?php }elseif($row['user_to']==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id')){?><i class="glyphicon glyphicon-download"></i><?php }?>&nbsp;&nbsp;<label><?php echo $row['title'];?></label><span class="pull-right"><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?></span></a>
    <?php }} ?>
    </div>
 </div> 

</form>
<script type="text/javascript">   
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-md-3 col-xs-12 col-left'l><'col-md-9 col-xs-12  col-right'<'export-data'T>f>r>t<'row'<' col-md-3 col-xs-12 col-left'i><'col-md-9 col-xs-12 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
        $("#all_check").click(function () {
            $('.check').attr('checked', this.checked);
            if($(".check:checked").length == 0){
                $("#delete1").show();
                $("#delete").hide();
            }else{
            $("#delete1").hide();
            $("#delete").show();
            }
            
        });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $("#delete1").hide();
            $("#delete").show();
        if($(".check").length == $(".check:checked").length) {
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }
    }else{
        $("#delete1").show();
        $("#delete").hide();
    }
    });
    });
</script>
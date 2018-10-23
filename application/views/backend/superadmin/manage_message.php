<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="#" method="post">
<button type="button" onclick="window.location.href = '<?php echo base_url();?>index.php?superadmin/new_message'" class="btn btn-primary pull-right">
        <?php echo get_phrase('new_message'); ?>
</button>
<br>
 <div class="row">
    <div class="col-md-12">
        <!--CONTROL TABS START-->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><?php echo 'Received Messages';?>
                        </a></li>
            <li>
                <a href="#add" data-toggle="tab"><?php echo 'Sent Messages';?>
                        </a></li>
        </ul>
        <!--CONTROL TABS END-->
        
    
        <div class="tab-content">
        <br>
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
    <div class="list-group">
    <?php $i=1;foreach ($message_data as $row) { 
        if($row['created_at']<$last){
                $this->db->where('message_id',$row['message_id']);
                $this->db->delete('messages');
            }
            $user_too=explode(',', $row['user_too']);
            for($us=0;$us<count($user_too);$us++){
            if($user_too[$us]==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id'))
              {
        ?>
    <a href="<?php echo base_url();?>index.php?superadmin/read_message/<?php echo $row['message_id'];?>" class="list-group-item"><i class="glyphicon glyphicon-download"></i>&nbsp;&nbsp;<label><?php echo $row['title'];?></label><span class="pull-right"><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?></span></a>
    <?php }}}?>
    </div>
</div>
            <div class="tab-pane box" id="add">
            <div class="list-group">
    <?php $i=1;foreach ($message_data as $row) { 
        if($row['created_at']<$last){
                $this->db->where('message_id',$row['message_id']);
                $this->db->delete('messages');
            }
            if($row['created_by']==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id'))
              {
        ?>
    <a href="<?php echo base_url();?>index.php?superadmin/read_message/<?php echo $row['message_id'];?>" class="list-group-item"><i class="glyphicon glyphicon-upload"></i>&nbsp;&nbsp;<label><?php echo $row['title'];?></label><span class="pull-right"><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?></span></a>
    <?php }} ?>
    </div>
            </div>
</div>
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
<style>
  p{
    color: #000;
  }
   .span-user{
    display: inline-block;
    width: 100px;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}
</style>
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
        <a href="#" class="list-group-item active"><p style="color: #fff;"><span>From</span><span style="margin-left: 21%;">Subject</span><span class="pull-right">Date & Time</span></p></a>
        <div class="message-list"  style="/*list-style: none; */min-height: 50px; max-height:500px;border: 1px solid; overflow-y: scroll;">
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
    <a href="<?php echo base_url();?>index.php?superadmin/read_message/<?php echo $row['message_id'];?>" class="list-group-item">
    <p class="" style="text-align: center;"><span class="span-user pull-left"><?php $created_by=explode('-',$row['created_by']);
if($created_by[0] == 'hospitaladmins'){
  $user_role='Hospital Admin';
}elseif($created_by[0] == 'doctors'){
  $user_role='Doctor';
}elseif($created_by[0] == 'nurse'){
  $user_role='Nurse';
}elseif($created_by[0] == 'receptionist'){
  $user_role='Receptionist';
}elseif($created_by[0] == 'medicalstores'){
  $user_role='Pharmacist';
}elseif($created_by[0] == 'medicallabs'){
  $user_role='Laboratorist';
}elseif($created_by[0] == 'users'){
  $user_role='MyPulse Users';
}
    echo $user_role.' - '.$this->db->where($created_by[1].'_id',$created_by[2])->get($created_by[0])->row()->name;?></span><span style="margin-right: 50%;"><?php echo $row['title'];?></span><span class="pull-right"><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?></span>
    </p>
    </a>

    <?php }}}?>
    </div>
    </div>


            <div class="tab-pane box" id="add">
                <a href="#" class="list-group-item active"><p style="color: #fff;"><span>To</span><span style="margin-left: 21%;">Subject</span><span class="pull-right">Date & Time</span></p></a>
        <div class="message-list"  style="/*list-style: none; */min-height: 50px; max-height:500px;border: 1px solid; overflow-y: scroll;">
    <?php $i=1;foreach ($message_data as $row) { 
        if($row['created_at']<$last){
                $this->db->where('message_id',$row['message_id']);
                $this->db->delete('messages');
            }
            if($row['created_by']==$this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id'))
              {
        ?>
    <a href="<?php echo base_url();?>index.php?superadmin/read_message/<?php echo $row['message_id'];?>" class="list-group-item">
    <p class="" style="text-align: center;"><span class="span-user pull-left">
        <?php
    $user_to='';
      if($row['user_to'] != ''){
   $created_to=explode(',',$row['user_to']);
   for($h=0;$h<count($created_to);$h++){
    if($created_to[$h] == 1){
    $hospi='All Hospital Admins';    
    }elseif($created_to[$h] == 2){
    $hospi='All Medical Labs';    
    }elseif($created_to[$h] == 3){
    $hospi='All Medical Stores';    
    }elseif($created_to[$h] == 4){
    $hospi='All Nurses';    
    }elseif($created_to[$h] == 5){
    $hospi='All Receptionists';    
    }elseif($created_to[$h] == 6){
    $hospi='All Doctors';    
    }elseif($created_to[$h] == 7){
   $hospi='All MyPulse Users';    
    }
    $user_to=$hospi.',';
 }
 
    }
/*        if($row['user_to'] != ''){
   $created_to=explode(',',$row['user_to']);
  for($h=0;$h<count($created_to);$h++){
    if($created_to[$h] == 1){
    $hospi='All Hospital Admins';    
    }elseif($created_to[$h] == 2){
    $hospi='All Medical Labs';    
    }elseif($created_to[$h] == 3){
    $hospi='All Medical Stores';    
    }elseif($created_to[$h] == 4){
    $hospi='All Nurses';    
    }elseif($created_to[$h] == 5){
    $hospi='All Receptionists';    
    }elseif($created_to[$h] == 6){
    $hospi='All Doctors';    
    }elseif($created_to[$h] == 7){
   $hospi='All MyPulse Users';    
    }
    $hospital[$h]=$hospi;   
 }
 $user_to=implode(',',$hospital); 
  }
*/
  $user_too='';
 if($row['user_too'] != ''){ 
  $created_too=explode(',',$row['user_too']);
  for($h=0;$h<count($created_too);$h++){
$user=explode('-',$created_too[$h]);
if($user[0] == 'hospitaladmins'){
  $user_role='Hospital Admin';
}elseif($user[0] == 'doctors'){
  $user_role='Doctor';
}elseif($user[0] == 'nurse'){
  $user_role='Nurse';
}elseif($user[0] == 'receptionist'){
  $user_role='Receptionist';
}elseif($user[0] == 'medicalstores'){
  $user_role='Pharmacist';
}elseif($user[0] == 'medicallabs'){
  $user_role='Laboratorist';
}elseif($user[0] == 'users'){
  $user_role='MyPulse Users';
}
    $user_data[$h]=$user_role.' - '.$this->db->where($user[1].'_id',$user[2])->get($user[0])->row()->name;
}

$user_too=implode(', ', $user_data);

 }

 if($user_to!='' && $user_too!=''){
  echo $user_to.','.$user_too;
}elseif($user_to != '' && $user_too ==''){
  echo $user_to;
}elseif($user_to == '' && $user_too !=''){
  echo $user_too;
}?></span>
    <span style="margin-right: 50%;"><?php echo $row['title'];?></span><span class="pull-right"><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?></span>
    </p>
    </a>

    <?php }}?>
    </div>
          <!--   <div class="list-group">
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
    </div> -->
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
            "sDom": "<'row'<'col-md-3 col-xs-12 col-left'l><'col-md-9 col-xs-12  col-right'>r>t<'row'<' col-md-3 col-xs-12 col-left'i><'col-md-9 col-xs-12 col-right'p>>"
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
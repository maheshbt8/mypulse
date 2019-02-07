<style>
  p{
    color: #000;
  }
   .span-user{
    display: inline-block;
    width: 300px;
    text-align: left;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}
</style>
<?php 
$this->session->set_userdata('last_page', current_url());
?>
<div class="alert bg-info" style="background: #30a5ff" role="alert">Dear User ,<br/>&nbsp;&nbsp;Messages Will Be Automatically Deleted After 30 Days.</div>
<form action="#" method="post">
  <button type="button" class="btn btn-info pull-right" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'" style="margin-left: 2px;"><i class="glyphicon glyphicon-refresh icon-refresh"></i>&nbsp;Refresh</button>
<?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'doctors'){?>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/new_message'" class="btn btn-primary pull-right">
        <?php echo get_phrase('new_message'); ?>
</button>
<?php }?>
<?php if($account_type=='superadmin'){
            $account_hospital='0';
        }elseif($account_type=='superadmin'){
            $account_hospital=$this->session->userdata('hospital_id');
        }
?>
<br>
 <!--CONTROL TABS START-->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><?php echo 'Received Messages';?>
                        </a></li>
<?php if($account_type=='superadmin'||$account_type=='hospitaladmins'||$account_type=='doctors'){ ?>
            <li>
                <a href="#add" data-toggle="tab"><?php echo 'Sent Messages';?>
                        </a></li><?php }?>
        </ul>
        <!--CONTROL TABS END-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
        <a href="#" class="list-group-item active"><p style="color: #fff;"><span class="span-user">From</span><span>Subject</span><span class="pull-right">Date & Time</span></p></a>
        <div class="message-list"  style="min-height: 50px; max-height:500px;border: 1px solid; overflow-y: scroll;">
    <?php $message_data=$this->crud_model->select_message();
/*$message_data1=$this->crud_model->select_message();
        $message_data=json_decode($message_data1,TRUE);*/
    $i=1;foreach ($message_data as $row) { 
      $count=explode(',',$row['is_read']);
    $s=0;
    for($m2=0;$m2<count($count);$m2++){
        if($account_details == $count[$m2]){
                $s=1;
                break;
        }
        }
      ?>
      <a href="<?php echo base_url();?>main/read_message/<?php echo $row['message_id'];?>" class="list-group-item">
      <?php if($s==0){ ?><strong> <?php }?>
    <p class="" style=""><span class="span-user pull-left"><?php $created_by=explode('-',$row['created_by']);
if($created_by[0] == 'superadmin'){
  $user_role='Super Admin';
}elseif($created_by[0] == 'hospitaladmins'){
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
    echo $user_role.' - '.$this->db->where($created_by[1].'_id',$created_by[2])->get($created_by[0])->row()->name;?></span>
    <span style="margin-left: 0px;"><?php echo $row['title'];?></span>
    <span class="pull-right"><?php echo date('M d,Y h:i A',strtotime($row['created_at'])); ?>
    </span>
    </p>
      <?php if($s==0){ ?></strong><?php }?>
    </a>
   <?php }?>
    </div>
    </div>
            <div class="tab-pane box" id="add">
                <a href="#" class="list-group-item active"><p style="color: #fff;"><span class="span-user">To</span><span style="margin-left:0%;">Subject</span><span class="pull-right">Date & Time</span>
                </p>
                </a>
        <div class="message-list"  style="/*list-style: none; */min-height: 50px; max-height:500px;border: 1px solid; overflow-y: scroll;">
    <?php $message_data=$this->db->order_by('message_id','desc')->where('created_by',$account_details)->get('messages')->result_array();
    $i=1;foreach ($message_data as $row) { 
        ?>
    <a href="<?php echo base_url();?>main/read_message/<?php echo $row['message_id'];?>" class="list-group-item">
    <p class="" style=""><span class="span-user pull-left">
        <?php
    $user_to='';
      if($row['group_ids'] != ''){
   $created_to=explode(',',$row['group_ids']);
   for($h=0;$h<count($created_to);$h++){
    if($created_to[$h] == 1){
    $hospi='All Hospital Admins';    
    }elseif($created_to[$h] == 2){
    $hospi='All Medical Labs';    
    }elseif($created_to[$h] == 3){
    $hospi='All Medical Stores';    
    }elseif($created_to[$h] == 4){
    $hospi='All Doctors'; 
    }elseif($created_to[$h] == 5){
    $hospi='All Nurses';       
    }elseif($created_to[$h] == 6){
     $hospi='All Receptionists';   
    }elseif($created_to[$h] == 7){
   $hospi='All MyPulse Users';    
    }
    $user_data[$h]=$hospi;
 }
 $user_to=implode(',', $user_data);
}

  $user_too='';
 if($row['user_ids'] != ''){ 
  $created_too=explode(',',$row['user_ids']);
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
$user_too=implode(',', $user_data);
}

 if($user_to!='' && $user_too!=''){
  echo $user_to.','.$user_too;
}elseif($user_to != '' && $user_too ==''){
  echo $user_to;
}elseif($user_to == '' && $user_too !=''){
  echo $user_too;
}?></span>
    <span style=""><?php echo $row['title'];?></span><span class="pull-right"><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?></span>
    </p>
    </a>

    <?php }?>
    </div>
    </div>
</div>
</div>
</div>
</div>
</form>

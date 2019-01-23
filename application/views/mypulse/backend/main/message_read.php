<style>
  p{
    color: #000;
  }
</style>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">

                    <div id="Borge" class="w3-container person" style="display: block;min-height: 350px;">
  <h4 class="w3-opacity">Title : <?= $messagedata['title']?></h4>
  <h4><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date('M d,Y h:i A',strtotime($messagedata['created_at']));?>.<input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'"></h4>
  <?php
  if($messagedata['created_by'] == $this->session->userdata('login_type').'-'.$this->session->userdata('type_id').'-'.$this->session->userdata('login_user_id'))
  {
    if($messagedata['user_to'] != ''){
   $created_to=explode(',',$messagedata['user_to']);
   $hospi='';
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
    $hospital[]=$hospi;   
 }
 $user_to=implode(',',$hospital); 
  }

 if($messagedata['user_too'] != ''){ 
  $created_too=explode(',',$messagedata['user_too']);
  $user_role='';
  for($h=0;$h<count($created_too);$h++){
$user=explode('-',$created_too[$h]);
if($user[0] == 'superadmin'){
  $user_role='Super Admin';
}elseif($user[0] == 'hospitaladmins'){
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
    $user_data[]=$user_role.' - '.$this->db->where($user[1].'_id',$user[2])->get($user[0])->row()->name;
}

$user_too=implode(', ', $user_data);
 }
?>
<h4><i class="entypo-right-circled"></i> To :
<?php
 if($user_to!='' && $user_too!=''){
  echo $user_to.','.$user_too;
}elseif($user_to != '' && $user_too ==''){
  echo $user_to;
}elseif($user_to == '' && $user_too !=''){
  echo $user_too;
}?>.</h4>
<?php
}else{
  ?>
  <h4><i class="entypo-right-circled"></i> From : <?php $created_by=explode('-',$messagedata['created_by']);
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
  echo $user_role.' - '.$this->db->where($created_by[1].'_id',$created_by[2])->get($created_by[0])->row()->name;?></h4>
  <?php
 }?>
  <hr>
  <?= $messagedata['message'];?>
</div>

                </div>

            </div>

        </div>
    </div>

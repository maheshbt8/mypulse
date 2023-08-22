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
  if($messagedata['created_by'] == $this->session->userdata('unique_id'))
  {
    if($messagedata['group_ids'] != ''){
   $created_to=explode(',',$messagedata['group_ids']);
   $hospi='';
  for($h=0;$h<count($created_to);$h++){
    $role_data1=$this->crud_model->get_role($created_to[$h]);
    $hospi=$role_data1['type'];
    $hospital[]=$hospi;   
 }
 $user_to=implode(',',$hospital); 
  }

 if($messagedata['user_ids'] != ''){ 
  $created_too=explode(',',$messagedata['user_ids']);
  $user_role='';
  for($h=0;$h<count($created_too);$h++){
$user=explode('_',$created_too[$h]);
$role=substr($user[0],0,-2);
$role_data=$this->crud_model->get_role($role);
$user_role=$role_data['role'];
    $user_data[]=$user_role.' - '.$this->db->where('unique_id',$created_too[$h])->get($role_data['type'])->row()->name;
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
  <h4><i class="entypo-right-circled"></i> From : <?php $created_by=explode('_',$messagedata['created_by']);
  $role=substr($created_by[0],0,-2);
$role_data=$this->crud_model->get_role($role);
$user_role=$role_data['role'];
  echo $user_role.' - '.$this->db->where('unique_id',$messagedata['created_by'])->get($role_data['type'])->row()->name;?></h4>
  <?php
 }?>
  <hr>
  <?= $messagedata['message'];?>
</div>

                </div>

            </div>

        </div>
    </div>

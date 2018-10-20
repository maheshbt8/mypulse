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
  <!-- 
  <img class="w3-round  w3-animate-top" src="/w3images/avatar3.png" style="width:20%;"> -->
  <h4 class="w3-opacity">Title : <?= $message_data['title']?></h4>
  <h4><i class="fa fa-clock-o"></i> From <?php $created_by=explode('-',$message_data['created_by']);echo $created_by[0].' - '.$this->db->where($created_by[1].'_id',$created_by[2])->get($created_by[0])->row()->name;?>, <?php echo date('M d,Y h:i A',strtotime($message_data['created_at']));?>.<input type="button" class="btn btn-info btn-xs pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'"></h4>
  <?php if($message_type == 0){?>
  <h4><i class="entypo-right-circled"></i> To <?php $created_to=explode(',',$message_data['user_to']);for($h=0;$h<count($created_to);$h++){
    if($created_to[$h] == 1){
    $hospi[]='All Hospital Admins';    
    }elseif($created_to[$h] == 2){
    $hospi[]='All Medical Labs';    
    }elseif($created_to[$h] == 3){
    $hospi[]='All Medical Stores';    
    }elseif($created_to[$h] == 4){
    $hospi[]='All Nurses';    
    }elseif($created_to[$h] == 5){
    $hospi[]='All Receptionists';    
    }elseif($created_to[$h] == 6){
    $hospi[]='All Doctors';    
    }elseif($created_to[$h] == 7){
    $hospi[]='All Patients';    
    } 
  }
echo implode(', ', $hospi);
  ;?>.</h4>
 <?php }

 if($message_type == 1){?>
  <h4><i class="entypo-right-circled"></i> To <?php $created_to=explode(',',$message_data['user_to']);for($h=0;$h<count($created_to);$h++){
$user=explode('-',$created_to[$h]);
    $user_data[]=$user[0].' - '.$this->db->where($user[1].'_id',$user[2])->get($user[0])->row()->name;
}
echo implode(', ', $user_data);
?>.</h4>
 <?php }?>
  <!-- <a class="w3-button w3-light-grey" href="#">Reply<i class="w3-margin-left fa fa-mail-reply"></i></a>
  <a class="w3-button w3-light-grey" href="#">Forward<i class="w3-margin-left fa fa-arrow-right"></i></a> -->
  <hr>
  <?= $message_data['message'];?>
</div>

                </div>

            </div>

        </div>
    </div>

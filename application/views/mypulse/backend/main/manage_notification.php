<style>
  p{
    color: #000;
  }
span{
  margin:5px;  
}
</style>
<?php 
$this->session->set_userdata('last_page', current_url());
?>
<div class="alert bg-info" style="background: #30a5ff" role="alert">Dear User ,<br/>&nbsp;&nbsp;1. Notifications Will Be Automatically Deleted After 7 Days.<br/>&nbsp;&nbsp;2. Green Color Will Indicate Read Notifications And Red Color Will Indicate Unread Notifications.</div>
<div class="row">
  <div class="col-sm-12">
    <div class="list-group-item active">
    <span>Subject</span><span class="pull-right"></span><span class="pull-right">Date & Time</span>
</div>
<div class="list-group">
<?php $i=1;foreach ($notification_data as $row) { ?>
  <a href="<?php echo base_url(); ?>main/read_notification/<?php echo $row['id'];?>" class="list-group-item"><span><?php echo $row['title'];?></span>
    <span class="pull-right"><!-- <a href="<?=base_url('main/notification/delete/').$row['id'];?>" ><button onclick=""><i class="fa fa-times-circle-o"></i></button></a> --><!-- </span>
    <span class="pull-right"> --><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?><?php if($row['isRead']==1){?><span style="color: green">&nbsp;&nbsp;<i class="fa fa-dot-circle-o fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;</span><?php }elseif($row['isRead']==2){?><span style="color: red">&nbsp;&nbsp;<i class="fa fa-dot-circle-o fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;</span><?php }?> </span>
    
</a>
<?php }?>
</div>
  </div>
 </div>

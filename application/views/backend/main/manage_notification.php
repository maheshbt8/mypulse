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
<div class="alert bg-info" style="background: #30a5ff" role="alert">Dear User ,<br/>&nbsp;&nbsp;Notifications Will Be Automatically Deleted After 7 Days.</div>
<div class="row">
  <div class="col-sm-12">
    <div class="list-group-item active">
    <span>Subject</span><span class="pull-right"></span><span class="pull-right">Date & Time</span>
</div>
<div class="list-group">
<?php $i=1;foreach ($notification_data as $row) { ?>
  <?php if($row['isRead']==2){ ?><strong><?php } ?>
  <a href="<?php echo base_url(); ?>main/read_notification/<?php echo $row['id'];?>" class="list-group-item"><span><?php echo $row['title'];?></span>
    <span class="pull-right"><!-- <a href="<?=base_url('main/notification/delete/').$row['id'];?>" ><button onclick=""><i class="fa fa-times-circle-o"></i></button></a> --><!-- </span>
    <span class="pull-right"> --><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?></span>
    
</a>
<?php if($row['isRead']==2){ ?></strong><?php } ?>
<?php }?>
</div>
  </div>
 </div>
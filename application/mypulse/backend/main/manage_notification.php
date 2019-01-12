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
<div class="row">
  <div class="col-sm-12">
    <div class="list-group-item active">
    <span>Subject</span><span class="pull-right"></span><span class="pull-right">Date & Time</span>
</div>
<div class="list-group">
<?php $i=1;foreach ($notification_data as $row) { ?>
  <a href="<?php echo base_url(); ?>main/read_notification/<?php echo $row['id'];?>" class="list-group-item"><span><?php echo $row['title'];?></span>
    <span class="pull-right"><b><i class="fa fa-times-circle-o" style="font-size: 20px;"></i></b></span>
    <span class="pull-right"><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?></span>
    <!-- <a href="<?=base_url('main/notification/delete/').$row['id'];?>"><b class="pull-right" style="font-size: 20px;"><i class="fa fa-times-circle-o"></i></b>
</a> -->
</a>
<?php }?>
</div>
  </div>
 </div>

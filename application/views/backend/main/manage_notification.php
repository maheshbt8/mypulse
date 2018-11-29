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
<form action="#" method="post">
 <div class="row">
    <div class="col-md-12">
    <p class="list-group-item active"><!-- <span><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></span> --><span>Subject</span><span class="pull-right">Date & Time</span></p>
        <div class="message-list"  style="min-height: 50px; max-height:500px;border: 1px solid; overflow-y: scroll;">
    <?php $i=1;foreach ($notification_data as $row) { ?>
    <a href="<?php echo base_url();?>main/read_notification/<?php echo $row['id'];?>" class="list-group-item">
    <p><!-- <span><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php echo $row['receptionist_id'] ?>"></span> --><span><?php echo $row['title'];?></span><span class="pull-right"><?php echo date('M d,Y h:i A',strtotime($row['created_at']));?></span>
    </p>
    </a>
   <?php }?>
    </div>
    </div>

</div>
</form>

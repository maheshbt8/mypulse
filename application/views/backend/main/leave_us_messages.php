<?php 
$this->session->set_userdata('last_page', current_url());
?>
<?php 
if($_GET['status_id']){
    $status=$_GET['status_id'];
}else{
    $status=1;
}
if($_GET['sd']){
    $sd=$_GET['sd'];
}else{
    $sd=date('Y-m-d',strtotime('-29 days'));
}
if($_GET['ed']){
    $ed=$_GET['ed'];
}else{
    $ed=date('Y-m-d',strtotime('-0 days'));
}
?>
<style type="text/css">
    div.message {
  white-space: nowrap; 
  width: 200px; 
  overflow: hidden;
  text-overflow: ellipsis; 
}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">
              <div class="col-sm-8">
                  <div class="form-group">  
                  <span for="field-ta" class="col-sm-2"><?php echo get_phrase('date_range'); ?></span> 
         <div class="col-sm-4">
        <input  class="form-control" name="report" id="reportrange" value="<?php if((isset($_GET['sd']) && $_GET['sd'] != "") AND (isset($_GET['ed']) && $_GET['ed'] != "")){if($_GET['sd'] != '0NaN-NaN-NaN' && $_GET['ed'] != '0NaN-NaN-NaN'){echo date('M d,Y',strtotime($_GET['sd'])).' - '.date('M d,Y',strtotime($_GET['ed']));}else{echo 'All';}}else{echo date('M d,Y', strtotime('-29 days')).' - '.date('M d,Y', strtotime('-0 days'));}?>"/>
        </div>   
                        <span for="field-ta" class="col-sm-2 control-label"> <?php echo get_phrase('status'); ?></span> 
                        <div class="col-sm-4">
                            <select name="stat" class="form-control" onchange="return get_ext_msg(this.value)">
    <!-- <option value="">Select</option> -->
    <!-- <option value="all" <?php if($_GET['status_id']=='all'){echo 'selected';}elseif($account_type!='users'){echo 'selected';}?>><?php echo get_phrase('All'); ?></option> -->
    <option value="1" <?php if($_GET['status_id']=='1'){echo 'selected';}?>><?php echo get_phrase('Pending'); ?></option>
    <option value="2" <?php if($_GET['status_id']=='2'){echo 'selected';}?>><?php echo get_phrase('Completed'); ?></option>
                            </select>
                        </div>
                    </div>
    </div>
    <?php 
      if($account_type!='superadmin'){
    ?>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/send_feedback/'" class="btn btn-primary pull-right">
        <?php echo get_phrase('send_feedback'); ?>
</button>
<?php }?>
</div>
<div class="panel-body">
<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>  
        <tr>
            <th data-field="id" data-sortable="true"><?php echo get_phrase('message_id');?></th>
            <th><?php echo get_phrase('unique_id');?></th>
            <th><?php echo get_phrase('first_name');?></th>   
            <th><?php echo get_phrase('last_name');?></th>
            <th><?php echo get_phrase('mobile number');?></th>
            <th><?php echo get_phrase('email');?></th> 
            <th><?php echo get_phrase('message');?></th>
            <th><?php echo get_phrase('created_at');?></th>
            <th><?php echo get_phrase('action');?></th>
        </tr>
    </thead>

    <tbody>
        <?php
    if($account_type=='superadmin'){
    $leave_messages = $this->db->order_by('id','desc')->get_where('leave_message',array('created_at>='=>date('Y-m-d 00:00:00',strtotime($sd)),'created_at<='=>date('Y-m-d 23:59:59',strtotime($ed)),'row_status_cd'=>$status))->result_array();
}else{
  $leave_messages = $this->db->order_by('id','desc')->get_where('leave_message',array('created_at>='=>date('Y-m-d 00:00:00',strtotime($sd)),'created_at<='=>date('Y-m-d 23:59:59',strtotime($ed)),'row_status_cd'=>$status,'unique_id'=>$this->session->userdata('unique_id')))->result_array();
}
        $i=1;foreach ($leave_messages as $row) { 
            if($row['unique_id']!=''){
              $code=divide_unique_id($row['unique_id']);
              $role=$this->crud_model->get_role($code);
                $u_data=$this->db->get_where($role['type'],array('unique_id'=>$row['unique_id']))->row_array();
                $first_name=$u_data['name'];
                $last_name=$u_data['lname'];
                $mobile=$u_data['phone'];
                $email=$u_data['email'];
            }
          ?>   
            <tr>
                <td><?=$i?></td>
                <td><?=$row['unique_id'];?></td>
                <td><?php if($row['unique_id']!=''){echo $first_name;}else{echo $row['first_name'];}?></td>
                <td><?php if($row['unique_id']!=''){echo $last_name;}else{echo $row['last_name'];}?></td>
                <td><?php if($row['unique_id']!=''){echo $mobile;}else{echo $row['mobile'];}?></td>
                <td><?php if($row['unique_id']!=''){echo $email;}else{echo $row['email'];}?></td>
                <td><div class="message"><a href="#" class="hiper" data-toggle="modal" data-target="#myModal<?=$i?>"><?=$row['message']?></a></div></td>
                <td><?=date('M d-Y h:i A',strtotime($row['created_at']));?></td>
                <td>

                    <?php if($account_type=='superadmin'){if($row['row_status_cd']==2){?>
                    <a href="<?php echo base_url(); ?>main/leave_us_messages/status/<?=$row['id'];?>/1"><span style="color: green"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true">Completed</i>&nbsp;&nbsp;</span></a><?php }elseif($row['row_status_cd']==1){?><a href="<?php echo base_url(); ?>main/leave_us_messages/status/<?=$row['id'];?>/2"><span style="color: red"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true">Pending</i>&nbsp;&nbsp;</span></a><?php }}else{ if($row['row_status_cd']==2){?>
                    <span style="color: green"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true">Completed</i>&nbsp;&nbsp;</span><?php }elseif($row['row_status_cd']==1){?><span style="color: red"><i class="fa fa-dot-circle-o fa-lg" aria-hidden="true">Pending</i>&nbsp;&nbsp;</span><?php }}?>
                </td>
                <!-- Modal -->
  <div class="modal fade" id="myModal<?=$i?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">External Messages</h4>
        </div>
        <div class="modal-body">
          <span><?=$row['message']?></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    function get_ext_msg(id) {
        <?php
       if($_GET['sd'] == '' && $_GET['ed'] == ''){
        $sd=date('Y-m-d', strtotime('-29 days'));
        $ed=date('Y-m-d', strtotime('-0 days'));
        ?>
        window.location.href = '<?php echo base_url();?>Leave-Us-Messages?sd=<?=$sd;?>&ed=<?=$ed;?>&status_id='+id;
        <?php
       }elseif($_GET['sd'] != '' && $_GET['ed'] != ''){
        ?>
        window.location.href = '<?php echo base_url();?>Leave-Us-Messages?sd=<?=$_GET['sd'];?>&ed=<?=$_GET['ed'];?>&status_id='+id;
        <?php
       }
       ?>
    }
    function past_date_range(start, end) {
            window.location.href = '<?php echo base_url();?>Leave-Us-Messages?sd='+start.format('YYYY-MM-DD')+"&ed="+end.format('YYYY-MM-DD')+"&status_id=<?php if($_GET['status_id']!=''){echo $_GET['status_id'];}else{echo $status;}?>";
        }
</script>
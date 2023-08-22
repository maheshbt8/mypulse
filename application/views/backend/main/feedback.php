<?php 
$this->session->set_userdata('last_page1', current_url());
?>
<input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS END-->
      <div class="panel panel-default">   
        <div class="panel-heading">
        <button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_feedback'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_feedback'); ?>
        </button>
        </div>
            <div class="panel-body"> 
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
                	<thead>
                		<tr>
                            <th><div><?php echo 'Role';?></div></th>
                    		<th><div><?php echo 'Customer';?></div></th>
                    	    <th><div><?php echo 'Feedback';?></div></th>
                            <th><div><?php echo 'Option';?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $feedback=$this->crud_model->get_feedback_info();
                        foreach($feedback as $row){
                        $customer=explode('_',$row['customer_id']);
$customer_type=substr($customer[0],0,-2);
$role=$this->crud_model->get_role($customer_type);
$account=$role['role'];?>
                        <tr>
                            <td><?=$account;?></td>
							<td><?php $ac='';
 if($account=='Doctor'){
  $ac='Dr.';
 }
 echo $ac.' '.$this->db->where('unique_id',$row['customer_id'])->get($role['type'])->row()->name;?></td>
 <td><a href="<?php echo base_url();?>main/edit_feedback/<?php echo $row['id'];?>" class="hiper" ><?=$row['feedback'];?></a></td>
 <td> <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/feedback/delete/<?=$row['id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a></td>
                        </tr>
        
                        <?php }?>
                    </tbody>
                </table>
		</div>
	</div>
</div>
</div>
</div>
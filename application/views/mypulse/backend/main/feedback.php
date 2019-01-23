<?php 
$this->session->set_userdata('last_page1', current_url());
?>
<input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
<div class="row">
	<div class="col-md-12">
    	<!--CONTROL TABS END-->
      <div class="panel panel-default">   
            <div class="panel-body"> 
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
                	<thead>
                		<tr>
                            <th><div><?php echo 'Role';?></div></th>
                    		<th><div><?php echo 'Customer';?></div></th>
                    	    <th><div><?php echo 'Feedback';?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $feedback= $this->db->get('feedback')->result_array();
                        foreach($feedback as $row){
                        $customer=explode('-',$row['customer_id']);
if($customer[0] == 'superadmin'){
  $img_type='superadmin_image';
  $account='Super Admin';
}elseif($customer[0] == 'hospitaladmins'){
  $img_type='hospitaladmin_image';
  $account='Hospital Admin';
}elseif($customer[0] == 'doctors'){
  $img_type='doctor_image';
  $account='Doctor';
}elseif($customer[0] == 'nurse'){
  $img_type='nurse_image';
  $account='Nurse';
}elseif($customer[0] == 'receptionist'){
  $img_type='receptionist_image';
  $account='Receptionist';
}elseif($customer[0] == 'medicalstores'){
  $img_type='medical_stores';
  $account='Medical Store';
}elseif($customer[0] == 'medicallabs'){
  $img_type='medical_labs';
  $account='Medical Lab';
}
                            ?>
                        <tr>
                            <td><?=$account;?></td>
							<td><?php $ac='';
 if($account=='Doctor'){
  $ac='Dr.';
 }
 echo $ac.' '.$this->db->where($customer[1].'_id',$customer[2])->get($customer[0])->row()->name;?></td>
 <td><a href="<?php echo base_url();?>main/edit_feedback/<?php echo $row['id'];?>" class="hiper" ><?=$row['feedback'];?></a></td>
                        </tr>
        
                        <?php }?>
                    </tbody>
                </table>
		</div>
	</div>
</div>
</div>
</div>
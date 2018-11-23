<?php $account_type=$this->session->userdata('login_type');$user_data=$this->db->where('user_id',$user_id)->get('users')->row_array();?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
    <div class="col-md-2">
            <center>
        <a href="#">
                <img src="<?php echo base_url('uploads/user_image/').$user_id.'.jpg';?>" class="img-circle" style="width: 35%;">
            </a>
        <br>
        <h3><?php echo 'Mr/Mrs.'.$user_data['name'];?></h3>
        <br>
        <span>
       <h4><i class="fa fa-map-marker m-r-xs"></i>&nbsp;&nbsp;<?php echo $user_data['address'];?></h4>
        <h4><i class="fa fa-envelope m-r-xs"></i>&nbsp;&nbsp;<?php echo $user_data['email'];?></h4>
        <h4><i class="fa fa-phone m-r-xs"></i>&nbsp;&nbsp;<?php echo $user_data['phone'];?></h4> 
        </span>
      </center>
        </div>
   
    <div class="col-md-10">
  
<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------>   
        <ul class="nav nav-tabs bordered"> 
            <li class="active">
                <a href="#h1" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Health Info';?>

                </a>
            </li>
            <li>
                <a href="#h2" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Prescriptions';?>

                </a>
            </li>
            <?php if($account_type=='doctors'){?>
            <li>
                <a href="#h3" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Prognosis';?>

                </a>
            </li>
            <li>
                <a href="#h4" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Health Reports';?>

                </a>
            </li>
            <li>
                <a href="#h5" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Inpatient History';?>

                </a>
            </li>
        <?php }?>
        </ul>
        <div class="tab-content">
    <div class="tab-pane box active" id="h1" style="padding: 5px">
            <form role="form" class="form-horizontal form-groups-bordered validate" action="#" method="post" enctype="multipart/form-data">
                <div class="row">
                        <div class="col-md-6">
                  <div class="form-group">
                        <label for="field-ta" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['bloodGroup'];?></label>

                        <div class="col-sm-8">
                            <select name="blood_group" class="form-control" id="blood_group" value="" disabled="">
                                <option value=""><?php echo $this->lang->line('labels')['selectBloodGroup'];?></option>
                                    <option value="A+"<?php if($user_data['blood_group']=='A+'){echo 'selected';}?>><?php echo get_phrase('A+'); ?></option>
                                    <option value="A-"<?php if($user_data['blood_group']=='A-'){echo 'selected';}?>><?php echo get_phrase('A-'); ?></option>
                                    <option value="B+"<?php if($user_data['blood_group']=='B+'){echo 'selected';}?>><?php echo get_phrase('B+'); ?></option>
                                    <option value="B-"<?php if($user_data['blood_group']=='B-'){echo 'selected';}?>><?php echo get_phrase('B-'); ?></option>
                                    <option value="AB+"<?php if($user_data['blood_group']=='AB+'){echo 'selected';}?>><?php echo get_phrase('AB+'); ?></option>
                                    <option value="AB-"<?php if($user_data['blood_group']=='AB-'){echo 'selected';}?>><?php echo get_phrase('AB-'); ?></option>
                                    <option value="O+"<?php if($user_data['blood_group']=='O-'){echo 'selected';}?>><?php echo get_phrase('o+'); ?></option>
                                    <option value="O-"<?php if($user_data['blood_group']=='O-'){echo 'selected';}?>><?php echo get_phrase('o-'); ?></option>
                                   
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['age'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="age" class="form-control" id="age" value="<?=$user_data['age']?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['height'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="height" class="form-control" id="height" value="<?=$user_data['height']?>"disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['weight'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="weight" class="form-control" id="weight" value="<?=$user_data['weight']?>"disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['bloodPressure'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="blood_pressure" class="form-control" id="blood_pressure" value="<?=$user_data['blood_pressure']?>"disabled>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['sugarLevel'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="sugar_level" class="form-control" id="sugar_level" value="<?=$user_data['sugar_level']?>"disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['healthInsuranceProvider'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="health_insurance_provider" class="form-control" id="health_insurance_provider" value="<?=$user_data['health_insurance_provider']?>"disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['healthInsuranceId'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="health_insurance_id" class="form-control" id="health_insurance_id" value="<?=$user_data['health_insurance_id']?>"disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['familyHistory'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="family_history" class="form-control" id="family_history" value="<?=$user_data['family_history']?>"disabled>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="field-1" class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['pastMedicalHistory'];?></label>

                        <div class="col-sm-8">
                            <input type="text" name="past_medical_history" class="form-control" id="past_medical_history" value="<?=$user_data['past_medical_history']?>"disabled>
                        </div>
                    </div>
                     
                   
                </div>
                    </div> 
                    </form>   
        </div>
    <div class="tab-pane box" id="h2" style="padding: 5px">
<?php if($account_type=='doctors'){?>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_prescription/<?= $this->session->userdata('login_user_id').'/'.$user_data['user_id'];?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_prescription'); ?>
</button>
<?php }?>
<table data-toggle="table" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('title (Prescription_for)'); ?></th>
            <th><?php echo get_phrase('hospital / doctor'); ?></th>
            <th><?php echo get_phrase('date'); ?></th>
            <?php if($account_type == 'doctors'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php  
        $prescription_info=$this->db->get_where('prescription',array('user_id'=>$user_data['user_id'],'status'=>1))->result_array();
        $i=1;foreach ($prescription_info as $row1) {
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><a href="<?php echo base_url(); ?>main/prescription_history/<?php echo $row1['prescription_id'] ?>" class="hiper">
                    <?php echo explode('|',$this->encryption->decrypt($row1['prescription_data']))[0];?></a></td>
                <td><?php $doc=$this->db->where('doctor_id',$row1['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name?></td>
                <td><?php echo $row1['created_at'] ?></td>
               <?php if($account_type == 'doctors'){?>
                <td>
<?php if($row1['doctor_id'] == $this->session->userdata('login_user_id')){?>
            <a href="<?php echo base_url(); ?>main/edit_prescription/<?php echo $row1['prescription_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i>
            </a><?php }?>
                </td><?php }?>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
</div>
<div class="tab-pane box" id="h3" style="padding: 5px">
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_prognosis/<?= $this->session->userdata('login_user_id').'/'.$user_data['user_id'];?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_prognosis'); ?>
</button>
<table data-toggle="table"  data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('title'); ?></th>
            <th><?php echo get_phrase('hospital / doctor'); ?></th>
            <!-- <th><?php echo get_phrase('case_history'); ?></th> -->
            <th><?php echo get_phrase('date'); ?></th>
            <?php if($account_type == 'doctors'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php  
        $prognosis_info=$this->db->get_where('prognosis',array('user_id'=>$user_data['user_id'],'status'=>1))->result_array();
        $i=1;foreach ($prognosis_info as $row2) {
            $prognosis_data=explode('|',$this->encryption->decrypt($row2['prognosis_data']));
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><a href="<?php echo base_url(); ?>main/prognosis_history/<?php echo $row2['prognosis_id'] ?>" class="hiper"><?php echo $prognosis_data[0]; ?></a></td>
            <td><?php $doc=$this->db->where('doctor_id',$row2['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name?></td>
               <!--  <td><?php echo $prognosis_data[1]; ?></td> -->
                <td><?php echo $row2['created_at'] ?></td>
             <?php if($account_type == 'doctors'){?>
                <td>
<?php if($row2['doctor_id'] == $this->session->userdata('login_user_id')){?>
            <a href="<?php echo base_url(); ?>main/edit_prognosis/<?php echo $row2['prescription_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i>
            </a><?php }?>
                </td><?php }?>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
</div>
<div class="tab-pane box" id="h4" style="padding: 5px">
<table data-toggle="table"  data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('title'); ?></th>
            <th><?php echo get_phrase('health_report'); ?></th>
            <th><?php echo get_phrase('date'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  
        $report_info=$this->db->get_where('prescription_order',array('user_id'=>$user_data['user_id'],'order_type'=>1))->result_array();
        foreach ($report_info as $row2) {
        $rep_data=$this->db->get_where('prescription',array('prescription_id'=>$row2['prescription_id']))->row_array();
        $rep_exp=explode('|',$this->encryption->decrypt($rep_data['prescription_data']));
         $rep_exp_data=explode(',',$rep_exp[7]);
                
        for($j=0;$j<count($rep_exp_data);$j++) {
        $report=$this->db->get_where('reports',array('order_id'=>$row2['order_id'],'status'=>1))->result_array();
        if($report[$j]['extension']!=''){
            ?>
            <tr>
                <td><?php echo $j+1;?></td>
                <td><?php echo $rep_exp_data[$j];?></td>
                <td><?php if($report[$j]['extension']!=''){?><a href="<?=base_url('uploads/reports/').$report[$j]['report_id'].'.'.$report[$j]['extension'];?>" class="hiper" download><i class="fa fa-download"></i></a><?php }?></td>
                <td><?php echo $report[$j]['created_at'] ?></td>
            </tr>
        <?php }}} ?>
    </tbody>
</table>
</div>
<div class="tab-pane box" id="h5" style="padding: 5px">
<table data-toggle="table"  data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no');?></th>
            <th><?php echo get_phrase('hospital');?></th>   
            <th><?php echo get_phrase('doctor');?></th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('reason');?></th> 
            <th><?php echo get_phrase('bed');?></th>
            <th><?php echo get_phrase('status');?></th>
            <th><?php echo get_phrase('action');?></th>
        </tr>
    </thead>
    <tbody>
        <?php  
        $in_pa=$this->crud_model->select_inpatient_id_information($user_data['user_id']);
        $i=1;foreach ($in_pa as $row) {
            
            ?>
            <tr>
                <td><?= $i;?></td>
                 <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name;?></a></td>
                <td><?php echo $this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row()->name;?></td>
                <td><?php echo date('M d,Y',strtotime($row['created_date']));?></td>
                <td><?php echo $row['reason']; ?></td>
                <td><?php echo $this->db->get_where('bed',array('bed_id'=>$row['bed_id']))->row()->name; ?></td>
                 <td><?php if($row['status'] == 0){echo "Recommended";}elseif($row['status'] == 1){ echo "Admitted";}elseif($row['status'] == 2){ echo "Discharged";}?></td> 
               <td>
              <a href="<?php echo base_url();?>main/inpatient_history/<?php echo $row['id']?>" title="View History"><i class="menu-icon fa fa-eye"></i></a> 
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
</div>
        </div>  
    </div>
</div>
    </div>
</div>
</div>
</div>
</div>
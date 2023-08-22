<?php 
if($_GET['sd']!='' && $_GET['ed']!='' && $_GET['status_id']!=''){
    $this->session->set_userdata('last_page', current_url().'?sd='.$_GET['sd'].'&ed='.$_GET['ed'].'&status_id='.$_GET['status_id']);
        }elseif($_GET['sd']!='' && $_GET['ed']!='' && $_GET['status_id']==''){
    $this->session->set_userdata('last_page', current_url().'?sd='.$_GET['sd'].'&ed='.$_GET['ed']);
        }elseif($_GET['sd']=='' && $_GET['ed']=='' && $_GET['status_id']!=''){
    $this->session->set_userdata('last_page', current_url().'?status_id='.$_GET['status_id']);
        }else{$this->session->set_userdata('last_page', current_url());}    
/*$this->session->set_userdata('last_page', current_url());*/
?>
<form action="<?php echo base_url()?>main/medical_labs/delete_multiple/" method="post">
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
                            <select name="hospital" class="form-control" onchange="return get_inpatient(this.value)">
    <!-- <option value="">Select</option> -->
    <option value="all" <?php if($_GET['status_id']=='all'){echo 'selected';}elseif($account_type!='users'){echo 'selected';}?>><?php echo get_phrase('All'); ?></option>
    <option value="1" <?php if($_GET['status_id']=='1'){echo 'selected';}elseif($account_type!='users' && $_GET['status_id']==''){echo 'selected';}?>><?php echo get_phrase('Admitted'); ?></option>
    <option value="2" <?php if($_GET['status_id']=='2'){echo 'selected';}?>><?php echo get_phrase('Discharged'); ?></option>
    <option value="0" <?php if($_GET['status_id']=='0'){echo 'selected';}?>><?php echo get_phrase('Recommended'); ?></option>
                            </select>
                        </div>
                    </div>
    </div>
<button type="button" class="btn btn-info pull-right" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'" style="margin-left: 2px;"><i class="glyphicon glyphicon-refresh icon-refresh"></i>&nbsp;Refresh</button>
<?php if($account_type == 'superadmin' || $account_type == 'hospitaladmins' || $account_type == 'doctors' ){?>
<button type="button" onclick="window.location.href = '<?php echo base_url();?>main/add_inpatient'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_in-Patient'); ?>
</button>
<?php }?>
</div>
<div class="panel-body">
<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>  
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value="" onclick="toggle(this);"></th>
            <!-- <th><?php echo get_phrase('sl_no');?></th> -->
            <?php if($account_type!='users'){ ?>
            <th data-field="patient" data-sortable="true"><?php echo get_phrase('patient');?></th><?php }?>
            <th data-field="hospital" data-sortable="true"><?php echo get_phrase('hospital-Branch-Department');?></th>   
            <th data-field="doctor" data-sortable="true"><?php echo get_phrase('doctor');?></th>
            <!-- <th data-field="date" data-sortable="true"><?php if($_GET['status_id']==1 || $_GET['status_id']==2 || $_GET['status_id']=='all'){echo get_phrase('admitted _date');}elseif($_GET['status_id']==0){echo "Recommended Date";}?></th> -->
            <th data-field="date" data-sortable="true"><?php if($_GET['status_id']==1 || $_GET['status_id']==2 || $_GET['status_id']=='all' || $_GET['status_id']==''){echo get_phrase('admitted _date');}elseif($_GET['status_id']==0){echo "Recommended Date";}?></th>
            <th data-field="reason" data-sortable="true"><?php echo get_phrase('reason');?></th> 
            <th data-field="bed" data-sortable="true"><?php echo get_phrase('ward-Bed');?></th>
            <th data-field="status" data-sortable="true"><?php echo get_phrase('status');?></th>
            <?php if($account_type=='users'){ ?>
            <th data-field="Visibility" data-sortable="true"><?php echo get_phrase('Visibility');?></th><?php }?>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody id="data_table">
  <div id="refresh_data">
       <?php
    if(($_GET['sd']!='' && $_GET['ed']!='' && $_GET['status_id']!='') || ($_GET['sd']!='' && $_GET['ed']!='' && $_GET['status_id']=='') || ($_GET['sd']=='' && $_GET['ed']=='' && $_GET['status_id']!='')){
            $patient_info=$this->crud_model->select_inpatient_info_by_date($_GET['sd'],$_GET['ed'],$_GET['status_id']);
        }else{
            $sd=date('Y-m-d', strtotime('-29 days'));
            $ed=date('Y-m-d', strtotime('-0 days'));
            if($account_type!='users'){
            $status='1';
            }else{
            $status='all';
            }
            /*$patient_info=$this->crud_model->select_inpatient_info();*/
            $patient_info=$this->crud_model->select_inpatient_info_by_date($sd,$ed,$status);
        }
        ?>
</div>
        <?php $i=1;foreach ($patient_info as $row) { 
            ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check" value="<?php echo $row['lab_id'] ?>"></td>
                 <?php if($account_type!='users'){ ?>
                <td><?php $user=$this->db->where('user_id',$row['user_id'])->get('users')->row();
                if($account_type != 'users'){?><a href="<?php echo base_url()?>main/edit_inpatient/<?= $row['id']?>" class="hiper"><?php echo $user->name.' / '.$user->unique_id;?></a><?php }elseif($account_type == 'users'){?><?php echo $user->name.' / '.$user->unique_id;}?></td><?php }?>
                 <td>
                    <?php 
                    $doc=$this->db->where('doctor_id',$row['doctor_id'])->get('doctors')->row();
                    $branch=$this->db->get_where('branch' , array('branch_id' => $doc->branch_id))->row();
                    $hospital=$this->db->get_where('hospitals' , array('hospital_id' => $doc->hospital_id))->row();
                    $name = $this->db->get_where('department' , array('department_id' => $doc->department_id ))->row()->dept_name;
                        echo $hospital->name.' - '.$branch->branch_name.' - '.$name;?>
                  
                </td>
                <td><?php echo $doc->name;?></td>
                <td><?php if($_GET['status_id']==1 || $_GET['status_id']==2 || _GET['status_id']=='all' || $_GET['status_id']==''){if($row['join_date']!=''){echo date('M d,Y',strtotime($row['join_date']));}}elseif($_GET['status_id']==0){echo date('M d,Y / h:i A',strtotime($row['created_at']));}?></td>
                <td><?php echo $row['reason']; ?></td>
                <td><?php $bed=$this->db->get_where('bed',array('bed_id'=>$row['bed_id']))->row();
                $ward=$this->db->get_where('ward',array('ward_id'=>$bed->ward_id))->row();
                echo $ward->ward_name.'-'.$bed->bed_name; ?></td>
                 <td><?php if($row['inpatient_status'] == 0){echo "Recommended";}elseif($row['inpatient_status'] == 1){ echo "Admitted";}elseif($row['inpatient_status'] == 2){ echo "Discharged";}?></td>
                 <?php if($account_type=='users'){?>
                <td><?php if($row['row_status_cd']==1){?><a href="<?php echo base_url(); ?>main/inpatient/status/<?= $row['id'];?>/2"><span style="color: green"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Visible";?></span></a><?php }elseif($row['row_status_cd']==2){?><a href="<?php echo base_url(); ?>main/inpatient/status/<?= $row['id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Hidden";?></span></a><?php }?></td><?php }?> 
               <td>
              <a href="<?php echo base_url();?>main/inpatient_history/<?php echo $row['id']?>" title="View History"><i class="menu-icon fa fa-eye"></i></a> &nbsp;&nbsp;
              <?php if(($account_type=='superadmin' || $account_type=='hospitaladmins' || $account_type=='doctors' || $account_type=='users') && $row['inpatient_status']==0){?>
              <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/inpatient/delete/<?php echo $row['id']?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a><?php }?>
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
</form>
<script type="text/javascript">
    function get_inpatient(id) {
        <?php
       if($_GET['sd'] == '' && $_GET['ed'] == ''){
        $sd=date('Y-m-d', strtotime('-0 days'));
        $ed=date('Y-m-d', strtotime('-29 days'));
        ?>
        window.location.href = '<?php echo base_url();?>In-Patient?sd=<?=$sd;?>&ed=<?=$ed;?>&status_id='+id;
        <?php
       }elseif($_GET['sd'] != '' && $_GET['ed'] != ''){
        ?>
        window.location.href = '<?php echo base_url();?>In-Patient?sd=<?=$_GET['sd'];?>&ed=<?=$_GET['ed'];?>&status_id='+id;
        <?php
       }
       ?>
    }
    function past_date_range(start, end) {
            window.location.href = '<?php echo base_url();?>In-Patient?sd='+start.format('YYYY-MM-DD')+"&ed="+end.format('YYYY-MM-DD')+"&status_id=<?php if($_GET['status_id']!=''){echo $_GET['status_id'];}else{echo $status;}?>";
        }
</script>
<script>
    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
 $(".all_check").click(function () {
    if($(this).prop("checked") == true){
                $("#delete1").hide();
                $("#delete").show();
            }
            else if($(this).prop("checked") == false){
                $("#delete1").show();
                $("#delete").hide();
            }
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
         $(".check").click(function(){
            if(($(".check:checked").length)!=0){
            $("#delete1").hide();
            $("#delete").show();
        if($(".check").length == $(".check:checked").length) {
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }
    }else{
        $("#delete1").show();
        $("#delete").hide();
    }
    });
    });
</script>
<style>
    .tile-stats .icon{
        bottom: 50px;
    }
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<?php 
$this->session->set_userdata('last_page', current_url());
?>
<div class="row">
    
<?php if($account_type=='superadmin' || $account_type=='users'){?>
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/hospital">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php if($account_type=='superadmin'){echo $this->db->count_all('hospitals');}elseif($account_type=='users'){$hospital_ids=explode(',',$this->db->where('user_id',$this->session->userdata('login_user_id'))->get('patient')->row()->hospital_ids);echo count($hospital_ids);} ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php echo 'Hospitals';?></h3>
            </div>
        </a>
    </div>
<?php }elseif($account_type=='hospitaladmins'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/get_hospital_branch/<?php echo $this->session->userdata('hospital_id');?>">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('branch')->num_rows(); ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php echo 'Branches';?></h3>
            </div>
        </a>
    </div>
<?php }elseif($account_type=='nurse' || $account_type=='receptionist'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/get_hospital_branch/<?php echo $this->session->userdata('hospital_id');?>">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php if($account_type=='nurse'){$dt=$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row(); if($dt->department_id==0){echo $this->db->where('branch_id',$dt->branch_id)->get('department')->num_rows();}else{echo explode(',',$dt->department_id);}}elseif($account_type=='receptionist'){$dt=$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row(); if($dt->department_id==0){echo $this->db->where('branch_id',$dt->branch_id)->get('department')->num_rows();}else{echo explode(',',$dt->department_id);}}?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php echo 'Departments';?></h3>
            </div>
        </a>
    </div>
<?php }?>
<?php if($account_type=='superadmin' || $account_type=='hospitaladmins'|| $account_type=='nurse'|| $account_type=='receptionist'){?>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php if($account_type=='superadmin'){echo $this->db->count_all('doctors');}elseif($account_type=='hospitaladmins'){echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('doctors')->num_rows();}elseif($account_type=='nurse'){echo count(explode(',',$this->db->where('nurse_id',$this->session->userdata('login_user_id'))->get('nurse')->row()->doctor_id));}elseif($account_type=='receptionist'){echo count(explode(',',$this->db->where('receptionist_id',$this->session->userdata('login_user_id'))->get('receptionist')->row()->doctor_id));} ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Doctors';?> </h3>
            </div>
        </a>
    </div>
   <?php }?>
   <?php if($account_type=='superadmin'){?>
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/users">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->count_all('users'); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Users';?></h3>
            </div>
        </a>
        </div>
    <?php }?>
    <?php if($account_type != 'superadmin' && $account_type != 'users'){?>
    <div class="col-sm-3">
        <a href="#">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('inpatient')->num_rows(); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Patients';?></h3>
            </div>
        </a>
    </div>
<?php }?>
   <?php if($account_type == 'users'){?>
    <div class="col-sm-3">
        <a href="#">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('inpatient')->num_rows(); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo 'Medical Labs';?></h3>
            </div>
        </a>
    </div>
<?php }?>
<?php if($account_type != 'medicalstores' && $account_type != 'medicallabs'){?>
        <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/appointment">
            <div class="tile-stats tile-white-aqua">
               <div class="icon"><i class="fa fa-envelope"></i></div>
                <div class="num pull-right" data-start="0" data-end="
                <?php if($account_type=='superadmin'){ echo $this->db->count_all('appointments'); }elseif($account_type=='hospitaladmins'){echo $this->db->where('hospital_id',$this->session->userdata('hospital_id'))->get('appointments')->num_rows();}elseif($account_type=='doctors'){echo $this->db->where('doctor_id',$this->session->userdata('login_user_id'))->get('appointments')->num_rows();}elseif($account_type=='users'){echo $this->db->where('user_id',$this->session->userdata('login_user_id'))->get('appointments')->num_rows();}?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php echo $this->lang->line('appointments');?> </h3>
            </div>
        </a>
        </div>
 <?php }?>
 <?php if($account_type=='medicalstores' || $account_type=='medicallabs'){?>
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/hospital">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo count($this->crud_model->select_outstanding_order_info()); ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 65px;"><?php if($account_type=='medicalstores'){echo 'Outstanding Orders';}elseif( $account_type=='medicallabs'){echo 'Outstanding Reports';}?></h3>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>main/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo count($this->crud_model->select_completed_order_info()); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 65px;"><?php if($account_type=='medicalstores'){echo 'Complete Orders';}elseif( $account_type=='medicallabs'){echo 'Complete Reports';}?> </h3>
            </div>
        </a>
    </div>
<?php }?>
</div>
<br/>
<hr/>
<?php if($account_type == 'users'){?>
<div class="row">
    <div class="col-md-12">
        <h4 class="col-sm-12"><?php echo get_phrase('OUTSTANDING PRESCRIPTIONS FOR MEDICINES'); ?></h4>
            <div style="clear:both;"></div>
<table class="table table-bordered table-striped datatable" id="table-2">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('title (Prescription_for)'); ?></th>
            <th><?php echo get_phrase('date'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  
        $prescription_info=$this->db->order_by('prescription_id','desc')->get_where('prescription',array('user_id'=>$this->session->userdata('login_user_id'),'medicin_status'=>2))->result_array();
        $i=1;foreach ($prescription_info as $row1) {
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><a href="<?php echo base_url(); ?>main/prescription_history/<?php echo $row1['prescription_id'] ?>" class="hiper">
                    <?php echo $row1['title'] ?></a></td>
                <td><?php echo $row1['created_at'] ?></td>
                <td>
        <a href="<?php echo base_url(); ?>main/prescription_order/<?php echo $row1['prescription_id'] ?>/0" title="Order Medicin"><i class="glyphicon glyphicon-plus"></i>
            </a>&nbsp;<!-- 
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/prescription/delete/<?php echo $row1['prescription_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a> -->
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
    </div>
    <br/>
    <hr/>
    <br/>
    <div class="col-md-12">
        <h4 class="col-sm-12"><?php echo get_phrase('OUTSTANDING PRESCRIPTIONS FOR MEDICAL TESTS'); ?></h4>
            <div style="clear:both;"></div>
<table class="table table-bordered table-striped datatable" id="table-2">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('title'); ?></th>
            <th><?php echo get_phrase('date'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  
        $prescription_info=$this->db->order_by('prescription_id','desc')->get_where('prescription',array('user_id'=>$this->session->userdata('login_user_id'),'test_status'=>2))->result_array();
        $i=1;foreach ($prescription_info as $row1) {
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><a href="<?php echo base_url(); ?>main/prescription_history/<?php echo $row1['prescription_id'] ?>" class="hiper">
                    <?php echo $row1['title'] ?></a></td>
                <td><?php echo $row1['created_at'] ?></td>
                <td>

            <a href="<?php echo base_url(); ?>main/prescription_order/<?php echo $row1['prescription_id'] ?>/1" title="Order Medical Test"><i class="glyphicon glyphicon-plus"></i>
            </a>&nbsp;<!-- 
            <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/receptionist/delete/<?php echo $row1['prescription_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a> -->
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
    </div>
</div>
<?php }?>
<?php if($account_type == 'medicalstores' || $account_type == 'medicallabs'){?>
<div class="row">
    <div class="col-md-12">
        <h4 class="col-sm-12"><?php 
if($account_type == 'medicalstores'){
        echo get_phrase('OUTSTANDING ORDERS FOR MEDICINES');
    }
if($account_type == 'medicallabs'){
    echo get_phrase('OUTSTANDING ORDERS FOR LAB TESTS');
}
         ?></h4>
            <div style="clear:both;"></div>
<table class="table table-bordered table-striped datatable" id="table-2">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('hospital / doctor'); ?></th>
            <th><?php echo get_phrase('patient'); ?></th>
            <th><?php echo get_phrase('contact_number'); ?></th>
            <th><?php echo get_phrase('address'); ?></th>
            <th><?php echo get_phrase('status'); ?></th>
            <th><?php echo get_phrase('prescription'); ?></th>
            <th><?php echo get_phrase('Upload Receipt'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  
        $prescription_info=$this->crud_model->select_outstanding_order_info();
        $i=1;foreach ($prescription_info as $row1) {$user_info=$this->crud_model->select_user_information($row1['user_id']);
           $prescription_info=$this->crud_model->select_prescription_information($row1['prescription_id']);
           foreach ($user_info as $user1) {
            
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php $doc=$this->db->where('doctor_id',$prescription_info['doctor_id'])->get('doctors')->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name?></td>
                <td><?php echo $user1['name'] ?></td>
                <td><?php echo $user1['phone'] ?></td>
                <td><?php echo $user1['address'] ?></td>
                <td><?php if($row1['status']==1){echo "Completed";}elseif($row1['status']==2){echo "Pending";} ?></td>
                <td><a href="<?php echo base_url(); ?>main/prescription_history/<?php echo $row1['prescription_id'].'/'.$row1['order_id'] ?>" class="hiper"><i class="fa fa-file"></i></a></td>
                <td><form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/upload_receipt/<?=$row1['order_id'];?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                        <div class="col-sm-12">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new"><?php echo 'Select Receipt';?></span>
                                        <span class="fileinput-exists"><?php echo $this->lang->line('labels')['change'];?></span>
                                        <input type="file" name="userfile" id="userfile" accept="image/*" id="userfile" value="<?php echo set_value('userfile'); ?>"   data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>">
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo $this->lang->line('labels')['remove'];?></a>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">
                        </div>
                    </div>
                </form>
                    <!-- Trigger the modal with a button -->
<!--   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button> -->

  
                </td>
            </tr>
            <!-- Modal -->
 <!--  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Uploade Receipt</h4>
        </div>
        <div class="modal-body">
          <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_nurse/<?=$row1['order_id']?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="x" value="<?=$row1['order_id']?>">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> -->
        <?php } $i++;} ?>
    </tbody>
</table>
    </div>
</div>
<?php }?>

<!-- <script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-md-3 col-left'l><'col-xs-9 col-md-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-md-3 col-left'i><'col-xs-9 col-md-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script> -->
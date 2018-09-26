<style>
  .exam_chart {
    width       : 100%;
    height      : 265px;
    font-size   : 11px;
  }
</style>

<?php
 $single_hospital_info = $this->db->get_where('hospitals', array('hospital_id' => $hospital_id))->result_array();

foreach ($single_hospital_info as $row) :
  
        
?>
<div class="profile-env">
    
    <div class="col-md-12">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-home"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('basic_info'); ?></span>
                </a>
            </li>
             <li class="">
                <a href="#tab2" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-user"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('license_info'); ?></span>
                </a>
            </li>
           <li class="">
                <a href="#tab3" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('branches'); ?></span>
                </a>
            </li> 
            <li class="">
                <a href="#tab4" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('departments'); ?></span>
                </a>
            </li> 
            <li class="">
                <a href="#tab5" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('wards'); ?></span>
                </a>
            </li> 
            <li class="">
                <a href="#tab6" data-toggle="tab" class="btn btn-default">
                    <span class="visible-xs"><i class="entypo-mail"></i></span>
                    <span class="hidden-xs"><?php echo get_phrase('beds'); ?></span>
                </a>
            </li> 
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
        <?php
        if($row['hospital_status']==1){$hospital_status='Active';}else{$hospital_status='Inactive';}
          $basic_info_titles = ['name','description', 'address',  'email', 'phone number', 'country', 'state', 'district', 'city', 'owner/MD_name','owner/MD_phone_number','status'];
          $basic_info_values = [$row['name'],$row['description'],$row['address'], $row['email'], $row['phone_number'],$this->db->get_where('country', array('country_id' => $row['country']))->row()->name,$this->db->get_where('state', array('state_id' => $row['state']))->row()->name,$this->db->get_where('district', array('district_id' => $row['district']))->row()->name,$this->db->get_where('city', array('city_id' => $row['city']))->row()->name,$row['md_name'],$row['md_contact_number'],$hospital_status];
        ?>
        <table class="table table-bordered table-hover" style="margin-top: 20px;">
          <tbody>
          <?php for ($i=0; $i < count($basic_info_titles) ; $i++) { ?>
            <tr>
              <td width="30%">
                <strong><?php echo get_phrase($basic_info_titles[$i]); ?></strong>
              </td>
              <td><?php echo $basic_info_values[$i]; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
            </div>
             <div class="tab-pane" id="tab2">
        <?php
          if($row['llicense_status']==1){$llicense_status='Active';}else{$llicense_status='Inactive';}
          $license_info_titles = ['license','license_status', 'from_date',  'to_date'];
          $license_info_values = [$this->db->get_where('license', array('license_id' => $row['license']))->row()->name,$llicense_status,$row['from_date'],$row['till_date']];
        ?>
        <table class="table table-bordered table-hover" style="margin-top: 20px;">
          <tbody>
          <?php for ($i=0; $i < count($license_info_titles) ; $i++) { ?>
            <tr>
              <td width="30%">
                <strong><?php echo get_phrase($license_info_titles[$i]); ?></strong>
              </td>
              <td><?php echo $license_info_values[$i]; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
            </div>
            <div class="tab-pane" id="tab3">
<!-- 
        <a href="<?php echo base_url(); ?>index.php?superadmin/add_branch/<?php echo $row['hospital_id'];?>"><button onclick="" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_branch'); ?>
</button></a>
 -->
<div style="clear:both;"></div>

<table class="table table-bordered table-striped datatable" id="table-2">  
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('name'); ?></th>
           <!--  <th><?php echo get_phrase('hospital'); ?></th>
            <th><?php echo get_phrase('address'); ?></th> -->
            <th><?php echo get_phrase('email'); ?></th>
            <th><?php echo get_phrase('phone'); ?></th>
            <th><?php echo get_phrase('departments'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  
        $branch_info=$this->db->where('hospital_id',$row['hospital_id'])->get('branch')->result_array();
        $i=1;foreach ($branch_info as $row) {
            
            ?>
        
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $row['name'] ?></td>
               <!--  <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $row['address'] ?></td>   -->
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['phone'] ?></td>
                <td>
            <a href="<?php echo base_url(); ?>index.php?superadmin/get_hospital_departments/<?php echo $row['branch_id'] ?>" title="Departments"><i class="glyphicon glyphicon-eye-open"></i></a>
                </td>
                <td>
            <a href="<?php echo base_url(); ?>index.php?superadmin/edit_branch/<?php echo $row['branch_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/branch/delete/<?php echo $row['branch_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
            </div>
            <div class="tab-pane" id="tab4">

       <!-- <a href="<?php echo base_url(); ?>index.php?superadmin/add_department/<?= $branch_id?>"><button  
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_department'); ?>
</button></a> -->
<div style="clear:both;"></div>

<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('branch_name'); ?></th>
            <th><?php echo get_phrase('wards'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $department_info=$this->db->where('hospital_id',$row['hospital_id'])->get('department')->result_array();
         $i=1;foreach ($department_info as $row) { ?>   
            <tr>  
                <td><?php echo $i;?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><a href="<?php echo base_url(); ?>index.php?superadmin/get_hospital_ward/<?php echo $row['department_id'] ?>" title="Wards"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                <td>
              <a href="<?php echo base_url(); ?>index.php?superadmin/edit_department/<?php echo $row['department_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="<?php echo base_url(); ?>index.php?superadmin/get_hospital_ward/<?php echo $row['department_id'] ?>" title="Wards"><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/department/delete/<?php echo $row['department_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
           
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
            </div>
            <div class="tab-pane" id="tab5">

<!--  <a href="<?php echo base_url(); ?>index.php?superadmin/add_ward/<?= $department_id;?>"><button  
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_ward'); ?>
</button></a> -->
<div style="clear:both;"></div>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('sl_no'); ?></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('branch_name'); ?></th>
            <th><?php echo get_phrase('department_name'); ?></th>
            <th><?php echo get_phrase('beds'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        
        <?php 
        $ward_info=$this->db->where('hospital_id',$row['hospital_id'])->get('ward')->result_array();
        $i=1;foreach ($ward_info as $row) { ?>   
            <tr>  
                <td><?php echo $i;?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><?php echo $this->db->where('department_id',$row['department_id'])->get('department')->row()->name; ?></td>
                <td><a href="<?php echo base_url(); ?>index.php?superadmin/get_hospital_bed/<?php echo $row['ward_id'] ?>" title="Beds"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                <td>
             <a href="<?php echo base_url(); ?>index.php?superadmin/edit_ward/<?php echo $row['ward_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/ward/delete/<?php echo $row['ward_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                 
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>

            </div>
            <div class="tab-pane" id="tab6">
                <!-- <a href="<?php echo base_url();?>index.php?superadmin/add_bed/<?= $ward_id;?>"><button onclick="" 
    class="btn btn-primary pull-right">
        <?php echo get_phrase('add_bed'); ?>
</button></a> -->
<div style="clear:both;"></div>

<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('Sl_no');?></th>
            <th><?php echo get_phrase('name'); ?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php echo get_phrase('branch_name'); ?></th>
            <th><?php echo get_phrase('department_name'); ?></th>
            <th><?php echo get_phrase('ward_name'); ?></th>
            
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $bed_info=$this->db->where('hospital_id',$row['hospital_id'])->get('bed')->result_array(); 
        $i=1;
        foreach ($bed_info as $row) { ?>   
            <tr>
             
                <td><?php echo $i;?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $this->db->where('hospital_id',$row['hospital_id'])->get('hospitals')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['branch_id'])->get('branch')->row()->name; ?></td>
                <td><?php echo $this->db->where('branch_id',$row['department_id'])->get('department')->row()->name; ?></td>
                <td><?php echo $this->db->where('ward_id',$row['ward_id'])->get('ward')->row()->name; ?></td>
                
                <td>
            <a href="<?php echo base_url(); ?>index.php?superadmin/edit_bed/<?php echo $row['bed_id'] ?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/bed/delete/<?php echo $row['bed_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
       <?php $i++; } ?>
    </tbody>
</table>

            </div>
        
        </div>

  </div>     
</div>
<?php endforeach; ?>
<!-- <script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-md-3 col-xs-12 col-left'l><'col-md-9 col-xs-12  col-right'<'export-data'T>f>r>t<'row'<' col-md-3 col-xs-12 col-left'i><'col-md-9 col-xs-12 col-right'p>>"
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
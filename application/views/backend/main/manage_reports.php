<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>main/report_chart1/<?php echo $report_id;?>/" method="post">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">   
            <div class="panel-heading">

<div class="col-sm-8">
                  <div class="form-group">
         <span for="field-ta" class="col-sm-2 control-label"><b> <?php echo get_phrase('date_range'); ?></b></span> 
         <div class="col-sm-5">
        <input  class="form-control notranslate" onclick="return get_report_data(this.value)" name="report" id="reportrange" value="<?php if((isset($_GET['sd']) && $_GET['sd'] != "") AND (isset($_GET['ed']) && $_GET['ed'] != "")){echo date('M d,Y',strtotime($_GET['sd'])).' - '.date('M d,Y',strtotime($_GET['ed']));}else{echo date('M d,Y', strtotime('-29 days')).' - '.date('M d,Y');}?>"/>
        </div>
                </div>
</div>
    <button type="submit" onClick="" id="delete" class="btn btn-info pull-right btn-lg" style="margin-left: 2px;">
        <i class="fa fa-bar-chart-o"></i>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-info pull-right btn-lg" style="margin-left: 2px;">
        <i class="fa fa-bar-chart-o"></i>
</button>
<input type="hidden" class="form-control" name="sd" id="sd" value="<?php if((isset($_GET['sd']) && $_GET['sd'] != "")){echo date('Y-m-d',strtotime($_GET['sd']));}else{echo date('Y-m-d', strtotime('-29 days'));}?>"/>
<input type="hidden" class="form-control" name="ed" id="ed" value="<?php if((isset($_GET['ed']) && $_GET['ed'] != "")){echo date('Y-m-d',strtotime($_GET['ed']));}else{echo date('Y-m-d');}?>"/>
</div>
<div class="panel-body">
<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">
    <thead>
        <tr>
         <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <?php if($account_type == 'superadmin'){?>
            <th data-field="id" data-sortable="true"><?php echo get_phrase('hospital_id');?></th>
            <th data-field="name" data-sortable="true"><?php echo get_phrase('hospital_name'); ?></th>
        <?php }elseif($account_type == 'hospitaladmins'){?>
            <th data-field="branch" data-sortable="true"><?php echo get_phrase('branch_name'); ?></th>
        <?php }?>
            <th data-field="number" data-sortable="true"><?php if($report_id==1){
        echo get_phrase('number_of_patients');
        }elseif($report_id==2){
        echo get_phrase('number_of_appointments');
        } ?></th>
            <th><?php echo get_phrase('action'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  $i=1;foreach ($hospital_info as $row) {
            ?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" id="check_<?php echo $i;?>" value="<?php if($account_type == 'superadmin'){ echo $row['hospital_id'];}elseif($account_type == 'hospitaladmins'){echo $row['branch_id'];} ?>"></td>
                <?php if($account_type == 'superadmin'){?>
                <td><?php echo $row['unique_id'];?></td>
            <?php }?>
                <td><a href="<?php echo base_url();?>main/get_hospital_history/<?php echo $row['hospital_id'];?>" class="hiper"><?php echo $row['name'];?></a></td>
                 <td><?php if($report_id==1){
        if((isset($_GET['sd']) && $_GET['sd'] != "") AND (isset($_GET['ed']) && $_GET['ed'] != "")){
            if($account_type == 'superadmin'){
            $no=$this->db->get_where('inpatient',array('hospital_id'=>$row['hospital_id'],'status!='=>0,'created_date>='=>date('Y-m-d 00:00:00', strtotime($_GET['sd'])),'created_date<='=>date('Y-m-d 23:59:59', strtotime($_GET['ed']))))->num_rows();
            echo $no;
        }elseif($account_type == 'hospitaladmins'){
            $this->db->where('branch_id', $row['branch_id']);
            $no=$this->db->get('doctors')->result_array();
            $cou=0;
            for($i=0;$i<count($no);$i++){
                $cou=$cou+$this->db->get_where('inpatient',array('doctor_id'=>$no[$i]['doctor_id'],'status!='=>0,'created_date>='=>date('Y-m-d 00:00:00', strtotime($_GET['sd'])),'created_date<='=>date('Y-m-d 23:59:59', strtotime($_GET['ed']))))->num_rows();
            }
            echo $cou;
        }
        }else{
            if($account_type == 'superadmin'){
            $no=$this->db->get_where('inpatient',array('hospital_id'=>$row['hospital_id'],'status!='=>0,'created_date>='=>date('Y-m-d 00:00:00', strtotime('-29 days')),'created_date<='=>date('Y-m-d 23:59:59')))->num_rows();
            echo $no;
            }elseif($account_type == 'hospitaladmins'){
            $this->db->where('branch_id', $row['branch_id']);
            $no=$this->db->get('doctors')->result_array();
            $cou=0;
            for($i=0;$i<count($no);$i++){
                $cou=$cou+$this->db->get_where('inpatient',array('doctor_id'=>$no[$i]['doctor_id'],'status!='=>0,'created_date>='=>date('Y-m-d 00:00:00', strtotime('-29 days')),'created_date<='=>date('Y-m-d 23:59:59')))->num_rows();
            }
            echo $cou;
        }
        }
        }elseif($report_id==2){
        if((isset($_GET['sd']) && $_GET['sd'] != "") AND (isset($_GET['ed']) && $_GET['ed'] != "")){
            if($account_type == 'superadmin'){
            $this->db->where('appointment_date >=', $_GET['sd']);
            $this->db->where('appointment_date <=', $_GET['ed']);
            $this->db->where('hospital_id', $row['hospital_id']);
            $no=$this->db->get('appointments')->num_rows();
            echo $no;
            }elseif($account_type == 'hospitaladmins'){
             $this->db->where('branch_id', $row['branch_id']);
            $no=$this->db->get('doctors')->result_array();
            $cou=0;
            for($i=0;$i<count($no);$i++){
            $this->db->where('appointment_date >=', $_GET['sd']);
            $this->db->where('appointment_date <=', $_GET['ed']);
            $cou=$cou+$this->db->where('doctor_id',$no[$i]['doctor_id'])->get('appointments')->num_rows();
            }
            echo $cou;
        }
        }else{
        if($account_type == 'superadmin'){
            $this->db->where('appointment_date >=', date('Y-m-d', strtotime('-29 days')));
            $this->db->where('appointment_date <=', date('Y-m-d'));
            $no=$this->db->get_where('appointments',array('hospital_id'=>$row['hospital_id']))->num_rows();
            echo $no;
        }elseif($account_type == 'hospitaladmins'){
            $this->db->where('branch_id', $row['branch_id']);
            $no=$this->db->get('doctors')->result_array();
            $cou=0;
            for($i=0;$i<count($no);$i++){
                $cou=$cou+$this->db->get_where('appointments',array('doctor_id'=>$no[$i]['doctor_id'],'appointment_date>='=>date('Y-m-d', strtotime('-29 days')),'appointment_date<='=>date('Y-m-d')))->num_rows();
            }
            echo $cou;
        }
        }
        } ?></td> 
                 <td>
                    <?php 
                    if($account_type == 'superadmin')
                        {
                        $hb_id=$row['hospital_id'];
                    }elseif($account_type == 'hospitaladmins')
                    {
                        $hb_id=$row['branch_id'];
                    }
                    ?>
            <a href="<?php echo base_url(); ?>main/report_chart/<?php echo $report_id.'/'.$hb_id;?>/<?php if($_GET['sd']!=''){echo $_GET['sd'];}else{echo date('Y-m-d', strtotime('-29 days'));}?>/<?php if($_GET['ed']!=''){echo $_GET['ed'];}else{echo date('Y-m-d');}?>" title="Report" class="btn btn-info btn-lg"><i class="fa fa-bar-chart-o"></i></a>     
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
<script type="text/javascript">
        
    $(document).ready(function(){
        var start = moment().subtract(29, 'days');
        var end = moment();

        <?php
        if(isset($_GET['sd']) && $_GET['sd'] != ""){
            ?>
            start = moment('<?php echo $_GET['sd'];?>');
            <?php
        }
        ?>

        <?php
        if(isset($_GET['ed']) && $_GET['ed'] != ""){
            ?>
            end = moment('<?php echo $_GET['ed'];?>');
            <?php
        }
        ?>
        function cb(start, end) {
            window.location.href = '<?php echo base_url();?>main/report/<?php echo $report_id;?>?sd='+start.format('YYYY-MM-DD')+"&ed="+end.format('YYYY-MM-DD');

        }
        
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            locale: { 
                applyLabel : '<?php echo $this->lang->line('apply');?>',
                cancelLabel: '<?php echo $this->lang->line('clear');?>',
                "customRangeLabel": "<?php echo $this->lang->line('custom');?>",
            },  
            ranges: {
                '<?php echo $this->lang->line('today');?>': [moment(), moment()],
                '<?php echo $this->lang->line('yesterday');?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '<?php echo $this->lang->line('last_7_day');?>': [moment().subtract(6, 'days'), moment()],
                '<?php echo $this->lang->line('last_30_day');?>': [moment().subtract(29, 'days'), moment()],
                '<?php echo $this->lang->line('this_month');?>': [moment().startOf('month'), moment().endOf('month')],
                '<?php echo $this->lang->line('last_month');?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        },cb);

    });

</script>


<div class="col-sm-5">
                  <div class="form-group">
         <label for="field-ta" class="col-sm-3 control-label"><b> <?php echo get_phrase('select_date'); ?></b></label> 
        <input  class="form-control" onclick="return get_report_data(this.value)" name="report" id="reportrange" value="<?php if((isset($_GET['sd']) && $_GET['sd'] != "") AND (isset($_GET['ed']) && $_GET['ed'] != "")){echo date('M d,Y',strtotime($_GET['sd'])).' - '.date('M d,Y',strtotime($_GET['ed']));}else{echo date('M d,Y', strtotime('-29 days')).' - '.date('M d,Y');}?>"/>
                </div>
</div>

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
            window.location.href = '<?php echo base_url();?>index.php?/superadmin/report/<?php echo $report_id;?>?sd='+start.format('YYYY-MM-DD')+"&ed="+end.format('YYYY-MM-DD');

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


<?php 
$this->session->set_userdata('last_page', current_url());
?>
<form action="<?php echo base_url()?>index.php?superadmin/report_chart1/<?php echo $report_id;?>/" method="post">
    <button type="submit" onClick="" id="delete" class="btn btn-info pull-right btn-lg" style="margin-left: 2px;">
        <i class="fa fa-bar-chart-o"></i>
</button>
<button type="button" onClick="checkone(this.form);" id="delete1" class="btn btn-info pull-right btn-lg" style="margin-left: 2px;">
        <i class="fa fa-bar-chart-o"></i>
</button>
<input type="hidden" class="form-control" name="sd" id="sd" value="<?php if((isset($_GET['sd']) && $_GET['sd'] != "")){echo date('Y-m-d',strtotime($_GET['sd']));}else{echo date('Y-m-d', strtotime('-29 days'));}?>"/>
<input type="hidden" class="form-control" name="ed" id="ed" value="<?php if((isset($_GET['ed']) && $_GET['ed'] != "")){echo date('Y-m-d',strtotime($_GET['ed']));}else{echo date('Y-m-d');}?>"/>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><input type="checkbox" name="all_check" class="all_check" id="all_check" value=""></th>
            <th><?php echo get_phrase('hospital_id');?></th>
            <th><?php echo get_phrase('hospital_name'); ?></th>
            <th><?php if($report_id==1){
        echo get_phrase('number_of_patients');
        }elseif($report_id==2){
        echo get_phrase('number_of_appointments');
        } ?></th>
            <th><?php echo get_phrase('action'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php  $i=1;foreach ($hospital_info as $row) {?>   
            <tr>
                <td><input type="checkbox" name="check[]" class="check" value="<?php echo $row['hospital_id'] ?>"></td>
                <td><?php echo $row['unique_id'];?></td>
                <td><a href="<?php echo base_url();?>index.php?superadmin/get_hospital_history/<?php echo $row['hospital_id'];?>" class="hiper"><?php echo $row['name'] ?></a></td>
                 <td><?php if($report_id==1){
        if((isset($_GET['sd']) && $_GET['sd'] != "") AND (isset($_GET['ed']) && $_GET['ed'] != "")){
            $this->db->where('created_date >=', date('m/d/Y',strtotime($_GET['sd'])));
            $this->db->where('created_date <=', date('m/d/Y',strtotime($_GET['ed'])));
            $this->db->where('hospital_id', $row['hospital_id']);
            $no=$this->db->get('inpatient')->num_rows();
            echo $no;
        }else{
           $this->db->where('hospital_id', $row['hospital_id']);
            $no=$this->db->get('inpatient')->num_rows();
            echo $no;
        }
        }elseif($report_id==2){
        if((isset($_GET['sd']) && $_GET['sd'] != "") AND (isset($_GET['ed']) && $_GET['ed'] != "")){
            $this->db->where('appointment_date >=', date('m/d/Y',strtotime($_GET['sd'])));
            $this->db->where('appointment_date <=', date('m/d/Y',strtotime($_GET['ed'])));
            $this->db->where('hospital_id', $row['hospital_id']);
            $no=$this->db->get('appointments')->num_rows();
            echo $no;
        }else{
           $this->db->where('hospital_id', $row['hospital_id']);
            $no=$this->db->get('appointments')->num_rows();
            echo $no;
        }
        } ?></td> 
                 <td>
            <a href="<?php echo base_url(); ?>index.php?superadmin/report_chart/<?php echo $report_id.'/'.$row['hospital_id'];?>/<?php if($_GET['sd']!=''){echo $_GET['sd'];}else{echo date('Y-m-d', strtotime('-29 days'));}?>/<?php if($_GET['ed']!=''){echo $_GET['ed'];}else{echo date('Y-m-d');}?>" title="Report" class="btn btn-info btn-lg"><i class="fa fa-bar-chart-o"></i></a>     
                </td>
            </tr>
        <?php $i++;} ?>
    </tbody>
</table>
</form>
<script type="text/javascript">
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
</script>
<SCRIPT language="javascript">
/*$(function(){
$("#delete1").show();
$("#delete").hide();
    // add multiple select / deselect functionality
    $("#all_check").click(function () {
        $("#delete1").hide();
            $("#delete").show();
          $('.checkbox').attr('checked', this.checked);
    });

    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".checkbox").click(function(){

        if($(".checkbox").length == $(".checkbox:checked").length) {
            $("#delete1").show();
            $("#delete").hide();
            $("#all_check").attr("checked", "checked");
        } else {
            $("#all_check").removeAttr("checked");
        }

    });*/
/*    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
        
         $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $("#delete1").hide();
                $("#delete").show();
                
            }
            else if($(this).prop("checked") == false){
            $("#delete1").show();
            $("#delete").hide();
               
            }
        });
    });
});*/
</SCRIPT>
 <script type="text/javascript">
   /*  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }

}*/
    $(document).ready(function(){
        $("#delete1").show();
        $("#delete").hide();
        $("#all_check").click(function () {
            $('.check').attr('checked', this.checked);
            if($(".check:checked").length == 0){
                $("#delete1").show();
                $("#delete").hide();
            }else{
            $("#delete1").hide();
            $("#delete").show();
            }
            
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

   /*      $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $("#delete1").hide();
                $("#delete").show();
                
            }
            else if($(this).prop("checked") == false){
            $("#delete1").show();
            $("#delete").hide();
               
            }
        });*/
    });
</script> 

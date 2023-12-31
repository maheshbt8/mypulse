<?php 
$this->session->set_userdata('last_page', current_url());
?>
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs bordered"> 
            <li class="active">
                <a href="#h1" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Reports uploaded by Medical Labs';?>

                </a>
            </li>
            <li>
                <a href="#h2" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo 'Reports uploaded by Doctors';?>
                </a>
            </li>
        </ul>
    <div class="panel panel-default">
            <div class="panel-body">
         <div class="tab-content">
    <div class="tab-pane box active" id="h1" style="padding: 5px">
          
           
<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th data-field="id" data-sortable="true"><?php echo get_phrase('sl_no.'); ?></th>
            <th data-field="title" data-sortable="true"><?php echo get_phrase('title'); ?></th>
            <th data-field="date" data-sortable="true"><?php echo get_phrase('date'); ?></th>
            <th><?php echo get_phrase('visibility'); ?></th>
            <th data-field="health_report" data-sortable="true"><?php echo get_phrase('health_report'); ?></th>
            <?php if($account_type == 'users'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php
        $i=1;foreach ($health_reports as $row1) {
if($row1['type_of_order']==0){
        $rep_data=$this->db->get_where('prescription',array('prescription_id'=>$row1['prescription_id']))->row_array();
        $rep_exp1=explode('|',$this->encryption->decrypt($rep_data['prescription_data']));
        $rep_exp_data=explode(',',$rep_exp1[7]);
    }elseif($row1['type_of_order']==1){
        $rep_exp2=explode('|',$this->encryption->decrypt($row1['order_data']));
        $rep_exp_data=explode(',',$rep_exp2[1]);
    }
    
         for($j=0;$j<count($rep_exp_data);$j++) {
        $report=$this->db->get_where('reports',array('order_id'=>$row1['order_id']))->result_array();
        if(count($report)>0){
        if($report[$j]['row_status_cd']!=0){     
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $rep_exp_data[$j];?></td>
                <td><?php echo $report[$j]['created_at'] ?></td>
                <td><?php if($report[$j]['row_status_cd']==1){?><a href="<?php echo base_url(); ?>main/health_reports/status/<?= $report[$j]['report_id'];?>/2"><span style="color: green"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Visible";?></span></a><?php }elseif($report[$j]['row_status_cd']==2){?><a href="<?php echo base_url(); ?>main/health_reports/status/<?= $report[$j]['report_id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Hidden";?></span></a><?php }?></td>
                <td><?php if($report[$j]['extension']!=''){?><a href="<?=base_url('main/reports_view/').$report[$j]['report_id'];?>" class="hiper" ><input type="button" value="View Reports" class="btn btn-info " /></a><?php }?></td>
               <?php if($account_type == 'users'){?>
                <td> 
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/health_reports/delete/<?= $report[$j]['report_id'];?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>&nbsp;
            
                </td><?php }?>
            </tr>
        <?php $i++;}}} }?>
    </tbody>
</table>
</div>
<div class="tab-pane box" id="h2" style="padding: 5px">
       <!--  <div class="panel-body">
            
            <?php if($account_type=='users'){?>
<button type="button" onclick="window.location.href = '<?php echo base_url(); ?>main/add_health_reports/<?=$this->session->userdata('login_user_id');?>'" class="btn btn-primary pull-right">
        <?php echo get_phrase('add_health_report'); ?>
</button>
<?php }?>
        </div> -->
<table data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table-bordered">  
    <thead>
        <tr>
            <th data-field="id" data-sortable="true"><?php echo get_phrase('sl_no'); ?></th>
            <th data-field="title" data-sortable="true"><?php echo get_phrase('title'); ?></th>
            <th data-field="created_by" data-sortable="true"><?php echo get_phrase('created_by'); ?></th>
            <th data-field="date" data-sortable="true"><?php echo get_phrase('date'); ?></th>
            <th><?php echo get_phrase('visibility'); ?></th>
            <th data-field="health_report" data-sortable="true"><?php echo get_phrase('health_report'); ?></th>
            <?php if($account_type == 'users'){?>
            <th><?php echo get_phrase('options'); ?></th><?php }?>
        </tr>
    </thead>

    <tbody>
        <?php
        $report=$this->db->get_where('reports',array('user_id'=>$this->session->userdata('login_user_id')))->result_array();
        $i=1;foreach ($report as $row) {
            if($row['row_status_cd']!=0){
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php $exp=explode('_',$row['created_by']);
                $role_type=substr($exp[0],0,-2);
                $role=$this->crud_model->get_role($role_type);
                if($role['code']=='MPD'){
                $doc=$this->db->get_where($role['type'],array('unique_id'=>$row['created_by']))->row();echo $this->db->where('hospital_id',$doc->hospital_id)->get('hospitals')->row()->name.' / '.$doc->name;}elseif($role['code']=='users'){echo 'Created By Me';}?></td>
                <td><?php echo $row['created_at'] ?></td>
                <td><?php if($row['row_status_cd']==1){?><a href="<?php echo base_url(); ?>main/health_reports/status/<?= $row['report_id'];?>/2"><span style="color: green"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Visible";?></span></a><?php }elseif($row['row_status_cd']==2){?><a href="<?php echo base_url(); ?>main/health_reports/status/<?= $row['report_id'];?>/1"><span style="color: red"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo "Hidden";?></span></a><?php }?></td>
                <td><?php if($row['extension']!=''){?><a href="<?=base_url('main/reports_view/').$row['report_id'];?>" class="hiper" ><input type="button" value="View Reports" class="btn btn-info " /></a><?php }?></td>
               <?php if($account_type == 'users'){?>
                <td> 
            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/health_reports/delete/<?= $row['report_id'];?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>&nbsp;
            
                </td><?php }?>
            </tr>
        <?php $i++;}}?>
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
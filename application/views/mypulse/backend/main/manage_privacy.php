<?php 
$this->session->set_userdata('last_page1', current_url());
?>
<style>
	p{
		color: #000;
	}
</style>
<div class="row">
	<div class="col-md-12">
    <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
				<?php echo 'Privacy & Policy';?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
				<?php echo 'Terms & Conditions';?>
                    	</a></li>
		</ul>
    	<!--CONTROL TABS END-->
        
	<div class="panel panel-default">   
            <div class="panel-body">
		<div class="tab-content">
        
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
            	<div class="col-md-12">

        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" style="font-size: 16px; color: black; text-align: center;">
<a href="<?php echo base_url()?>main/edit_privacy/1" class="btn btn-info pull-right"><i class="glyphicon glyphicon-pencil"></i> &nbsp;Edit</a>
                </div>
            </div>
            <div class="panel-body">
            	<?php 
            	$privacy= $this->db->get_where('settings', array('type' => 'privacy'))->row()->description;
            	echo $privacy;
            	?>
            </div>
        </div>
    </div>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">

                	<div class="col-md-12">

        <div class="panel panel-default" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" style="font-size: 16px; color: black; text-align: center;">
<a href="<?php echo base_url()?>main/edit_privacy/2" class="btn btn-info pull-right"><i class="glyphicon glyphicon-pencil"></i> &nbsp;Edit</a>
                </div>
            </div>
            <div class="panel-body">
            	<?php 
            	$privacy= $this->db->get_where('settings', array('type' => 'terms'))->row()->description;
            	echo $privacy;
            	?>
            </div>
        </div>
    	                
                </div>                
			</div>
		</div>
	</div>
</div>
</div>
</div>
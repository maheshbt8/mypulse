<hr />
<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
				<?php echo get_phrase('health_insurance_provider_list'); ?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
				<?php echo get_phrase('add_health_insurance_provider'); ?>
                    	</a></li>
		</ul>
    	<!--CONTROL TABS END-->
        
	
		<div class="tab-content">
        <br>
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('health_insurance_provider_name'); ?></div></th>
                    	    <th><div><?php echo get_phrase('options'); ?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($health_insurance_provider as $row):?>
                        <tr>
							<td><?php echo $row['name'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_country/<?php echo $row['health_insurance_provider_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo 'Edit';?>
                                            </a>
                                                    </li>

                                    
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?superadmin/health_insurance_provider/create/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('health_insurance_provider_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name"
                                        data-validate="required" data-message-required="<?php echo 'Value_required';?>"/>
                                </div>
                            </div>
                            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_health_insurance_provider');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>
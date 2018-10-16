<hr />
<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
				<?php echo get_phrase('license_list'); ?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
				<?php echo get_phrase('add_license'); ?>
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
                    		<th><div><?php echo get_phrase('license_code'); ?></div></th>
                    		<th><div><?php echo get_phrase('license_name'); ?></div></th>
                            <th><div><?php echo get_phrase('description'); ?></div></th>
                    	    <th><div><?php echo get_phrase('options'); ?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($license as $row):?>
                        <tr>
                            <td><?php echo $row['license_code'];?></td>
							<td><?php echo $row['name'];?></td>
                            <td><?php echo $row['description'];?></td>
							<td>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/edit_license/<?php echo $row['license_id'];?>');" title="Edit">
                                            <i class="entypo-pencil"></i>     
                                            </a>
                             <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?superadmin/license/delete/<?php echo $row['license_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i>
                             </a>

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
                	<?php echo form_open(base_url() . 'index.php?superadmin/license/create/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('license_code');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="license_code" data-validate="required" data-message-required="<?php echo 'Value_required';?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('license_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name"
                                        data-validate="required" data-message-required="<?php echo 'Value_required';?>"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" name="description" data-validate="required" data-message-required="<?php echo 'Value_required';?>"></textarea>
                                </div>
                            </div>
                            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_license');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>
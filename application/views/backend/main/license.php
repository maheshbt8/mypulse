<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<div class="row">
	<div class="col-md-12">
    <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
				<?php echo get_phrase('license_list'); ?>
                    	</a></li>
		<li>
        	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
				<?php echo get_phrase('add_license'); ?>
            </a>
        </li>
        <li>
            <a href="#category" data-toggle="tab"><i class="entypo-plus-circled"></i>
                <?php echo get_phrase('add_license_category'); ?>
            </a>
        </li>

		</ul>
    	<!--CONTROL TABS END-->
        <div class="panel panel-default">   
            <div class="panel-body">
	
		<div class="tab-content">
        
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('license_code'); ?></div></th>
                    		<th><div><?php echo get_phrase('license_name'); ?></div></th>
                            <th><div><?php echo get_phrase('description'); ?></div></th>
                            <td><?php echo get_phrase('license_category');?></td>
                    	    <th><div><?php echo get_phrase('options'); ?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($license as $row):?>
                        <tr>
                            <td><a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_license/<?php echo $row['license_id'];?>');" class="hiper" ><?php echo $row['license_code'];?></a></td>
							<td><?php echo $row['name'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td><?php $license=$this->crud_model->select_license_category_id($row['license_category_id']);?>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_license_category/<?php echo $row['license_category_id'];?>');" class="hiper">
                            <?php echo $license['license_category_code'].' / '.$license['name'];?></a></td>
							<td>
                            <!-- <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_license/<?php echo $row['license_id'];?>');" title="Edit">
                                            <i class="fa fa-pencil"></i>     
                                            </a>&nbsp; -->
                             <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>main/license/delete/<?php echo $row['license_id'] ?>');" title="Delete"><i class="glyphicon glyphicon-remove"></i>
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
        <?php echo form_open(base_url() . 'main/license/create/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('license_category');?></label>
    <div class="col-sm-5">
                                    <select class="form-control select2" name="license_category" data-validate="required" data-message-required="<?php echo 'Value_required';?>">
                <option value="">-- Select License Category --</option>
                <?php 
                $admins = $this->db->get_where('license_category')->result_array();
                foreach($admins as $row1){?>
                <option value="<?php echo $row1['license_category_id'] ?>"><?php echo $row1['license_category_code'].' / '.$row1['name'] ?></option>
                                
                                <?php } ?>
                                    </select>
                                </div>
                            </div>
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
                                  <button type="submit" class="btn btn-success pull-right"><?php echo get_phrase('add_license');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            <!-- Category -->
            <div class="tab-pane box" id="category" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'main/license_category/create/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('license_category_code');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="license_category_code" data-validate="required" data-message-required="<?php echo 'Value_required';?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('license_category_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="license_category_name"
                                        data-validate="required" data-message-required="<?php echo 'Value_required';?>"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('license_category_description');?></label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" name="license_category_description" data-validate="required" data-message-required="<?php echo 'Value_required';?>"></textarea>
                                </div>
                            </div>
                            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-success  pull-right"><?php echo get_phrase('add_license_category');?></button>
                              </div>
                            </div>
                    </form>                
                </div>                
            </div>
            <!-- Category End -->
		</div>
	</div>
</div>
</div>
</div>
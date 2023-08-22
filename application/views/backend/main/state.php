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
				<?php echo get_phrase('states_list'); ?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
				<?php echo get_phrase('add_state'); ?>
                    	</a></li>
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
                    		<th><div><?php echo get_phrase('country_name'); ?></div></th>
                    		<th><div><?php echo get_phrase('state_name'); ?></div></th>
                    	    <th><div><?php echo get_phrase('options'); ?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($country as $row):
                        ?>
                        <tr>
                            <td><?php $country=$this->crud_model->select_country_info_id($row['country_id']);echo $country['country_name'];?></td>
							<td><?php echo $row['state_name'];?></td>
							<td>
        <?php if($row['row_status_cd']!=0){?>
    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_state/<?php echo $row['state_id'];?>');" title="Edit"><i class="fa fa-pencil"></i></a>
     <a href="#" onclick="confirm_modal('<?php echo base_url();?>main/state/delete/<?php echo $row['state_id'];?>');" id="dellink_2" class="delbtn" data-toggle="modal" data-target=".bs-example-modal-sm" data-id="2" title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
     <?php }else{echo '<span class="error"><b>Deleted</b></span>';}?>
        					</td>
                        </tr>
        <!-- Modal -->
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'main/state/create/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                	<div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country_name'); ?></label> 

                        <div class="col-sm-5">
                            <select name="country_id" id="country" class="form-control select2" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value=""  onchange="return get_branch(this.value)">
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                                
                               
                            </select>
                        </div>
                    </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('state_name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name"
                                        data-validate="required" data-message-required="<?php echo 'Value_required';?>"/>
                                </div>
                            </div>
                            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-success pull-right"><?php echo get_phrase('submit');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>
</div>
</div>
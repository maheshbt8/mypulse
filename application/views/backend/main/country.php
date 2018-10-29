<style>
    .modal-backdrop.in{
        z-index: auto;
    }
</style>
<div class="row">
	<div class="col-md-12">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
				<?php echo $this->lang->line('labels')['countries_list'];?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
				<?php echo $this->lang->line('labels')['add_country'];?>
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
                    		<th><div><?php echo $this->lang->line('labels')['selectCountry'];?></div></th>
                    	    <th><div><?php echo $this->lang->line('labels')['options'];?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($country as $row):?>
                        <tr>
							<td><?php echo $row['name'];?></td>
							<td>
                              <a href="#"><i class="entypo-pencil" data-toggle="modal" data-target="#myModal"></i></a>
        					</td>
                        </tr>
                         <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Country</h4>
        </div>
        <div class="modal-body">
          

         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/country/update/<?=$row['country_id']?>" method="post" enctype="multipart/form-data">
             
        
                <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
         <div class="panel-body">
                <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"
                            data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>" required/>
                    </div>
                </div>
                <br/><br/>
                <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo 'Update';?></button>
              </div>
            </div>
                </div>
                
                </div>
                </div>

        </div>

    </div>
</div>
        </form>
        </div>
      
      </div>
      
    </div>
  </div>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'main/country/create/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['selectCountry'];?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name"
                                        data-validate="required" data-message-required="<?php echo $this->lang->line('validation')['value_required'];?>"/>
                                </div>
                            </div>
                            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo $this->lang->line('buttons')['submit'];?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
            
		</div>
	</div>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">  

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('edit_branch'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/branch/update/<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                    <div class="form-group">     
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('hospital'); ?></label> 

                        <div class="col-sm-8">
                            <select name="hospital" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                <option value=""><?php echo get_phrase('select_hospital'); ?></option>
                                <?php  
                                $admins = $this->db->get_where('hospitals',array('status'=>1))->result_array();
                                foreach($admins as $row1){?>
                                <option value="<?php echo $row1['hospital_id'] ?>"<?php if($row['hospital_id']==$row['hospital_id']){echo "selected";}?>><?php echo $row1['name'] ?></option>
                                
                                <?php } ?>
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('branch_name'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="field-1" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('branch',array('branch_id'=>$id))->row()->name; ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="email" class="form-control" id="field-3"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('branch',array('branch_id'=>$id))->row()->email; ?>">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('phone_number'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="phone_number" class="form-control" id="field-4"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('branch',array('branch_id'=>$id))->row()->phone; ?>">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="address" class="form-control" id="field-2"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('branch',array('branch_id'=>$id))->row()->address; ?>">
                        </div>
                    </div>
                  
                 </div>
                 <div class="col-sm-6">
                  
                   
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label>

                        <div class="col-sm-8">
                            <select name="country" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                <option value=""><?php echo get_phrase('select_country'); ?></option>
                                <!--<?php foreach ($course_info as $row) { ?>
                                    <option value="<?php echo $row['course_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>-->
                                <option value="india"><?php echo get_phrase('india'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('state'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="state" class="form-control" id="field-5"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('branch',array('branch_id'=>$id))->row()->state; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('district'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="district" class="form-control" id="field-6"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('branch',array('branch_id'=>$id))->row()->district; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>

                        <div class="col-sm-8">
                            <input type="text" name="city" class="form-control" id="field-7"  data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="<?php echo $this->db->get_where('branch',array('branch_id'=>$id))->row()->city; ?>">
                        </div>
                    </div>
                       <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('status'); ?></label>

                        <div class="col-sm-8">
                            <?php $status=$this->db->get_where('branch',array('branch_id'=>$id))->row()->status;
                            ?>
                            <select name="status" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="">
                                <option value=""><?php echo get_phrase('select_status'); ?></option>
                                <option value="1"<?php if($status==1){echo "selected";}?>><?php echo get_phrase('active'); ?></option>
                                <option value="2"<?php if($status==2){echo "selected";}?>><?php echo get_phrase('inactive'); ?></option>
                            </select>
                        </div>
                    </div>
                   </div>
                
                    </div>
                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
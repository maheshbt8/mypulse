
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?hospitaladmins/doctor_new_availability/new_availability/<?php echo $doctor_id;?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['repeat_interval'];?></label>

                        <div class="col-sm-3">
                            <select name="repeat_interval" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="" onchange="return show_repete(this.value)">
                                
                                <option value="0"><?php echo $this->lang->line('labels')['weekly'];?></option>
                                <option value="1"><?php echo $this->lang->line('labels')['custom'];?></option>
                            </select>
                        </div>   
                    </div>
                    <div class="form-group" id="weeklyDayDiv" style="display: block;" >
                                    <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['repeat_on'];?></label>
                                    <div class="col-sm-8">
                                    <label><input id="chk_0" class="repeat_on" type="checkbox" name="repeat_on[]" value="0">S</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_1" class="repeat_on" type="checkbox" name="repeat_on[]" value="1">M</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_2" class="repeat_on" type="checkbox" name="repeat_on[]" value="2">T</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_3" class="repeat_on" type="checkbox" name="repeat_on[]" value="3">W</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_4" class="repeat_on" type="checkbox" name="repeat_on[]" value="4">T</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_5" class="repeat_on" type="checkbox" name="repeat_on[]" value="5">F</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_6" class="repeat_on" type="checkbox" name="repeat_on[]" value="6">S</label>&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <span id="weekerror"></span>
                    </div>
                    
                  
                            <div class="form-group">
                                <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['start_date'];?></label>
                               <div class="col-md-3">
                                <input type="text" class="form-control" name="start_on" placeholder="<?php echo $this->lang->line('labels')['select_start_date'];?>" id="start_on" autocomplete="off" data-validate="required" data-message-required="<?php echo 'Value_required';?>">
                                </div>
                                
                                <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['end_date'];?></label>
                               <div class="col-md-3">
                                <input type="text" class="form-control" name="end_on" placeholder="<?php echo $this->lang->line('labels')['select_end_date'];?>" id="end_on" autocomplete="off" data-validate="required" data-message-required="<?php echo 'Value_required';?>">
                                </div>
                            </div>
                       
                        <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['start_time'];?></label>
                <div class="col-sm-9">
                    <div class="col-md-4">
                        <select name="time_start" id= "starting_hour" class="form-control selectbox" data-validate="required" data-message-required="<?php echo 'Value_required';?>">
                            <option value=""><?php echo $this->lang->line('labels')['hours'];?></option>
                            <?php for($i = 1; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="time_start_min" id= "starting_minute" class="form-control selectbox" data-validate="required" data-message-required="<?php echo 'Value_required';?>">
                            <option value=""><?php echo $this->lang->line('labels')['minutes'];?></option>
                            <!-- <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?> -->
                            <option value="00">00</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="starting_ampm" class="form-control selectbox" data-validate="required" data-message-required="<?php echo 'Value_required';?>">
                            <option value="am">am</option>
                            <option value="pm">pm</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['end_time'];?></label>
                <div class="col-sm-9">
                    <div class="col-md-4">
                        <select name="time_end" id= "ending_hour" class="form-control selectbox" data-validate="required" data-message-required="<?php echo 'Value_required';?>">
                            <option value=""><?php echo $this->lang->line('labels')['hours'];?></option>
                            <?php for($i = 1; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="time_end_min" id= "ending_minute" class="form-control selectbox" data-validate="required" data-message-required="<?php echo 'Value_required';?>">
                            <option value=""><?php echo $this->lang->line('labels')['minutes'];?></option>  
                            <!-- <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?> -->
                            <option value="00">00</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="ending_ampm" class="form-control selectbox" data-validate="required" data-message-required="<?php echo 'Value_required';?>">
                            <option value="am">am</option>
                            <option value="pm">pm</option>
                        </select>
                    </div>
                </div>
            </div>
                      

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info pull-right" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page1'); ?>'">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>


<script type="text/javascript">
    function show_repete(id) {
        if(id == 1){
        $("#weeklyDayDiv").hide();
        }
        if(id == 0){
        $("#weeklyDayDiv").show();
        }
    }
</script>
<script type="text/javascript">
                    $(document).ready(function(){
                    var date = new Date();
                    date.setDate(date.getDate());

                    $('#start_on').datepicker({ 
                    startDate: date

                    });

                    $('#end_on').datepicker({ 
                    startDate: date

                    });

                    } );                  

</script>
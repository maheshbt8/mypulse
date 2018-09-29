
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/doctor_new_availability/new_availability/<?php echo $doctor_id;?>" method="post" enctype="multipart/form-data">
                    
                    
                  
                            <div class="form-group">
                                <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['start_date'];?></label>
                               <div class="col-md-3">
                                <input type="text" class="form-control datepicker" name="start_on" placeholder="<?php echo $this->lang->line('labels')['select_start_date'];?>" id="start_on" autocomplete="off">
                                </div>
                                
                                <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['end_date'];?></label>
                               <div class="col-md-3">
                                <input type="text" class="form-control datepicker" name="end_on" placeholder="<?php echo $this->lang->line('labels')['select_end_date'];?>" id="end_on" autocomplete="off">
                                </div>
                            </div>
                       
                        <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['start_time'];?></label>
                <div class="col-sm-9">
                    <div class="col-md-4">
                        <select name="time_start" id= "starting_hour" class="form-control selectbox">
                            <option value=""><?php echo $this->lang->line('labels')['hours'];?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="time_start_min" id= "starting_minute" class="form-control selectbox">
                            <option value=""><?php echo $this->lang->line('labels')['minutes'];?></option>
                            <!-- <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?> -->
                            <option value="00">00</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="starting_ampm" class="form-control selectbox">
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
                        <select name="time_end" id= "ending_hour" class="form-control selectbox">
                            <option value=""><?php echo $this->lang->line('labels')['hours'];?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="time_end_min" id= "ending_minute" class="form-control selectbox">
                            <option value=""><?php echo $this->lang->line('labels')['minutes'];?></option>  
                            <!-- <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?> -->
                            <option value="00">00</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="ending_ampm" class="form-control selectbox">
                            <option value="am">am</option>
                            <option value="pm">pm</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">
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
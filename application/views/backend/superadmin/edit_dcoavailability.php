<?php 

$single_doctor_info = $this->db->get_where('availability_slat', array('id' => $slat_id))->result_array();

    foreach($single_doctor_info as $row){
        
        $day=date('D',strtotime($row['date']));
       // echo $row['date']->format("m/d/Y");
      $check=explode(',',$row['repeat_on']);
      $start_time=explode(':',$row['start_time']);
      $start_ampm=explode(' ',$start_time[1]);
      $end_time=explode(':',$row['end_time']);
      $end_ampm=explode(' ',$end_time[1]);
      
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">
  
            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>index.php?superadmin/edit_doctor_new_availability/update_availability/<?php echo $row['doctor_id'];?>/<?php echo $slat_id;?>" method="post" enctype="multipart/form-data">
                    <div class="form-group" id='SelectInterval'>
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('repeat_interval'); ?></label>

                        <div class="col-sm-8">
                            <input type="hidden" name="unik" value="<?=$row['unik']?>" id="">
                            <input type="hidden" name="doctor_id" value="<?=$row['doctor_id']?>" id="">
                            <input type="hidden" value="<?=$row['repeat_interval']?>" id="repeat_interval">
                            <select name="repeat_interval" class="form-control" data-validate="required" data-message-required="<?php echo 'Value_required';?>" value="" onchange="return show_repete(this.value)">
                                
                                <option value="0" <?php if($row['repeat_interval']=='0'){echo 'selected';}?>><?php echo get_phrase('weekly'); ?></option>
                                <option value="1" <?php if($row['repeat_interval']=='1'){echo 'selected';}?>><?php echo get_phrase('custom'); ?></option>
                            </select>
                        </div>   
                    </div>
                    <div class="form-group" id="weeklyDayDiv" style="display: block;">
                                    <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('repeat_on'); ?></label>
                                    <div class="col-sm-8">
                                        
                                    <label><input id="chk_0" class="repeat_on" type="checkbox" name="repeat_on[]" value="0" <?php for($i=0;$i<count($check);$i++){if($check[$i]=='0'){echo 'checked';}}?>>S</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_1" class="repeat_on" type="checkbox" name="repeat_on[]" value="1" <?php for($i=0;$i<count($check);$i++){if($check[$i]=='1'){echo 'checked';}}?>>M</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_2" class="repeat_on" type="checkbox" name="repeat_on[]" value="2" <?php for($i=0;$i<count($check);$i++){if($check[$i]=='2'){echo 'checked';}}?>>T</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_3" class="repeat_on" type="checkbox" name="repeat_on[]" value="3" <?php for($i=0;$i<count($check);$i++){if($check[$i]=='3'){echo 'checked';}}?>>W</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_4" class="repeat_on" type="checkbox" name="repeat_on[]" value="4" <?php for($i=0;$i<count($check);$i++){if($check[$i]=='4'){echo 'checked';}}?>>T</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_5" class="repeat_on" type="checkbox" name="repeat_on[]" value="5" <?php for($i=0;$i<count($check);$i++){if($check[$i]=='5'){echo 'checked';}}?>>F</label>&nbsp;&nbsp;&nbsp;
                                    <label><input id="chk_6" class="repeat_on" type="checkbox" name="repeat_on[]" value="6" <?php for($i=0;$i<count($check);$i++){if($check[$i]=='6'){echo 'checked';}}?>>S</label>&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <span id="weekerror"></span>
                    </div>
                    
                  
                            <div class="form-group" id="Dates">
                                <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('start_date'); ?></label>
                               <div class="col-md-3">
                                <input type="text" class="form-control datepicker" name="start_on" id="start_on" value="<?php echo $row['start_date']?>">
                                </div>
                                
                                <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('end_date'); ?></label>
                               <div class="col-md-3">
                                <input type="text" class="form-control datepicker" name="end_on" id="end_on" value="<?php echo $row['end_date']?>">
                                </div>
                            </div>
                       
                        <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo 'Starting_time';?></label>
                <div class="col-sm-9">
                    <div class="col-md-4">
                        <select name="time_start" id= "starting_hour" class="form-control selectboxit">
                            <option value=""><?php echo 'Hour';?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>" <?php if($start_time[0]==$i){echo 'selected';}?>><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="time_start_min" id= "starting_minute" class="form-control selectboxit">
                            <option value=""><?php echo 'Minutes';?></option>
                            <option value="00" <?php if($start_ampm[0]==00){echo 'selected';}?>>00</option>
                            <option value="30" <?php if($start_ampm[0]==30){echo 'selected';}?>>30</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="starting_ampm" class="form-control selectboxit">
                            <option value="am" <?php if($start_ampm[1]=='am'){echo 'selected';}?>>am</option>
                            <option value="pm" <?php if($start_ampm[1]=='pm'){echo 'selected';}?>>pm</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo 'Ending_time';?></label>
                <div class="col-sm-9">
                    <div class="col-md-4">
                        <select name="time_end" id= "ending_hour" class="form-control selectboxit">
                            <option value=""><?php echo 'Hour';?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>" <?php if($end_time[0]==$i){echo 'selected';}?>><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="time_end_min" id= "ending_minute" class="form-control selectboxit">
                            <option value=""><?php echo 'Minutes';?></option>  
                           <option value="00" <?php if($end_ampm[0]==00){echo 'selected';}?>>00</option>
                            <option value="30" <?php if($end_ampm[0]==30){echo 'selected';}?>>30</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="ending_ampm" class="form-control selectboxit">
                            <option value="am" <?php if($end_ampm[1]=='am'){echo 'selected';}?>>am</option>
                            <option value="pm" <?php if($end_ampm[1]=='pm'){echo 'selected';}?>>pm</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 checked"><input type="checkbox" name="existDays" id="existDays" value="yes" onchange="return upall()">Update/Delete all</label>
            </div>      

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                       
                    </div>
                    <div class="col-sm-3 control-label ">
                       
                        <button type="button" class="btn btn-danger" id="delete" onclick="confirm_modal('<?php echo base_url()?>index.php?superadmin/edit_doctor_new_availability/delete/<?php echo $row['doctor_id'];?>/<?php echo $row['id'];?>');" >Delete</button>
                        <button type="button" class="btn btn-danger" id="delete_all" onclick="confirm_modal('<?php echo base_url()?>index.php?superadmin/edit_doctor_new_availability/delete_all/<?php echo $row['doctor_id'];?>/<?php echo $row['id'];?>');" >Delete</button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>
<?php } ?>

<script type="text/javascript">
$(document).ready(function(){
    $("#SelectInterval").hide();
    $("#weeklyDayDiv").hide();
    $("#Dates").hide();
    $("#delete_all").hide();
    /*var id=$("#repeat_interval").val();
     if(id == 1){
        $("#weeklyDayDiv").hide();
        }
        if(id == 0){
        $("#weeklyDayDiv").show();
        }*/
});
function upall() {
    var checkBox = document.getElementById("existDays");
    
    if (checkBox.checked == true){
        $("#SelectInterval").show();
        $("#weeklyDayDiv").show();
        $("#Dates").show();
        $("#delete_all").show();
        $("#delete").hide();
    } else {
      $("#SelectInterval").hide();
    $("#weeklyDayDiv").hide();
    $("#Dates").hide();
    $("#delete_all").hide();
    $("#delete").show();
    }
}

    function show_repete(id) {
        if(id == 1){
        $("#weeklyDayDiv").hide();
        }
        if(id == 0){
        $("#weeklyDayDiv").show();
        }
    }


</script>
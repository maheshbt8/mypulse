<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <?php if($this->auth->isDoctor()){  ?>
    <input type="hidden" id="left_active_menu" value="60" />
    <input type="hidden" id="left_active_sub_menu" value="601" />
    <?php } else{
      echo '<input type="hidden" id="left_active_menu" value="4" />';  
    }?>
    <div id="main-wrapper">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <div class="">
                            <div class="custome_col8">
                                <h3 class="panel-title panel_heading_custome"><?php echo $this->lang->line('labels')['otherSettings'];?></h3>
                            </div>
                            <div class="custome_col4">
                                <div class="panel_button_top_right">
                                    <a class="btn btn-primary m-b-sm " id="editBtn" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['edit'];?></a>
                                    <a class="btn btn-default m-b-sm " id="cancelBtn" data-toggle="tooltip" style="display:none" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['cancel'];?></a>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="panel-body" id="profileBody">
                        <form action="<?php echo site_url(); ?>/doctors/othersetting" method="post" id="form1" enctype="multipart/form-data">
                            <input type="hidden" name="eidt_gf_id" value="<?php echo $doc_id;?>" />
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('labels')['noAppInterval'];?></label>
                                    <input style="width:50px" value="<?php echo $no_appt_handle;?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['noAppInterval'];?>" name="no_appt_handle" id="no_appt_handle" />
                                </div>
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('labels')['availabilityText'];?></label>
                                    <textarea class="form-control "  placeholder="<?php echo $this->lang->line('labels')['availabilityTextPlace'];?>" name="availability_text" id="availability_text"><?php if($availabilityText!=""){ echo $availabilityText; }?></textarea>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <div class="">
                            <div class="custome_col8">
                                <h3 class="panel-title panel_heading_custome"><?php echo $this->lang->line('availability');?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        //availabilty
                        <div class="table-responsive">
                            <table class="display table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:10px"></th>
                                        <th><?php echo $this->lang->line('tableHeaders')['type'];?></th>
                                        <th><?php echo $this->lang->line('tableHeaders')['st'];?></th>
                                        <th><?php echo $this->lang->line('tableHeaders')['date'];?></th>
                                        <th><?php echo $this->lang->line('tableHeaders')['remarks'];?></th>
                                        <th  width="20px">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>  
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body"> 
                    <div class="panel_button_top_right">
                        <a class="btn btn-success m-b-sm addbtn" style="margin-left:15px" data-toggle="tooltip" href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['addNew'];?></a>
                    </div>                            
                    <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form action="<?php echo site_url(); ?>/doctors/availability/<?php echo $doc_id;?>" method="post" id="form" enctype="multipart/form-data">
                <input type="hidden" name="eidt_gf_id" id="eidt_gf_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Edit-Heading"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['repeat_interval'];?></label>
                            <select class="form-control " name="repeat_interval" id="repeat_interval" >
                                <option value="0"><?php echo $this->lang->line('labels')['weekly'];?></option>
                                <option value="1"><?php echo $this->lang->line('labels')['monthly'];?></option>
                                <option value="2"><?php echo $this->lang->line('labels')['custom'];?></option>
                            </select>
                        </div>
                        <div class="form-group" id="weeklyDayDiv">
                            <label><?php echo $this->lang->line('labels')['repeat_on'];?></label><br>
                            <label><input id="chk_0" class='repeat_on' type="checkbox" name="repeat_on[]" value="0" />S</label>
                            <label><input id="chk_1" class='repeat_on' type="checkbox" name="repeat_on[]" value="1" />M</label>
                            <label><input id="chk_2" class='repeat_on' type="checkbox" name="repeat_on[]" value="2" />T</label>
                            <label><input id="chk_3" class='repeat_on' type="checkbox" name="repeat_on[]" value="3" />W</label>
                            <label><input id="chk_4" class='repeat_on' type="checkbox" name="repeat_on[]" value="4" />T</label>
                            <label><input id="chk_5" class='repeat_on' type="checkbox" name="repeat_on[]" value="5" />F</label>
                            <label><input id="chk_6" class='repeat_on' type="checkbox" name="repeat_on[]" value="6" />S</label>
                            <br>
                            <span id="weekerror" ></span>
                        </div>
                        <div class="form-group" id="monthDayDiv" style="display:none">
                            <label><?php echo $this->lang->line('labels')['repeat_on_monthly'];?></label>
                            <select class="form-control" name="day_of_month" id="day_of_month">
                                <?php
                                    for($i=1; $i<=31; $i++){
                                        echo "<option value='$i'>$i</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group" id="customDiv" style="display:none">
                            <label><?php echo $this->lang->line('labels')['select_date'];?></label>
                            <input type="text" class="form-control date-picker-nopast" name="date" id="date" />
                        </div><br>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['start_time'];?></label>
                            <input type="text" class="form-control timepicker" name="start_time" id="start_time" />
                        </div><br>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['end_time'];?></label>
                            <input type="text" class="form-control timepicker" name="end_time" id="end_time" />
                        </div><br>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['end_on'];?></label>
                            <input type="text" class="form-control date-picker-nopast" name="end_on" id="end_on" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <hr>
                        <div class="col-md-12 error">
                            <span class="model_error"></span>
                        </div>
                        <div class="" style="display:inline-flex">
                            <div class="form-group " style="margin-left:5px">
                                <button type="button" class="btn btn-default " data-dismiss="modal" style=""><span class="fa fa-remove" style="margin: 5px"></span><?php echo $this->lang->line('buttons')['cancel'];?></button>
                            </div>

                            <div class="form-group " style="margin-left:5px">
                                <button type="submit" class="btn btn-info " id="action-update-btn" style=""><span style="margin: 5px" class="fa fa-check"></span><?php echo $this->lang->line('buttons')['update'];?></button>
                            </div>
                            
                            <div class="form-group " style="display:none;margin-left:5px">
                                <button type="submit" class="btn btn-success " id="action-add-btn" style=""><span style="margin: 5px" class="fa fa-plus"></span><?php echo $this->lang->line('buttons')['add'];?></button>
                            </div>

                            <div class="form-group " style="display:none;margin-left:5px">
                                <button type="button" class="btn btn-danger " id="action-del-btn" style=""><span style="margin: 5px" class="fa fa-remove"></span><?php echo $this->lang->line('buttons')['delete'];?></button>
                            </div>
                        </div>
                    </div>
                </div>    
            </form>
        </div>
    </div>    
<?php
    $this->load->view('template/footer.php');
?>
<script>
    $(document).ready(function(){

        var validator = $("#form").validate({
            ignore: [],
            rules: {
                repeat_interval: {
                    required : true
                },
                start_time: {
                    required : true
                },
                end_time: {
                    required : true
                },
                'repeat_on[]':{
                    required : true
                },
                end_on:{
                    required: true
                }
            },
            messages: {
                repeat_interval:{
                    required: "<?php echo $this->lang->line('validation')['requiredRepeatInterval'];?>"
                },
                start_time:{
                    required: "<?php echo $this->lang->line('validation')['requiredStartTime'];?>"
                },
                start_time:{
                    required: "<?php echo $this->lang->line('validation')['requiredEndTime'];?>"
                },
                end_on:{
                    required: "<?php echo $this->lang->line('validation')['requiredEndDate'];?>"
                },
                'repeat_on[]':{
                    required: "<?php echo $this->lang->line('validation')['requiredReadOn'];?>"
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });

        $(".addbtn").click(function(){
            resetForm(validator);
            $("#eidt_gf_id").val(0);
            $("#Edit-Heading").html("<?php echo $this->lang->line('headings')['addNewAvailability'];?>");
            $("#action-update-btn").parent().hide();
            $("#action-add-btn").parent().show();
            $("#form")[0].reset();
            $("#form input").attr("disabled",false);
            $("#form").attr("action","<?php echo site_url(); ?>/doctors/availability/<?php echo $doc_id;?>");
            $("#edit").modal("show");
            $("#repeat_interval").trigger('change');
        });

        function editEvent(id){
            resetForm(validator);
            $("#eidt_gf_id").val(id);
            $("#Edit-Heading").html("<?php echo $this->lang->line('headings')['editAvailability'];?>");
            $("#action-update-btn").parent().show();
            $("#action-del-btn").parent().show();
            $("#action-add-btn").parent().hide();
            $("#form")[0].reset();
            $("#form input").attr("disabled",false);
            $("#form").attr("action","<?php echo site_url(); ?>/doctors/availability/<?php echo $doc_id;?>");
            $("#edit").modal("show");
            //$("#repeat_interval").trigger('change');
            loadData(id);
        }

        function loadData(id){
            $.get("<?php echo site_url(); ?>/doctors/getAvailabilityById",{ id: id },function(data){
			    var data = JSON.parse(data);
                $("#weeklyDayDiv").hide();
                $("#monthDayDiv").hide();
                $("#customDiv").hide();
                if(data.repeat_interval == 2){
                    $("#customDiv").show();
                    $("#date").val(data.start_date);
                    $('#date').datepicker("setDate", data.start_date );
                }else if(data.repeat_interval == 1){
                    $("#day_of_month").val(data.day);
                    $("#monthDayDiv").show();
                }else if(data.repeat_interval == 0){
                    //$(".repeat_on input[value="+data.day+"]").attr("checked",true);
                    $("#chk_"+data.day).prop('checked',true);
                    $("#chk_"+data.day).parent().addClass('checked');
                    $("#weeklyDayDiv").show();
                }
                $("#start_time").val(data.start_time);
                $("#end_time").val(data.end_time);
                $("#end_on").val(data.end_date);
                $('#end_on').datepicker("setDate", data.end_date );
                $("#repeat_interval").val(data.repeat_interval);
                $("#repeat_interval").trigger('change');
            });
        }

        $("#action-del-btn").click(function(){
            $("#edit").modal("hide");
            var id = $("#eidt_gf_id").val();
            swal(swalDeleteConfig).then(function () {
                $.post("<?php echo site_url(); ?>/doctors/deleteavalibality",{id:id},function(data){
                    if(data==1){
                        getCurrentCalData();
                        toastr.success("<?php echo $this->lang->line('headings')['deleteSuccess'];?>");
                    }else{
                        toastr.error("<?php echo $this->lang->line('headings')['tryAgain'];?>");
                    }
                });
            });
        });

        $("#repeat_interval").change(function(){
            var val = $("#repeat_interval").val();
            $("#weeklyDayDiv").hide();
            $("#monthDayDiv").hide();
            $("#customDiv").hide();
            if(val == 0){
                $("#weeklyDayDiv").show();
                $(".repeat_on").rules("add", {
                    required:true,
                    messages: {
                        required: "<?php echo $this->lang->line('validation')['requiredReadOn'];?>"
                    }
                });
                $("#date").rules("remove","required");
            }else if(val == 1){
                $("#monthDayDiv").show();
                $(".repeat_on").rules("remove","required");
                $("#date").rules("remove","required");
            }else if(val == 2){
                $("#customDiv").show();
                $("#date").rules("add", {
                    required:true,
                    messages: {
                        required: "<?php echo $this->lang->line('validation')['selectDate'];?>"
                    }
                });
                $(".repeat_on").rules("remove","required");
            }
        });

        var cal = $('#calendar').fullCalendar({
            editable: true,
	        droppable: true,
			eventLimit: true,
            viewRender: function(view, element){
                getCurrentCalData();
            },
            eventClick: function(calEvent, jsEvent, view) {
                editEvent(calEvent.int_id);
            }
		});

        function GetCalendarDateRange() {
            var calendar = $('#calendar').fullCalendar('getCalendar');
            var view = calendar.view;
            var start = moment(view.start._d).format("YYYY-MM-DD");
            var end = moment(view.end._d).format("YYYY-MM-DD");
            var dates = { start: start, end: end };
            return dates;
        }

        function getCurrentCalData(){
            var dts = GetCalendarDateRange();
            $.post( "<?php echo site_url();?>/doctors/getAvailability/<?php echo $doc_id;?>",dts, function( data ) {
                data = JSON.parse(data);
                $('#calendar').fullCalendar('removeEvents');
                for(var i=0; i<data.length; i++){
                    var _item = data[i];
                    var sdate = new Date(_item.startDate * 1000);
					var edate = new Date(_item.endDate * 1000);
                    var event = {
                        id: i,
                        title: _item.title,
                        start: sdate,
                        end: edate,
                        color: '#4285F4',
                        int_id: _item.interval_id
                    };
                    $('#calendar').fullCalendar( 'renderEvent', event, true);
                }
                $('#calendar').fullCalendar( 'refetchEvents' );
                
            });
        }

        $("#editBtn").click(function(){
            toggleEditButton();
        });

        $("#cancelBtn").click(function(){
            isEdit = false;
             var eb = $("#editBtn");
            $("#cancelBtn").hide();
            disableFields();
            $(eb).data('isEdit','0');
            $(eb).addClass('btn-primary');
            $(eb).removeClass('btn-success');
            $(eb).html('Edit');
            disableFields();
        });

        function toggleEditButton(){
            var eb = $("#editBtn");
            if($(eb).data('isEdit') == "1"){
                isEdit = false;
                saveData();
                $("#cancelBtn").hide();
            }else{
                isEdit = true;
                $(eb).data('isEdit','1');
                $(eb).removeClass('btn-primary');
                $(eb).addClass('btn-success');
                $(eb).html('Save');
                enableFields();
                $("#cancelBtn").show();
            }
        }

        function disableFields(){
            $("#profileBody input").prop("disabled", true);
            $("#profileBody textarea").prop("disabled", true);
            $("#profileBody select").prop("disabled", true);

        }

        function enableFields(){
            $("#profileBody input").prop("disabled", false);
            $("#profileBody textarea").prop("disabled", false);
            $("#profileBody select").prop("disabled", false);

        
        }

        disableFields();

        function saveData(){
            $("#form1").submit();
        }

    });
</script>
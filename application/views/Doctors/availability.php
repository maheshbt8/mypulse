<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="60" />
    <input type="hidden" id="left_active_sub_menu" value="601" />
    <div id="main-wrapper">
        <div class="col-md-12">
            <div class="panel_button_top_right">
				<a class="btn btn-success m-b-sm addbtn" style="margin-left:15px" data-toggle="tooltip" href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['addNew'];?></a>
            </div>                            
            <div id="calendar"></div>
        </div>
        
    </div>

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form action="<?php echo site_url(); ?>/doctors/availability" method="post" id="form" enctype="multipart/form-data">
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
                                <!--<option value="2"><?php echo $this->lang->line('labels')['yearly'];?></option>-->
                            </select>
                        </div>
                        <div class="form-group" id="weeklyDayDiv">
                            <label><?php echo $this->lang->line('labels')['repeat_on'];?></label><br>
                            <label><input class='repeat_on' type="checkbox" name="repeat_on[]" value="0" />S</label>
                            <label><input class='repeat_on' type="checkbox" name="repeat_on[]" value="1" />M</label>
                            <label><input class='repeat_on' type="checkbox" name="repeat_on[]" value="2" />T</label>
                            <label><input class='repeat_on' type="checkbox" name="repeat_on[]" value="3" />W</label>
                            <label><input class='repeat_on' type="checkbox" name="repeat_on[]" value="4" />T</label>
                            <label><input class='repeat_on' type="checkbox" name="repeat_on[]" value="5" />F</label>
                            <label><input class='repeat_on' type="checkbox" name="repeat_on[]" value="6" />S</label>
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
                        </div><br>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['start_time'];?></label>
                            <input type="text" class="form-control timepicker" name="start_time" id="start_time" />
                        </div><br>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['end_time'];?></label>
                            <input type="text" class="form-control timepicker" name="end_time" id="end_time" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <hr>
                        <div class="col-md-12 error">
                            <span class="model_error"></span>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="width: 100%;"><span class="fa fa-remove" style="margin: 5px"></span><?php echo $this->lang->line('buttons')['cancel'];?></button>
                            </div>

                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-info btn-lg" id="action-update-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-check"></span><?php echo $this->lang->line('buttons')['update'];?></button>
                            </div>
                            
                            <div class="form-group col-md-6" style="display:none">
                                <button type="submit" class="btn btn-success btn-lg" id="action-add-btn" style="width: 100%;"><span style="margin: 5px" class="fa fa-plus"></span><?php echo $this->lang->line('buttons')['add'];?></button>
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
                'repeat_on[]':{
                    required: "<?php echo $this->lang->line('validation')['requiredReadOn'];?>"
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });

        $(".addbtn").click(function(){
            resetForm(validator);
            $("#Edit-Heading").html("<?php echo $this->lang->line('headings')['addNewAvailability'];?>");
            $("#action-update-btn").parent().hide();
            $("#action-add-btn").parent().show();
            $("#form")[0].reset();
            $("#passwordhint").hide();
            $("#form input").attr("disabled",false);
            $("#form").attr("action","<?php echo site_url(); ?>/doctors/availability");
            $("#edit").modal("show");
            $("#repeat_interval").trigger('change');
        });

        $("#repeat_interval").change(function(){
            var val = $("#repeat_interval").val();
            $("#weeklyDayDiv").hide();
            $("#monthDayDiv").hide();
            if(val == 0){
                $("#weeklyDayDiv").show();

                $(".repeat_on").rules("add", {
                    required:true,
                    messages: {
                        required: "<?php echo $this->lang->line('validation')['requiredReadOn'];?>"
                    }
                });
            }else if(val == 1){
                $("#monthDayDiv").show();
                $(".repeat_on").rules("remove","required");
            }
        });

        var cal = $('#calendar').fullCalendar({
            editable: true,
	        droppable: true,
			eventLimit: true,
            viewRender: function(view, element){
                getCurrentCalData();
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
            $.post( "<?php echo site_url();?>/doctors/getAvailability",dts, function( data ) {
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
                        color: '#4285F4'
                    };
                    $('#calendar').fullCalendar( 'renderEvent', event, true);
                }
                $('#calendar').fullCalendar( 'refetchEvents' );
                
            });
        }
    });
</script>
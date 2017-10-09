<?php
$this->load->view('template/header.php');
$this->load->view('template/left.php');
?>
<div id="main-wrapper">
    <div class="row">
        <div class="card">
            <div class="card-head">
			    <header>Messages</header>
                <div class="custome_card_header">
                    
                </div>
            </div>


        <div class="col-md-12" id="AllMsgDiv" style="<?php if(isset($message)){ echo "display:none";}?>">
            <div class="mailbox-content">
                <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="msg_tbl">
                    <thead>
                    <tr colspan="4">
                        <th>#</th>
                        <th>From</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12" id="NewMsgDiv" style="display:none">
            <form method="post" id="MsgForm" action="<?php echo site_url();?>/index/sendmsg" >
            <div class="mailbox-content">
                <div class="compose-body">

                        <div class="form-group">
                            <label for="to" class="col-sm-2 control-label">To</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="to" id="select-to">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2">&nbsp;</label>
                            <div class="col-sm-10" style="margin-top:10px">
                                <?php if(!$this->auth->isDoctor()){ ?>
                                <a class="btn btn-primary btn-circle" id="all_hos">All Hospital Admins</a>
                                <a class="btn btn-primary btn-circle" id="all_medlb">All Madical Labs</a>
                                <a class="btn btn-warning btn-circle" id="all_medst">All Medical Stores</a>
                                <?php }  ?>
                                <a class="btn btn-warning btn-circle" id="all_nur">All Nurses</a>
                                <a class="btn btn-danger btn-circle" id="all_rep">All Receptionists</a>
                                <a class="btn btn-info btn-circle" id="all_doc">All Doctors</a>
                                <a class="btn btn-success btn-circle" id="all_pat">All Patients</a>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                        </div>

                </div>
                <label for="subject" class="col-sm-2 control-label">Message</label>
                <div class="col-md-12" >
                    <textarea id="message" name="message" class="summernote" rows="30"></textarea>
                </div><br>
                <div class="compose-options col-md-12" style="margin-top: 10px">
                    <div class="pull-right">
                        <button type="button" id="cancelNewMsg" class="showAllMsg btn btn-default"><i class="fa fa-remove m-r-xs"></i>Cancel</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-send m-r-xs"></i>Send</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="col-md-12" id="ReadMsgDiv" style="<?php if(!isset($message)){ echo "display:none";}?>">
            <form >
                <div class="mailbox-content">
                    <div class="compose-body">

                        <div class="form-group">
                            <label for="to" class="col-sm-2 control-label">From</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="read_select-to" value="<?php if(isset($message)){ echo $message['fromname'];}?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="read_title" value="<?php if(isset($message)){ echo $message['title'];}?>">
                            </div>
                        </div>

                    </div>
                    <label for="subject" class="col-sm-2 control-label">Message</label>
                    <div class="col-md-12" >
                        <textarea id="read_message"  class="summernote" rows="30"><?php if(isset($message)){ echo $message['body'];}?></textarea>
                    </div><br>
                    <div class="compose-options col-md-12" style="margin-top: 13px">
                        <div class="pull-right">
                            <button type="button" id="backMsg" class="showAllMsg btn btn-default"><i class="fa fa-arrow-left m-r-xs"></i>Back</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php
$this->load->view('template/footer.php');
?>
<script type="text/javascript">
    $(document).ready(function(){

        var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
            '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';

        var selectTo = $('#select-to').selectize({
            persist: false,
            maxItems: null,
            valueField: 'id',
            labelField: 'name',
            searchField: ['name', 'email'],
            render: {
                item: function(item, escape) {
                    return '<div>' +
                        (item.name ? '<span class="name">' + escape(item.name) + '</span>' : '') +
                        '</div>';
                },
                option: function(item, escape) {
                    var label = item.name || item.email;
                    var caption = item.name ? item.email : null;
                    return '<div >' +
                        '<span>' + escape(label) + '</span><br>' +
                        (caption ? '<span class="caption">' + escape(caption) + '</span>' : '') +
                        '</div>';
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: '<?php echo site_url();?>/users/searchmail?q=' + encodeURIComponent(query),
                    type: 'GET',
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback($.parseJSON(res));
                    }
                });
            }
        });

        $('.summernote').summernote({
            height: 350
        });

        $(document).on('click','.msg_row',function(){
            var id = $(this).data('id');
            var span = $(this);
            $.post("<?php echo site_url();?>/index/readmsg",{mid:id},function (d) {
                var msg = $.parseJSON(d);
                $("#msg_count").html(msg.count);
                $(span).removeClass('bold');
                $("#read_select-to").val(msg.message.fromname);
                //$("#read_message").val(msg.message.body);
                $("#read_title").val(msg.message.title);
                $("#read_message").code(msg.message.body);
                //$('#read_message').summernote('disable');
                $('.note-editable').attr('contenteditable', false);
                $('.note-toolbar').hide();
                $("#ReadMsgDiv").show();
                $("#AllMsgDiv").hide();
            });
        });

        function checkisRead() {
            var isRead = '<?php if(isset($message)){ echo 1;}else{ echo 0;}?>';
            if(isRead==1){
                $('.note-editable').attr('contenteditable', false);
                $('.note-toolbar').hide();
            }
        }
        checkisRead();

        $("#msg_tbl").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo site_url(); ?>/index/getDTMessages"
        });
        $(".dataTables_filter").attr("style","display: flex;float: right");
        $("#msg_tbl_filter label").hide();
        <?php if($this->auth->isSuperAdmin() || $this->auth->isHospitalAdmin() || $this->auth->isDoctor()) { ?>
        $(".dataTables_filter").append("<a class=\"btn btn-success m-b-sm addbtn\" data-toggle=\"tooltip\" title=\"Add\"  href=\"javascript:void(0);\"  style=\"margin-left:10px\">New Message</a>");
        <?php } ?>

        $(document).on('click','.addbtn',function(){
            $('.note-editable').attr('contenteditable', true);
            $('.note-toolbar').show();
            $("#NewMsgDiv").show();
            $("#AllMsgDiv").hide();
        });

        $(".showAllMsg").click(function(){
            $("#NewMsgDiv").hide();
            $("#ReadMsgDiv").hide();
            $("#AllMsgDiv").show();
        });

        var validator = $("#MsgForm").validate({
            ignore: [],
            rules: {
                to: {
                    required : true
                },
                title: {
                    required: true
                },
                message:{
                    required: true
                }
            },
            messages: {
                to:{
                    required: "<?php echo $this->lang->line('validation')['requiredMsgTo'];?>"
                },
                title:{
                    required: "<?php echo $this->lang->line('validation')['requiredMsgTitle'];?>"
                },
                message:{
                    required: "<?php echo $this->lang->line('validation')['requiredMsg'];?>"
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement

        });

        $("#MsgForm").on('submit',function(e){
            e.preventDefault();
            if(validator.validate()){
                console.log("YES");
            }else{
                console.log("NO");
            }
        });

        $("#all_hos").click(function(){ setMultiUserSet(-1); });
        $("#all_nur").click(function(){ setMultiUserSet(-2); });
        $("#all_rep").click(function(){ setMultiUserSet(-3); });
        $("#all_doc").click(function(){ setMultiUserSet(-4); });
        $("#all_medlb").click(function(){ setMultiUserSet(-5); });
        $("#all_medst").click(function(){ setMultiUserSet(-6); });
        $("#all_pat").click(function(){ setMultiUserSet(-7); });

        function setMultiUserSet(type){
            var tempSelectTo = selectTo[0].selectize;
            var selectedItems = tempSelectTo.getValue();
            var options = [];
            if(!Array.isArray(selectedItems))
                selectedItems = [];

            selectedItems.push(type);
            for(var i=0; i<selectedItems.length; i++){
                var name = "";
                var t = selectedItems[i];
                switch(t){
                    case -1: name = "All Hospital admins"; break;
                    case -2: name = "All Nurses"; break;
                    case -3: name = "All Receptionists"; break;
                    case -4: name = "All Doctors"; break;
                    case -5: name = "All Medical Labs"; break;
                    case -6: name = "All Medical Stores"; break;
                    case -7: name = "All Patients"; break;
                }
                if(name!=""){
                    options.push({"id":t,"name":name});
                }

            }
             
            
             tempSelectTo.addOption(options);
            for(var i=0; i<selectedItems.length; i++){
                var _t = selectedItems[i];
                tempSelectTo.setValue(_t);
            } 

            if (selectedItems.indexOf(-3) > -1) {
                tempSelectTo.addItem(-3,true);
                console.log("HI");
            }

        }


    });
</script>
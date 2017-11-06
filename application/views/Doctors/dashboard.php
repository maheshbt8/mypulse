<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div id="main-wrapper">
    <div class="row">
            <div class="state-overview">
                <div class="col-lg-3 col-sm-6">
                    <a href="<?php echo site_url();?>/doctors/nurse">
                    <div class="overview-panel purple">
                        <div class="symbol">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_nus'];?>"><?php echo $states['tot_nus'];?></p>
                            <p><?php echo $this->lang->line('nurses');?></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="<?php echo site_url();?>/doctors/receptionist">
                    <div class="overview-panel green-bgcolor">
                        <div class="symbol">
                            <i class="fa fa-user-md"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_rec'];?>"><?php echo $states['tot_rec'];?></p>
                            <p><?php echo $this->lang->line('receptionists');?></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="<?php echo site_url();?>/doctors/patient">
                    <div class="overview-panel orange">
                        <div class="symbol">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_pat'];?>"><?php echo $states['tot_pat'];?></p>
                            <p><?php echo $this->lang->line('patients');?></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="<?php echo site_url();?>/appoitments">
                    <div class="overview-panel blue-bgcolor">
                        <div class="symbol">
                            <i class="icon-envelope"></i>
                        </div>
                        <div class="value white">
                            <p class="sbold addr-font-h1" data-counter="counterup" data-value="<?php echo $states['tot_app'];?>"><?php echo $states['tot_app'];?></p>
                            <p><?php echo $this->lang->line('appointments');?></p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">      
                <div class="card-head">
                    <header><?php echo $this->lang->line('todaysappoitments');?></header>
                    <div class="custome_card_header">
						<a class="btn btn-primary" id="menualrefresh"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>
                    
                <div class="card-body">
                    <table id="appoitments" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                        <thead>
                            <tr>
                                <th style="width:10px"></th>
                                <th><?php echo $this->lang->line('tableHeaders')['appoitment_no'];?></th>
                                <th><?php echo $this->lang->line('tableHeaders')['patient'];?></th>
                                <th><?php echo $this->lang->line('tableHeaders')['reason'];?></th>
                                <th><?php echo $this->lang->line('tableHeaders')['appoitment_date'];?></th>
                                <th><?php echo $this->lang->line('tableHeaders')['appoitment_sloat'];?></th>
                                <th><?php echo $this->lang->line('tableHeaders')['status']; ?></th>
                                <th width="20px">#</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        </tbody>
                    </table>  
                </div>
            </div>
            
           
        </div>
    </div><!-- Main Wrapper -->
<?php
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>
<script>
    $(document).ready(function(){
        //$("#appoitments").dataTable().fnDestroy();
        function loadTable(){
            $("#appoitments").dataTable().fnDestroy();
            $("#appoitments").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "<?php echo site_url(); ?>/appoitments/getDTDocpappoitments?td=1"
            });
            $(".dataTables_filter").hide();
        }

        setInterval(function() {
            loadTable();
        }, 60000);
		
		$("#menualrefresh").click(function(){
			loadTable();
		});
		
        loadTable();

        $(document).on('click','.apprbtn',function(){
            var id = $(this).attr("data-id");
            var curdel = $(this);
            var s = swalDeleteConfig;
            var msg = $(this).data('msg');
            if(msg!=undefined)
                s.text = msg;
            swal(s).then(function () {
                $.post("<?php echo site_url(); ?>/appoitments/approve",{id:id},function(data){
                    if(data==1){
                        $($("#apprlink_"+id).parents('td').siblings()[6]).html('<span class="label label-primary"><?php echo $this->lang->line("labels")["approved"]?></span>');
                        //$("#dellink_"+id).parents('tr').remove();
                        toastr.success("<?php echo $this->lang->line('headings')['approvedSuccess'];?>");
                    }else{
                        toastr.error("<?php echo $this->lang->line('headings')['tryAgain'];?>");
                    }
                });
            });
        });

        $(document).on("click",".delbtn",function(){
            var id = $(this).attr("data-id");
            var curdel = $(this);
            var s = swalDeleteConfig;
            var msg = $(this).data('msg');
            if(msg!=undefined)
                s.text = msg;
            swal(s).then(function () {
                $.post("<?php echo site_url(); ?>/appoitments/reject",{id:id},function(data){
                    if(data==1){
                        $($("#dellink_"+id).parents('td').siblings()[6]).html('<span class="label label-danger"><?php echo $this->lang->line("labels")["rejected"]?></span>');
                        toastr.success("<?php echo $this->lang->line('headings')['rejectSuccess'];?>");
                    }else{
                        toastr.error("<?php echo $this->lang->line('headings')['tryAgain'];?>");
                    }
                });
            });
        });

        $(document).on('click','.multiApprBtn',function(){
            var at = $(this).data('at');
            var selected = [];
            $('.multiselect').each(function() {
                if ($(this).is(":checked")) {
                    selected.push($(this).data('id'));
                }
            });
            if(selected.length == 0){
                swal({
                    animation: "slide-from-top",
                    text: 'Please select checkbox.'
                });
            }else{
                var txt = "<?=$this->lang->line('headings')['deleteMessage']?>";
                var msg = $(this).data('msg');
                if(msg!=undefined)
                    txt = msg;
                swal({
                    title: '<?=$this->lang->line('headings')['areYouSure']?>',
                    text: txt,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function () {
                    $.post(BASEURL+"/"+at+"/approve",{ id : selected },function(data){
                        if(data==1){
                            for(var i=0; i<selected.length; i++){
                                var temp = selected[i];
                                $($("#apprlink_"+id).parents('td').siblings()[6]).html('<span class="label label-primary"><?php echo $this->lang->line("labels")["approved"]?></span>');
                            }
                            toastr.success("<?php echo $this->lang->line('headings')['approvedSuccess'];?>");
                        }else{
                            toastr.error('Please try again.');
                        }
                    });
                });

            }
        });

        $(document).on('click','.multiCancelBtn',function(){
            var at = $(this).data('at');
            var selected = [];
            $('.multiselect').each(function() {
                if ($(this).is(":checked")) {
                    selected.push($(this).data('id'));
                }
            });
            if(selected.length == 0){
                swal({
                    animation: "slide-from-top",
                    text: 'Please select checkbox.'
                });
            }else{
                var txt = "<?=$this->lang->line('headings')['deleteMessage']?>";
                var msg = $(this).data('msg');
                if(msg!=undefined)
                    txt = msg;
                swal({
                    title: '<?=$this->lang->line('headings')['areYouSure']?>',
                    text: txt,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function () {
                    $.post(BASEURL+"/"+at+"/reject",{ id : selected },function(data){
                        if(data==1){
                            for(var i=0; i<selected.length; i++){
                                var temp = selected[i];
                                $($("#dellink_"+temp).parents('td').siblings()[6]).html('<span class="label label-danger"><?php echo $this->lang->line("labels")["rejected"]?></span>');
                            }
                            toastr.success('selected item(s) cancled.');
                        }else{
                            toastr.error('Please try again.');
                        }
                    });
                });

            }
        });

    });
</script>
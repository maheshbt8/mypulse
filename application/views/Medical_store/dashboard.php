<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div id="main-wrapper">
        <div class="row">
        <!--
            <div class="col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter"><?php echo $states['tot_rep'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('reports');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-hospital-o"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p><span class="counter"><?php echo $states['tot_users'];?></span></p>
                            <span class="info-box-title"><?php echo $this->lang->line('customers');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p><span class="counter"><?php //echo $states['tot_medLab'];?></span></p>
                            <span class="info-box-title"><?php //echo $this->lang->line('medicalLabFull');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter"><?php //echo $states['tot_app'];?></p>
                            <span class="info-box-title"><?php //echo $this->lang->line('appointments');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="icon-envelope"></i>
                        </div>
                    </div>
                </div>
            </div>-->
        </div><!-- Row -->
        <!--OutStanding Med Reports -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card ">
                    
                    <div class="card-head">
                        <header><?php echo $this->lang->line('labels')['medicalStoreOutStanding'];?></header>
                        <div class="custome_card_header">
                            
                        </div>
                    </div>


                    <div class="card-body">
                        <div class=" project-stats">  
                           <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Doctor</th>
                                       <th>Patient</th>
                                       <th>Contact Number</th>
                                       <th>Address</th>
                                       <th>Status</th>
                                       <th>Prescription</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $cnt = 1;
                                        foreach($states['orders'] as $pre){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$cnt;?></th>
                                                <td><?=$pre['doctor_name'];?></td>
                                                <td><?=$pre['patient_name'];?></td>
                                                <td><?=$pre['contact_number'];?></td>
                                                <td><?=$pre['address'];?></td>
                                                <td><span class="label label-info">Pending</span></td>
                                                <td><a href='#' data-url='medical_store/previewprescription/<?=$pre['id'];?>' data-id='<?=$pre['id'];?>' class='previewtem'><i class="fa fa-file"></i></a></td>
                                                <td><button data-id="<?=$pre['id'];?>" data-toggle="modal" data-target="#uploadMR" class="btn btn-primary btnup">Upload Receipt</button></td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                        }

                                        if(count($states['orders'])==0){
                                            echo "<tr><td colspan='8' align='center'>".$this->lang->line('msg_no_outstanding_orders')."</td></tr>";
                                        }
                                    ?>
                                   
                                   
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Main Wrapper -->

    <div class="modal fade" id="uploadMR" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog modal-m">
		    <form action="<?php echo site_url(); ?>/medical_store/uploadreceipt" method="post" id="form" enctype="multipart/form-data">
			    
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Edit-Heading">Upload Receipt</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="drop-area" id="dparea">
                                <h4 class="drop-text">Drag and Drop Receipt Here</h4>        
                            </div>
                            <div style="z-index:1000; position:fixed;top:0;bottom:0;left:0;right:0;display:none" id="loading-img">
                                <img style="margin: 0 auto;display: flow-root;background: white;margin-top: 15%;padding: 20px;" src="<?php echo base_url();?>public/images/loading.gif"  />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-defualt" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
    $this->load->view('template/footer.php');
?>
<script type="text/javascript">
    $( document ).ready(function() {
        var current_id = null;
        $(".btnup").click(function(){
            current_id = $(this).data('id');
            var url = '<?php echo site_url();?>/medical_store/getreceiptpreview/'+current_id;
            $("#loading-img").show();
            $.get(url,function(data){ 
                showImages(data);
            });
        });

    
        $(".drop-area").on('dragenter', function (e){
            e.preventDefault();
            $(this).css('background', '#BBD5B8');
        });

        $(".drop-area").on('dragleave',function(e){
            e.preventDefault();
            $(this).css('background', '#fff');
        });

        $(".drop-area").on('dragover', function (e){
            e.preventDefault();
        });

        $(".drop-area").on('drop', function (e){
            $(this).css('background', '#fff');
            e.preventDefault();
            var image = e.originalEvent.dataTransfer.files;
            createFormData(image,current_id);
        });

        function createFormData(image,id)
        {
            var formImage = new FormData();
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
            var canUpload = true;
            for(var i=0; i<image.length; i++){
                if ($.inArray(image[i].name.split('.').pop().toLowerCase(), fileExtension) == -1) {
                    canUpload = false;
                }
            }
            if(canUpload){
                $("#loading-img").show();
                for(var i=0; i<image.length; i++){
                    formImage.append('files[]', image[i]);
                }
                formImage.append('id',id);
                uploadFormData(formImage,id);
            }else{
                swal({
                    title: 'Invalid file type',
                    text: "Only formats are allowed : "+fileExtension.join(', '),
                    type: 'warning',
                    showCancelButton: true,
                    showConfirmButton: false,
                    cancelButtonColor: '#d33',
                })
            }
        }

        $(document).on('click','.rmvImg',function(){
            var id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "You want to delete this receipt",
                type: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonColor: '#d33',
            }).then(function(){
                console.log(id);
                $.post('<?php echo site_url();?>/medical_store/removereceiptfile',{id: id},function(data){
                    $("#imgdiv_"+id).remove();
                    if($("#dparea").children().length == 0){
                        $("#dparea").html('<h4 class="drop-text">Drag and Drop Receipt Here</h4>');
                    }
                });
            });
        });

        function uploadFormData(formData,id) 
        {
            $.ajax({
                url: "<?php echo site_url().'/medical_store/uploadreceipt';?>",
                type: "POST",
                data: formData,
                contentType:false,
                cache: false,
                processData: false,
                success: function(data){
                    showImages(data);
                }
            });
        }

        function showImages(data){
            data = $.parseJSON(data);
            $("#loading-img").hide();
            $("#dparea").html('<h4 class="drop-text">Drag and Drop Receipt Here</h4>');
            var imgList= "<div style='display:flex'>";
            if(data.length == 0)
                return;

            $.each(data, function () {
                imgList += '<div id="imgdiv_'+this.id+'" style="margin:0 auto"><img src= "' + this.url + '" /><div style="text-align:center"><a style="font-size:20px" href="javascript:void(0)" onclick="window.open(\''+this.url+'\');return false;"><i class="fa fa-download"></i></a> <a href="javascript:void(0)" data-id="'+this.id+'" style="font-size:20px;color:red;margin-left:5px" class="rmvImg"><i class="fa fa-remove"></i></a></div></div>';
            });
            imgList += "</div>";
            $("#dparea").html(imgList);
        }
    });
</script>
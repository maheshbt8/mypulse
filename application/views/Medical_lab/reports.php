<?php
/**
 * @author Ramesh Patel
 * @email  ramesh@techcrista.in
 */
$this->load->view("template/header.php");
$this->load->view("template/left.php");
?>
	<input type="hidden" id="left_active_menu" value="81" />
	<div id="main-wrapper">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="card ">
                    <div class="card-head">
                        <header><?php echo $this->lang->line('testreports');?></header>
                        <div class="custome_card_header">
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <table id="reports" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Doctor</th>
                                        <th>Patient</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
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
		    <form action="<?php echo site_url(); ?>/medical_lab/uploadreport" method="post" id="form" enctype="multipart/form-data">
			    <input type="hidden" name="mrid" id="mrid">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Edit-Heading">Upload Report</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="drop-area" id="dparea">
                                <h4 class="drop-text">Drag and Drop Test-Report Here</h4>        
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
    $this->load->view("template/footer.php");
?>
<script type="text/javascript">
    
    $(document).ready(function(){
		
		var status = "";
		
		<?php 
			if(isset($_GET['s'])){
		?>
			status = '<?php echo intval($_GET['s']); ?>';
		<?php
			}
		?>

        $("#reports").dataTable().fnDestroy();

        var dt = $("#reports").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo site_url(); ?>/medical_lab/getDTreports?s="+status
        });

        $(".dataTables_filter").attr("style","display: flex;float: right");

        var current_id = null;
        $(document).on('click','.btnup',function(){
            current_id = $(this).data('id');
            var url = '<?php echo site_url();?>/medical_lab/getreportspreview/'+current_id;
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
                text: "You want to delete this report",
                type: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonColor: '#d33',
            }).then(function(){
                console.log(id);
                $.post('<?php echo site_url();?>/medical_lab/removereportfile',{id: id},function(data){
                    $("#imgdiv_"+id).remove();
                    if(dt != undefined)
                        dt.ajax.reload();
                    if($("#dparea").children().length == 0){
                        $("#dparea").html('<h4 class="drop-text">Drag and Drop Test-Report Here</h4>');
                    }
                });
            });
        });

        function uploadFormData(formData,id) 
        {
            $.ajax({
                url: "<?php echo site_url().'/medical_lab/uploadreport';?>",
                type: "POST",
                data: formData,
                contentType:false,
                cache: false,
                processData: false,
                success: function(data){
                    if(dt != undefined)
                        dt.ajax.reload();
                    showImages(data);
                }
            });
        }

        function showImages(data){
            data = $.parseJSON(data);
            $("#loading-img").hide();
            $("#dparea").html('<h4 class="drop-text">Drag and Drop Test-Report Here</h4>');
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
<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
            <form id="form" action="<?php echo site_url();?>/index/changepassword" method="post">
                <div class="form-group">
                    <label><?php echo $this->lang->line('labels')['oldPassword'];?></label>
                    <input class="form-control " type="password" placeholder="<?php echo $this->lang->line('labels')['oldPassword'];?>" name="oldpassword" id="oldpassword" required/>
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('labels')['newPassword'];?></label>
                    <input class="form-control " type="password" placeholder="<?php echo $this->lang->line('labels')['newPassword'];?>" name="password" required/>
                </div>
                <div class="form-group">
                    <label><?php echo $this->lang->line('labels')['reNewPassword'];?></label>
                    <input class="form-control " type="password" placeholder="<?php echo $this->lang->line('labels')['reNewPassword'];?>" name="repassword" required/>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>    
            </div>
        </div>
    </div>
<?php
    $this->load->view('template/footer.php');
?>

<script type="text/javascript">
		
    $(document).ready(function(){

        var validator = $("#form").validate({
            ignore: [],
            rules: {
                oldpassword:{
                    required:true
                },
                password:{
                    required : true
                },
                repassword:{
                    required : true
                }
                
            },
            messages: {
                oldpassword:{
                    required:"<?php echo $this->lang->line('validation')['requriedOldPass'];?>"
                },
                password:{
                    required : "<?php echo $this->lang->line('validation')['requiredNewPassword'];?>"
                },
                repassword:{
                    required : "<?php echo $this->lang->line('validation')['requiredNewReapeatPassword'];?>"
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });
    });
    <script type="text/javascript">
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" style="height:25px;" /></div>');
		
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);
			}
		});
	}
	</script>
    
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog" >
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $system_name;?></h4>
                </div>
                
                <div class="modal-body" style="height:500px; overflow:auto;">   
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
	function confirm_modal(delete_url)
	{
		jQuery('#modal-4').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
	}
   
	</script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link"><?php echo 'Delete';?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo 'Cancel';?></button>
                </div>
            </div>
        </div>
    </div>
   <script>
       function confSubmit(form) {
        jQuery('#alldelete').modal('show', {backdrop: 'static'});
        $( "#delete_link_all" ).click(function() {
            form.submit();
        });
}
   </script>
   <div class="modal fade" id="alldelete">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <button class="btn btn-danger" id="delete_link_all" onClick="confSubmit();"><?php echo 'Delete';?></button>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo 'Cancel';?></button>
                </div>
            </div>
        </div>
</div>
<script>
 function checkone() {
        jQuery('#check_all').modal('show', {backdrop: 'static'});
}
   </script>
   <div class="modal fade" id="check_all">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Please select checkbox.</h4>
                </div>
                <div class="modal-footer" style="margin:-9px; border-top:0px; text-align:center;">
                    <button type="button" class="btn btn-info btn-lg" data-dismiss="modal"><?php echo 'Ok';?></button>
                </div>
            </div>
        </div>
</div>
 <script>
       function confclose(form) {
        jQuery('#close_all').modal('show', {backdrop: 'static'});
        $( "#close_link_all" ).click(function() {
            /*form.submit();*/
            $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>main/appointment/close_multiple/',
            data: $('form').serialize(),
            success: function (response) {
                window.location.reload();
            }
          });
        });
}
   </script>
   <div class="modal fade" id="close_all">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to Close this Appointments ?</h4>
                </div>
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <button class="btn btn-warning" id="close_link_all" onClick="confSubmit();"><?php echo 'Close';?></button>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo 'Cancel';?></button>
                </div>
            </div>
        </div>
</div>
<script>
       function confclose(form) {
        jQuery('#close_all').modal('show', {backdrop: 'static'});
        $( "#close_link_all" ).click(function() {
            /*form.submit();*/
            $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>main/appointment/close_multiple/',
            data: $('form').serialize(),
            /*success: function (response) {
                alert(response);
              alert('form was submitted');
            }*/
          });
        });
}
   </script>
   <script type="text/javascript">
    $(document).ready(function(){
        var start = moment().subtract(29, 'days');
        var end = moment();
        <?php
        if(isset($_GET['sd']) && $_GET['sd'] != ""){
            ?>
            start = moment('<?php echo $_GET['sd'];?>');
            <?php
        }
        ?>

        <?php
        if(isset($_GET['ed']) && $_GET['ed'] != ""){
            ?>
            end = moment('<?php echo $_GET['ed'];?>');
            <?php
        }
        ?>
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            locale: { 
                applyLabel : '<?php echo $this->lang->line('apply');?>',
                cancelLabel: '<?php echo $this->lang->line('clear');?>',
                "customRangeLabel": "<?php echo $this->lang->line('custom');?>",
            },  
            ranges: {
            '<?php echo 'All';?>': ['All', 'All'],
            '<?php echo $this->lang->line('today');?>': [moment(), moment()],
            '<?php echo $this->lang->line('yesterday');?>': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '<?php echo $this->lang->line('last_7_day');?>': [moment().subtract(6, 'days'), moment()],
            '<?php echo $this->lang->line('last_30_day');?>': [moment().subtract(29, 'days'), moment()],
            '<?php echo $this->lang->line('this_month');?>': [moment().startOf('month'), moment().endOf('month')],
            '<?php echo $this->lang->line('last_month');?>': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        },past_date_range);

    });
</script>
  <script type="text/javascript">    
    $(document).ready(function(){
        var start = moment();
        var end = moment().add(29, 'days');
        <?php
        if(isset($_GET['sd']) && $_GET['sd'] != ""){
            ?>
            start = moment('<?php echo $_GET['sd'];?>');
            <?php
        }
        ?>

        <?php
        if(isset($_GET['ed']) && $_GET['ed'] != ""){
            ?>
            end = moment('<?php echo $_GET['ed'];?>');
            <?php
        }
        ?>
        $('#appointment_range').daterangepicker({
            startDate: start,
            endDate: end,
            locale: { 
                applyLabel : '<?php echo $this->lang->line('apply');?>',
                cancelLabel: '<?php echo $this->lang->line('clear');?>',
                "customRangeLabel": "<?php echo $this->lang->line('custom');?>",
            },  
            ranges: {
                '<?php echo 'All';?>': ['All', 'All'],
                '<?php echo 'Today';?>': [moment().add(0, 'days'), moment().add(0, 'days')],
                '<?php echo 'Tomorrow';?>': [moment().add(1, 'days'), moment().add(1, 'days')],
                '<?php echo 'Upcoming 7 day';?>': [moment(),moment().add(6, 'days')],
                '<?php echo 'Upcoming 30 day';?>': [moment(),moment().add(29, 'days'),],
                '<?php echo 'This Month';?>': [moment().startOf('month'), moment().endOf('month')],
                '<?php echo 'Next Month';?>': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
            }
        },feature_date_range);

    });
</script>
   <div class="modal fade" id="close_all">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to Close this Appointments ?</h4>
                </div>
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <button class="btn btn-warning" id="close_link_all" onClick="confSubmit();"><?php echo 'Close';?></button>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo 'Cancel';?></button>
                </div>
            </div>
        </div>
</div>



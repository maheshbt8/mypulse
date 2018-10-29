<?php 
if($id == 1){
    $privacy= $this->db->get_where('settings', array('type' => 'privacy'))->row()->description;
    }elseif($id == 2){
    $privacy = $this->db->get_where('settings', array('type' => 'terms'))->row()->description;
    }
 ?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        
        <?php echo form_open(base_url() . 'main/edit_privacy/'.$id , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
             <div class="form-group">
                    <div class="col-sm-12">
            <textarea type="text" class="form-control" name="name" value=""data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>" required><?php echo $privacy;?></textarea>
                    </div>
                </div>
               
            </div>
            <div class="form-group">
              <div class="col-sm-offset-10 col-sm-2">
                  <input type="submit" class="btn btn-success" value="Update">&nbsp;&nbsp;<input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'">
              </div>
            </div>
        </form>

    </div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>/assets/js/ckeditor/ckeditor.js"></script> 


<script>
    CKEDITOR.replace( 'name' );
</script>
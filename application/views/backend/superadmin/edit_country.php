<?php
$edit_data		=	$this->db->get_where('country' , array('country_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?superadmin/country/update/'.$row['country_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo ucfirst('country_name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"
                            data-validate="required" data-message-required="<?php echo ucfirst('value_required');?>" required/>
                    </div>
                </div>
               
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo ucfirst('edit_country');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>


<div class="row">
   
    <div class="col-md-12">
        <!------CONTROL TABS END------>
         <form role="form" class="form-horizontal form-groups-bordered validate" action="<?php echo base_url(); ?>main/add_prognosis/" method="post" enctype="multipart/form-data">
             
        <div class="tab-content">
           
        <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                
                <div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            
            <div class="panel-body">
                <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3"><?php echo get_phrase('title'); ?></label>
                            <div class="col-sm-9">
                              <input type="hidden" name="user_id" value="<?=$user_id;?>">
                                <input type="hidden" name="doctor_id" value="<?=$doctor_id;?>">
           <input type="text" name="title" placeholder="Title For Prognosis" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="<?php set_value('title');?>" >
                            </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3"><?php echo get_phrase('date & time'); ?></label>
                            <div class="col-sm-9">
          <input type="text" class="form-control" value="<?php echo date('M d,2018 h:i A')?>" readonly/>
                            </div>
                    </div>
                </div>
              </div>
              <div class="row">
            <div class="col-sm-12">
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control"><?php echo get_phrase('case_history'); ?></label>
                            <div class="col-sm-12">
                                <textarea type="text" name="case_history" placeholder="Case History" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('Value_required');?>" value="" rows="10" cols="50"></textarea>
                            </div>
                    </div>
                </div>
            </div>
            </div>
            </div>

        </div>

    </div>
</div>
            </div>   
                    <div class="col-sm-3 control-label col-sm-offset-9 ">
                        <input type="submit" class="btn btn-success" value="<?php echo get_phrase('submit'); ?>">&nbsp;&nbsp;
                        <input type="button" class="btn btn-info" value="<?php echo get_phrase('cancel'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page1'); ?>'">
                    </div>  
                   
   </form>

    </div>
</div>
<br/><br/>
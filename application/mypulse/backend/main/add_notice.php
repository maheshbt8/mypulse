<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo $this->lang->line('labels')['add_notice'];?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups-bordered"  method="post"
                    action="<?php echo base_url(); ?>index.php?superadmin/notice/create" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['title'];?></label>

                        <div class="col-sm-5">
                            <input type="text" name="title" class="form-control" id="field-1" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['description'];?></label>

                        <div class="col-sm-7">
                            <textarea name="description" class="form-control" id="field-ta"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['start_date'];?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" name="start_timestamp" class="form-control datepicker" 
                                    data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo $this->lang->line('labels')['end_date'];?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" name="end_timestamp" class="form-control datepicker" 
                                    data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="<?php echo $this->lang->line('buttons')['submit'];?>">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>


<div class="row">
      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/hospital">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-h-square"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('hospitals'); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('hospitals');?></h3>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('doctors'); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('doctors');?></h3>
            </div>
        </a>
    </div>
   
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/patient">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('patient'); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('mypulse_users');?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="#">
            <div class="tile-stats tile-white-aqua">
                <div class="icon"><i class="fa fa-plus-square"></i></div>
                <div class="num" data-start="0" data-end="10" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('appointments');?></h3>
            </div>
        </a>
    </div>

</div>
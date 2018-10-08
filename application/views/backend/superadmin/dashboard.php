
<div class="row">

      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/hospital">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('hospitals'); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('hospitals');?><div class="icon"><i class="fa fa-h-square"></i></div></h3>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/doctor">
            <div class="tile-stats tile-white tile-white-primary">
               
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('doctors'); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('doctors');?> <div class="icon"><i class="fa fa-user-md"></i></div></h3>
            </div>
        </a>
    </div>
   
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/users">
            <div class="tile-stats tile-white-red">
                
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('users'); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('mypulse_users');?><div class="icon"><i class="fa fa-user"></i></div></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/appointment">
            <div class="tile-stats tile-white-aqua">
               
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('appointments'); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3><?php echo $this->lang->line('appointments');?> <div class="icon"><i class="fa fa-plus-square"></i></div></h3>
            </div>
        </a>
    </div>

</div>

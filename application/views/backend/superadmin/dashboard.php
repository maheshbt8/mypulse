<style>
    .tile-stats .icon{
        bottom: 50px;
    }
</style>
<div class="row">

      <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/hospital">
            <div class="tile-stats tile-white-gray  tile-white-primary">
                <div class="icon"><i class="fa fa-hospital-o"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->count_all('hospitals'); ?>" data-duration="1500" data-delay="0">0</div>
                <h3 style="padding-left: 90px;"><?php echo 'Hospitals';?></h3>
            </div>
        </a>
    </div>
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/doctor">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->count_all('doctors'); ?>"
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 90px;"><?php echo 'Doctors';?> </h3>
            </div>
        </a>
    </div>
   
    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/users">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->count_all('users'); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 90px;"><?php echo 'Users';?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo base_url(); ?>index.php?superadmin/appointment">
            <div class="tile-stats tile-white-aqua">
               <div class="icon"><i class="fa fa-envelope"></i></div>
                <div class="num pull-right" data-start="0" data-end="<?php echo $this->db->count_all('appointments'); ?>" 
                     data-duration="1500" data-delay="0">0 </div>
                <h3 style="padding-left: 90px;"><?php echo $this->lang->line('appointments');?> </h3>
            </div>
        </a>
    </div>

</div>

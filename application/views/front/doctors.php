          <?php 
          if($_GET['specializations']!=''){
            $specializations_id=$_GET['specializations'];
          }else{
            $specializations_id=0;
          }
          if($_GET['location']!=''){
            $location_id=$_GET['location'];
          }else{
            $location_id=0;
          }
          ?>
            <style type="text/css">
div#doctors {
  height: 500px;  
  overflow-y: auto;
}
            </style>
                      <section class="inner-page-banner bg-common inner-page-top-margin" data-bg-image="<?=base_url('assets/frontend/')?>img/figure/medical_hero_banner.jpg" style="background-image: url(&quot;<?=base_url('assets/frontend/')?>img/figure/medical_hero_banner.jpg&quot;);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumbs-area">
                            <h1>Doctors</h1>
                            <ul>
                                <li>
                                    <a href="<?=base_url()?>">Home</a>
                                </li>
                                <li>Doctors</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
                  <!-- Team Area Start Here -->
        <section class="team-wrap-layout1 bg-light-secondary100">
            <!-- <img class="left-img img-fluid" src="<?=base_url();?>assets/frontend/img/figure/figure4.png" alt="figure">
            <img class="right-img img-fluid" src="<?=base_url();?>assets/frontend/img/figure/figure5.png" alt="figure"> -->
            <div class="container-fluid">
                <div class="section-heading heading-dark text-left heading-layout1">
                    <h2>Our Doctors</h2>
                </div>
                <div class="team-search-box">
                      <div class="row">
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label>Location</label>
                                    <select name="cities" class="form-control" value="<?php echo set_value('location'); ?>" onchange="return get_city_doctors(this.value)" id="city_id">
                                <option value="0"><?php echo get_phrase('ALL'); ?></option>
                                <?php 
                                $admins = $this->crud_model->select_city();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['city_id'] ?>" <?php if($row['city_id']==$location_id){echo "selected";}?>><?php echo $row['city_name'] ?></option>
                                <?php } ?>
                            </select>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="form-group">
                                    <label>Specialization</label>
                                    <select name="specializations" class="form-control drop" onchange="return get_specializations_doctors(this.value)" id="specialization_id">
                                        <option value="0"><?php echo get_phrase('ALL'); ?></option>
                                <?php 
                                $admins = $this->db->get_where('specializations')->result_array();
                                foreach($admins as $row){?>
                                <option value="<?php echo $row['specializations_id'] ?>" <?php if($row['specializations_id']==$specializations_id){echo "selected";}?>><?php echo $row['specializations_name'] ?></option>
                                
                                <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Search Doctors</label>
                                    <input class="doctor-name form-control" type="text" placeholder="Search for Doctor or Hospital or Branch or Specializations.." name="doctor-name" value="" id="myInput" onkeyup="filterFunction()" autocomplete="off" autofocus="on">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row" id="doctors">
                    <?php
$hospi=$this->crud_model->get_doctors_SC_front($specializations_id,$location_id);
foreach ($hospi as $row) {
    $branch=$this->db->select('branch_id,branch_name')->get_where('branch' , array('branch_id' => $row['branch_id']))->row();
    $hospital=$this->db->select('hospital_id,name')->get_where('hospitals' , array('hospital_id' => $row['hospital_id']))->row();        
  ?>
                                <div class="col-xl-4 col-lg-12 col-12 media-div">
                                <div class="team-box-layout2">
                                                <div class="item-specialist">
                                                    <div class="media media-none--xs">
                            <img src="<?=base_url('Front/doctor_image/'.$row['doctor_id']);?>" alt="Generic placeholder image" class="img-fluid media-img-auto" style="height:100px;"  draggable="false">
                                                        <div class="media-body">
                                                            <span><h4 class="item-title"><a href="">Dr.
                                                                    <?=$row['name'].' '.$row['lname']?></a></h4></span>
                                                            <span><b>Hospital:</b> <?=$hospital->name;?></span><br/>
                                                            <span><b>Branch:</b> <?=$branch->branch_name;?></span><br/>
                                                            <span><b>Specialization:</b> <?php if($row['specializations']!=''){$spe=explode(',', $row['specializations']);
            for($i=0;$i<count($spe);$i++){
                $specializations[$i]=$this->db->where('specializations_id',$spe[$i])->get('specializations')->row()->specializations_name;
            }
            echo implode(',',$specializations);}?></span>
                                                            <p><b>Available Status:</b> <?php $message='';$data=$this->db->where('doctor_id',$row['doctor_id'])->get('availability')->row();if($data!=''){echo $data->message;}?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                                        </div>
            </div>
        </section>

<script>
function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("doctors");
  a = div.getElementsByClassName("media-div");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
$(document).ready(function(){alert('j');
    var specialization_id=0;
    var city_id=0;
    get_doc(specialization_id,city_id);
});
function get_specializations_doctors(id) {
        var specialization_id=id;
        var city_id=$('#city_id').val();
        get_doc(specialization_id,city_id);
    }
function get_city_doctors(id) {
        var specialization_id=$('#specialization_id').val();
        var city_id=id;
        get_doc(specialization_id,city_id);   
    }
function get_doc(specialization_id,city_id){
   window.location.href = '<?php echo base_url();?>MyPulse-Doctors?specializations='+specialization_id+'&location='+city_id;
}
</script>


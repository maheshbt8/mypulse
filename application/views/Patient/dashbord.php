<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div id="main-wrapper">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter"><?php echo $states['tot_hos'];?></p>
                            <span class="info-box-title"><?php echo $this->lang->line('hospitals');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-hospital-o"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p><span class="counter"><?php echo $states['tot_medStore'];?></span></p>
                            <span class="info-box-title"><?php echo $this->lang->line('medicalStoreFull');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-lg-3 col-md-6">
                <div class="panel info-box panel-white">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p><span class="counter"><?php echo $states['tot_medLab'];?></span></p>
                            <span class="info-box-title"><?php echo $this->lang->line('medicalLabFull');?></span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="<?php echo site_url();?>/appoitments">
                    <div class="panel info-box panel-white">
                        <div class="panel-body">
                            <div class="info-box-stats">
                                <p class="counter"><?php echo $states['tot_app'];?></p>
                                <span class="info-box-title"><?php echo $this->lang->line('appointments');?></span>
                            </div>
                            <div class="info-box-icon">
                                <i class="icon-envelope"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div><!-- Row -->
        <!--OutStanding Prescription Orders -->
        <?php if(count($states['orders']) > 0) { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?=$this->lang->line('labels')['patientOutstendingOrders'];?></h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive project-stats">  
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Title</th>
                                       <th>Doctore</th>
                                       <th>Prescription</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $cnt = 1;
                                        foreach($states['orders'] as $mr){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$cnt;?></th>
                                                <td><?=$mr['title'];?></td>
                                                <td><?=$mr['doctor_name'];?></td>
                                                <td><a href='#' data-url='doctors/previewprescription/<?=$mr['id'];?>' data-id='<?=$mr['id'];?>' class='previewtem'><i class="fa fa-file"></i></a></td>
                                                <td>
                                                    <a href="<?php echo site_url().'/patients/addplaceorder/'.$mr['id'];?>" data-id='<?=$mr['id'];?>' class='PlacePresOrderBtn'><i class="glyphicon glyphicon-plus"></i></a>
                                                    &nbsp; 
                                                    <a href='#' title="Cancel" data-id='<?=$mr['id'];?>' class='CanPresOrderBtn'><i class="glyphicon glyphicon-remove"></i></a> 
                                                </td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                        }
                                    ?>
                                   
                                   
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <!--OutStanding Med Reports -->
        <?php if(count($states['medical_reports']) > 0) { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?=$this->lang->line('labels')['patientOutstendingPLT'];?></h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive project-stats">  
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Title</th>
                                       <th>Description</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    <?php
                                        $cnt = 1;
                                        foreach($states['medical_reports'] as $mr){
                                            ?>
                                            <tr>
                                                <th scope="row"><?=$cnt;?></th>
                                                <td><?=$mr['title'];?></td>
                                                <td><?=$mr['description'];?></td>
                                                <td><button data-toggle="modal" data-target="#selectML" class="btn btn-primary sml" data-id="<?=$mr['id'];?>">Select Medical Lab</button></td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                        }
                                    ?>
                                   
                                   
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div><!-- Main Wrapper -->

    <div class="modal fade" id="selectML" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
		<div class="modal-dialog modal-sm">
		    <form action="<?php echo site_url(); ?>/patients/selectml" method="post" id="form" enctype="multipart/form-data">
			    <input type="hidden" name="mrid" id="mrid">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Edit-Heading">Select Medical Lab</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['selectCountry'];?></label>
                            <select name="country"  id="country" class=" form-control" style="width: 100%"></select>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['selectState'];?></label>
                            <select name="state"  id="state" class=" form-control" style="width: 100%"></select>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                            <select name="district"  id="district" class=" form-control" style="width: 100%"></select>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('labels')['selectCity'];?></label>
                            <select name="city"  id="city" class=" form-control" style="width: 100%"></select>
                        </div>
                        <div class="form-group ">
                            <label><?php echo $this->lang->line('labels')['medicalLab'];?></label>
                            <select class="form-control " name="medicalLab" id="medicalLab" required />
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-defualt" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success"  style="margin-left:10px" type="submit">Select</button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
    $this->load->view('template/footer.php');
?>
<script src="<?php echo base_url();?>public/assets/js/pages/dashboard.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {

        var validator = $("#form").validate({
            ignore: [],
            rules: {
                medicalLab: {
                    required : true
                }
            },
            messages: {
                medicalLab:{
                    required: "<?php echo $this->lang->line('validation')['requiredMedicalLab'];?>"
                },
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });

        $(document).on('click','.sml',function(){
            var id = $(this).data('id');
            $("#mrid").val(id);
        });

        var loc_sid = null;
        var loc_did = null;
        var loc_cid = null; 

        var xhr_1;

        var $selectize_medicalLab = $("#medicalLab").selectize({
            valueField: "id",
            labelField: "text",
            searchField: "text",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.text)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback(); 

                var cid = $("#city").val();

                $.ajax({
                    url: "<?php echo site_url(); ?>/medical_lab/search",
                    type: "GET",
                    data: {"q":query,"city":cid, "f": "name"},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback($.parseJSON(res));
                    }
                });
            },
            onChange: function(value) {
                if (!value.length) return;
            }
        });
        

        var $selectize_city = $("#city").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback(); 

                var did = $("#district").val();

                $.ajax({
                    url: "<?php echo site_url(); ?>/general/getCities",
                    type: "GET",
                    data: {"q":query,"did":did},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback($.parseJSON(res));
                    }
                });
            },
            onChange: function(value) {
                if (!value.length) return;
                $selectize_medicalLab[0].selectize.disable();
                $selectize_medicalLab[0].selectize.clearOptions();
                $selectize_medicalLab[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/medical_lab/search/",
                        type: "GET",
                        data: {"city":value,"f":"name"},
                        success: function(results) {
                            
                            var res = $.parseJSON(results);
                            callback(res);
                            $selectize_medicalLab[0].selectize.enable();
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        var $selectize_district = $("#district").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback(); 

                var sid = $("#state").val();

                $.ajax({
                    url: "<?php echo site_url(); ?>/general/getDistricts",
                    type: "GET",
                    data: {"q":query,"sid":sid},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback($.parseJSON(res));
                    }
                });
            },
            onChange: function(value) {
                if (!value.length) return;

                $selectize_city[0].selectize.disable();
                $selectize_city[0].selectize.clearOptions();
                $selectize_city[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/general/getCities/",
                        type: "GET",
                        data: {"did":value},
                        success: function(results) {
                            
                            var res = $.parseJSON(results);
                            callback(res);
                            if(loc_cid != null){
                                var tempselectize_city = $selectize_city[0].selectize;
                                tempselectize_city.addOption([{"id":loc_cid,"text":loc_cid}]);
                                tempselectize_city.refreshItems();
                                tempselectize_city.setValue(loc_cid);	
                                loc_cid = null;
                            }

                            $selectize_city[0].selectize.enable();
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        var $selectize_state = $("#state").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            onChange: function(value) {
                if (!value.length) return;

                $selectize_district[0].selectize.disable();
                $selectize_district[0].selectize.clearOptions();
                $selectize_district[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/general/getDistricts/",
                        type: "GET",
                        data: {"sid":value},
                        success: function(results) {
                            
                            var res = $.parseJSON(results);
                            callback(res);
                            if(loc_did != null){
                                var tempselectize_district = $selectize_district[0].selectize;
                                tempselectize_district.addOption([{"id":loc_sid,"text":loc_did}]);
                                tempselectize_district.refreshItems();
                                tempselectize_district.setValue(loc_did);	
                                loc_did = null;
                            }
                            
                            $selectize_district[0].selectize.enable();
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        $selectize_state[0].selectize.disable();
        $selectize_district[0].selectize.disable();
        $selectize_city[0].selectize.disable();
        
        var $selectize_country = $("#country").selectize({
            valueField: "id",
            labelField: "name",
            searchField: "name",
            preload:true,
            create: false,
            render: {
                option: function(item, escape) {
                    return "<div><span class='title'>" +
                            escape(item.name)+
                        "</span>" +   
                    "</div>";
                }
            },
            load: function(query, callback) {
                $.ajax({
                    url: "<?php echo site_url(); ?>/general/getCountries",
                    type: "GET",
                    data: {"q":query},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback($.parseJSON(res));
                    }
                });
            },
            onChange: function(value) {
                if (!value.length) return;

                $selectize_state[0].selectize.disable();
                $selectize_state[0].selectize.clearOptions();
                $selectize_state[0].selectize.load(function(callback) {
                    xhr_1 && xhr_1.abort();
                    xhr_1 = $.ajax({
                        url: "<?php echo site_url(); ?>/general/getStates/",
                        type: "GET",
                        data: {"cid":value},
                        success: function(results) {
                           
                            var res = $.parseJSON(results);
                            callback(res);
                            if(loc_sid != null){
                                var tempselectize_state = $selectize_state[0].selectize;
                                tempselectize_state.addOption([{"id":loc_sid,"text":loc_sid}]);
                                tempselectize_state.refreshItems();
                                tempselectize_state.setValue(loc_sid);	
                                loc_sid = null;
                            }
                            $selectize_state[0].selectize.enable();
                            
                        },
                        error: function() {
                            callback();
                        }
                    })
                });
            }
        });

        function resetLocation(){
            $selectize_city[0].selectize.clearOptions();
            $selectize_state[0].selectize.clearOptions();
            $selectize_district[0].selectize.clearOptions();
            $selectize_country[0].selectize.clear();
        }

        var country = "<?php echo $states['profile']['country'];?>";
        var country_name = '<?php echo trim(preg_replace("/\s\s+/", " ", $states['profile']["country_name"]));?>';
        if(country != null && country!=undefined && country != "" && country > 0){
            loc_cid = "<?php echo $states['profile']['city'];?>";
            loc_did = "<?php echo $states['profile']['district'];?>";
            loc_sid = "<?php echo $states['profile']['state'];?>";
            var tempselectize_selectize_country = $selectize_country[0].selectize;
            tempselectize_selectize_country.addOption([{"id":country,"name":country_name}]);
            tempselectize_selectize_country.refreshItems();
            tempselectize_selectize_country.setValue(country);
        }
        $(document).on('click','.CanPresOrderBtn',function(){
            var id = $(this).data('id');
            var btn = $(this);
            swal({
                title: 'Are you sure?',
                text: "You want to Cancel This Order!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(function () {
              $.ajax({
                    url: "<?php echo site_url(); ?>/patients/cancelPrescriptionOutOrder",
                    type: "GET",
                    data: {prescId:id},
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        console.log(res);
                        if(res==1){
                            toastr.success('Order Cancelled','');
                            $(btn).parents('tr').remove();
                        }
                        else{
                            toastr.error('Unable to Cancel Order','');
                        }
                    }
                });                
            });

        });
    });
</script>
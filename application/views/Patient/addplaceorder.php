<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?> 

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Prescription</h4>
                </div>
                <div class="panel-body panel_body_custome">
                    <div class="row" style="">
                        <div class="col-md-12"> 
                            <div class="Prescription col-md-6">
                                <h4>Title : </h4>
                                <?= $pres_data['title'];?>
                                <h4>Doctor : </h4>
                                <?= $pres_data['doctor_name'];?><br>
                                <?= $pres_data['doctor_contact'];?>
                            </div>
                            <div class="col-md-6">
                                <h4>Hospital : </h4>
                                <?= $pres_data['hospital_name'];?><br>
                                <?= $pres_data['hospital_email'];?><br>
                                <?= $pres_data['hospital_address'];?>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="form" method="post" action="<?=site_url();?>/patients/placemedorder">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Select Medical Store</h4>
                </div>
                <div class="panel-body panel_body_custome">
                    <div class="row" style="">
                        <div class="col-md-12"> 
                            <div class="form-group col-md-3">
                                <label><?php echo $this->lang->line('labels')['selectCountry'];?></label>
                                <select name="country"  id="country" class=" form-control" style="width: 100%"></select>
                            </div>
                            <div class="form-group col-md-3">
                                <label><?php echo $this->lang->line('labels')['selectState'];?></label>
                                <select name="state"  id="state" class=" form-control" style="width: 100%"></select>
                            </div>
                            <div class="form-group col-md-3">
                                <label><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                                <select name="district"  id="district" class=" form-control" style="width: 100%"></select>
                            </div>
                            <div class="form-group col-md-3">
                                <label><?php echo $this->lang->line('labels')['selectCity'];?></label>
                                <select name="city"  id="city" class=" form-control" style="width: 100%"></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $this->lang->line('medicalStore');?></label>
                                <select class="form-control " name="medicalStore" id="medicalStore" required />
                                </select>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                <h4 class="panel-title">Item</h4>
                </div>
                <div class="panel-body panel_body_custome">
                <div class="row" style="">
                    <div class="col-md-12"> 
                        <div class="table-responsive project-stats">  
                            
                            <input type="hidden" name="pid" value="<?=$pres_data['id'];?>" />
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Drug</th>
                                        <th>Strength</th>
                                        <th>Dosage</th>
                                        <th>Duration</th>
                                        <th>Note</th>
                                        <th>Quantity</th>
                                        <th>Action</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cnt = 1;
                                    foreach($pres_data['items'] as $item){
                                        ?>
                                        <tr>
                                            <th scope="row"><?=$cnt;?></th>
                                            <td><?= $item['drug'];?></td>
                                            <td><?= $item['strength'];?></td>
                                            <td><?= $item['dosage'];?></td>
                                            <td><?= $item['duration'];?></td>
                                            <td><?= $item['note'];?></td>
                                            <td data-id="<?=$cnt?>" class="edit" id="qty_<?=$cnt;?>">
                                                <span id="lbl_qty_<?=$cnt;?>"><?= $item['qty'];?></span>
                                                <input type="hidden" name="item_id[]" value="<?=$item['id']?>"  />
                                                <input type="hidden" name="qty[]" value="<?=$item['qty']?>" id="edit_qty1_<?=$cnt;?>" />
                                                <input type="text" class="form-control qtyedit" data-id="<?=$cnt;?>" style="display:none" value="<?=$item['qty']?>" id="edit_qty_<?=$cnt;?>" />
                                            </td>
                                            <td>
                                                <a id="editbtn_<?=$cnt;?>" data-id="<?= $cnt;?>" class="btn btn-primary editquantity" ><i class="glyphicon glyphicon-pencil"></i></a>
                                                &nbsp;
                                                <span id="btn_<?=$cnt;?>" style="display:none;">
                                                <a data-id="<?= $cnt;?>" class="btn btn-primary checkquantity" ><i class="glyphicon glyphicon-ok"></i></a>
                                                &nbsp;
                                                <a data-id="<?= $cnt;?>" class="btn btn-warning cancelquantity" ><i class="glyphicon glyphicon-remove"></i></a>
                                                </span>
                                                <!--<a data-id="<?= $pres_data['items'][0]['id'];?>" class="btn btn-success updatequantity" style="display: none;">Update</a>-->
                                            </td>
                                        </tr>                                         
                                        <?php
                                        $cnt++;
                                    }
                                    ?>
                                    
                                </tbody>  
                                <tfooter>
                                    <tr >
                                        <td colspan="8">
                                            <button type="submit" class="btn btn-success pull-right">Place Order</button>
                                        </td>
                                    </tr>
                                </tfooter>             
                            </table>
                            </form>
                        </div>                                
                    </div>    
                </div>
                </div>
            </div>
        </div>
    </div>                        
</div>
<?php
    $this->load->view('template/footer.php');
?>
<script type="text/javascript">
    $(document).ready(function(){
   
        var validator = $("#form").validate({
            ignore: [],
            rules: {
                medicalStore: {
                    required : true
                }
            },
            messages: {
                medicalStore:{
                    required: "<?php echo $this->lang->line('validation')['requiredMedicalStore'];?>"
                },
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
            
        });

         $(document).on('click','.editquantity',function(){
            var row = $(this).data('id');
            $("#lbl_qty_"+row).hide();
            $("#edit_qty_"+row).show();
            $("#btn_"+row).show();
            $(this).hide();
            //$("#qty_"+row).attr('contenteditable',true);
            //$("#qty_"+row).focus();        
               
        });

        $(document).on('click','.checkquantity',function(){
            var row = $(this).data('id');
            var q = $("#edit_qty_"+row).val();
            $("#lbl_qty_"+row).html(q);
            $("#lbl_qty_"+row).show();
            $("#edit_qty_"+row).hide();
            $("#edit_qty1_"+row).val(q);
            $("#btn_"+row).hide();
            $("#editbtn_"+row).show();
        });

        $(document).on('click','.cancelquantity',function(){
            var row = $(this).data('id');
            $("#lbl_qty_"+row).show();
            $("#edit_qty_"+row).hide();
            $("#btn_"+row).hide();
            $("#editbtn_"+row).show();
        });

        /*$(document).on('focusout','.qtyedit',function(){
            var id = $(this).data('id');
            var q = $(this).val();
            $("#edit_qty1_"+id).val(q);
        });*/

        var loc_sid = null;
        var loc_did = null;
        var loc_cid = null; 

        var xhr_1;

        var $selectize_medicalLab = $("#medicalStore").selectize({
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
                    url: "<?php echo site_url(); ?>/medical_store/search",
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
                        url: "<?php echo site_url(); ?>/medical_store/search/",
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

        var country = "<?php echo $profile['country'];?>";
        var country_name = '<?php echo trim(preg_replace("/\s\s+/", " ", $profile["country_name"]));?>';
        if(country != null && country!=undefined && country != "" && country > 0){
            loc_cid = "<?php echo $profile['city'];?>";
            loc_did = "<?php echo $profile['district'];?>";
            loc_sid = "<?php echo $profile['state'];?>";
            var tempselectize_selectize_country = $selectize_country[0].selectize;
            tempselectize_selectize_country.addOption([{"id":country,"name":country_name}]);
            tempselectize_selectize_country.refreshItems();
            tempselectize_selectize_country.setValue(country);
        }

    });

</script>
<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="80" />
	<input type="hidden" id="left_active_sub_menu" value="801" />
    <div id="main-wrapper">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="">
                        <div class="custome_col8">
                            <h3 class="panel-title panel_heading_custome"><?php echo $this->lang->line('about');?></h3>
                        </div>
                        <div class="custome_col4">
                            <div class="panel_button_top_right">
                                <a class="btn btn-primary m-b-sm " id="editBtn" data-toggle="tooltip" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['edit'];?></a>
                                <a class="btn btn-default m-b-sm " id="cancelBtn" data-toggle="tooltip" style="display:none" href="javascript:void(0);" ><?php echo $this->lang->line('buttons')['cancel'];?></a>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="panel-body" id="profileBody">
                    <form action="<?php echo site_url(); ?>/hospitals/about" method="post" id="form" enctype="multipart/form-data">
                        <input type="hidden" name="eidt_gf_id" value="<?php echo $about['id'];?>" />
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['name'];?></label>
                                    <input data-ori="<?php echo $about['name'];?>" value="<?php echo $about['name'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['name'];?>" name="name" id="name" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['description'];?></label>
                                    <textarea data-ori="<?php echo $about['description'];?>" class="form-control" rows="5"  placeholder="<?php echo $this->lang->line('labels')['aboutHospital'];?>" name="description" id="description"><?php echo $about['description'];?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['address'];?></label>
                                    <input data-ori="<?php echo $about['address'];?>" value="<?php echo $about['address'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['address'];?>" name="address" id="address" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['phone_number'];?></label>
                                    <input data-ori="<?php echo $about['phone_numbers'];?>" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('labels')['phone_number'];?>" name="phone_numbers" id="phone_numbers" value="<?php echo $about['phone_numbers'];?>" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['email'];?></label>
                                    <input data-ori="<?php echo $about['email'];?>" value="<?php echo $about['email'];?>" class="form-control " type="text" placeholder="<?php echo $this->lang->line('labels')['email'];?>" name="email" id="email" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['hospital_url'];?></label>
                                    <?php
                                        $place = "http://www.mypulse.com";
                                        if($about['slug'] != ""){
                                            $place .= "/".$about['slug']; 
                                        }else{
                                            $place .= "/yourhospitalname";
                                        }
                                    ?>
                                    <input data-ori="<?php echo $about['slug'];?>" type="text" class="form-control"  placeholder="<?php echo $place;?>" name="slug" id="slug" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label><?php echo $this->lang->line('labels')['logo'];?></label>
                                    <div class="">
                                        <div class=" input-group image-preview">
                                            <input type="text" class="form-control image-preview-filename" id="prephoto" disabled="disabled"> 
                                            <span class="input-group-btn">
                                                <!-- image-preview-clear button -->
                                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                    <span class="glyphicon glyphicon-remove"></span> <?php echo $this->lang->line('labels')['clear'];?>
                                                </button>
                                                <!-- image-preview-input -->
                                                <div class="btn btn-default image-preview-input">
                                                    <span class="glyphicon glyphicon-folder-open"></span>
                                                    <span class="image-preview-input-title"><?php echo $this->lang->line('labels')['browse'];?></span>
                                                    <input data-ori="<?php echo $about['logo'];?>" type="file" accept="image/png, image/jpeg" name="logo" id="logo" />
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <label><?php echo $this->lang->line('labels')['selectCountry'];?></label>
                                    <select data-ori="<?php echo $about['country'];?>" name="country"  id="country" class=" form-control" style="width: 100%"></select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label><?php echo $this->lang->line('labels')['selectState'];?></label>
                                    <select data-ori="<?php echo $about['state'];?>" name="state"  id="state" class=" form-control" style="width: 100%"></select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label><?php echo $this->lang->line('labels')['selectDistrict'];?></label>
                                    <select data-ori="<?php echo $about['district'];?>" name="district"  id="district" class=" form-control" style="width: 100%"></select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label><?php echo $this->lang->line('labels')['selectCity'];?></label>
                                    <select data-ori="<?php echo $about['city'];?>" name="city"  id="city" class=" form-control" style="width: 100%"></select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12">
                    <br>
                    <hr>
                    </div>
                    <h3 class="panel-title"><?php echo $this->lang->line('labels')['licenseInfo'];?></h3><br>
                    <div class="col-md-12">
                        <table cellspacing="10" class="table  " style="margin-top:10px">
                            <tr>
                                <td style="width:150px" align="right"><?php echo $this->lang->line('labels')['license'];?> : </td>
                                <td><?php echo $about['license_category'];?></label></td>
                            </tr>
                            <tr>
                                <td style="width:150px" align="right"><?php echo $this->lang->line('labels')['status'];?> : </td>
                                <td><?php echo $this->auth->getActiveStatus($about['license_status']);?></label></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div><!-- Main Wrapper -->
<?php
    $this->load->view('template/footer.php');
?>
<script type="text/javascript">
    $( document ).ready(function() {
        var loc_sid = null;
        var loc_did = null;
        var loc_cid = null; 
        var isEdit = false;

        var xhr_1;

        $("#slug").inputmask("http://www.mypulse.com/*{+}");
        

        var validatorForm = $("#form").validate({
            ignore: [],
            rules: {
                name: {
                    required : true
                },
                address: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone_numbers: {
                    required: true
                },
                slug:{
                    remote: "<?php echo site_url();?>/hospitals/checkslug"
                }
            },
            messages: {
                name:{
                    required: "<?php echo $this->lang->line('validation')['requiredHName'];?>"
                },
                address:{
                    required: "<?php echo $this->lang->line('validation')['requriedAddress'];?>"
                },
                email:{
                    required: "<?php echo $this->lang->line('validation')['requiredEmail'];?>",
                    email: "<?php echo $this->lang->line('validation')['invalidEmail'];?>"
                },
                phone_numbers:{
                    required: "<?php echo $this->lang->line('validation')['requriedPhone'];?>"
                },
                slug:{
                    remote:"<?php echo $this->lang->line('validation')['takenSlug'];?>"
                }
            },
            invalidHandler: validationInvalidHandler,
            errorPlacement: validationErrorPlacement
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

                            if(isEdit){
                                $selectize_city[0].selectize.enable();
                            }else{
                                $selectize_city[0].selectize.disable();
                            }
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
                            if(isEdit){
                                $selectize_district[0].selectize.enable();
                            }else{
                                $selectize_district[0].selectize.disable();
                            }
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
                            if(isEdit){
                                $selectize_state[0].selectize.enable();
                            }else{
                                $selectize_state[0].selectize.disable();
                            }
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

        var country = "<?php echo $about['country'];?>";
        var country_name = '<?php echo trim(preg_replace("/\s\s+/", " ", $about["country_name"]));?>';
        if(country != null && country!=undefined && country != "" && country > 0){
            loc_cid = "<?php echo $about['city'];?>";
            loc_did = "<?php echo $about['district'];?>";
            loc_sid = "<?php echo $about['state'];?>";
            var tempselectize_selectize_country = $selectize_country[0].selectize;
            tempselectize_selectize_country.addOption([{"id":country,"name":country_name}]);
            tempselectize_selectize_country.refreshItems();
            tempselectize_selectize_country.setValue(country);
        }
        $selectize_country[0].selectize.disable();

        shwoImgFromUrl("<?php echo $about['logo'];?>");

        $("#editBtn").click(function(){
            toggleEditButton();
        });

        $("#cancelBtn").click(function(){
            isEdit = false;
             var eb = $("#editBtn");
            $("#cancelBtn").hide();
            disableFields();
            $(eb).data('isEdit','0');
            $(eb).addClass('btn-primary');
            $(eb).removeClass('btn-success');
            $(eb).html('Edit');
            disableFields();
            resetForm();
        });

        function resetForm(){
            $("#form input[type=text]").each(function() {
                if($(this).data('ori') != undefined){
                    $(this).val($(this).data('ori'));
                }
            });

            $("#form textarea").each(function() {
                if($(this).data('ori') != undefined){
                    $(this).val($(this).data('ori'));
                }
                $(this).attr('disabled',true);
            });

            $("#form select").each(function() {
                if($(this).data('ori') != undefined){
                    $(this).val($(this).data('ori'));
                }
            });

            //$("#date_of_birth").datepicker('setDate',$("#date_of_birth").data('ori'));
            loc_sid = $("#state").data('ori');
            loc_did = $("#district").data('ori');
            loc_cid = $("#city").data('ori');

            var tempselectize_selectize_country = $selectize_country[0].selectize;
            tempselectize_selectize_country.addOption([{"id":$("#country").data('ori'),"name":$("#country").data('ori')}]);
            tempselectize_selectize_country.refreshItems();
            tempselectize_selectize_country.setValue($("#country").data('ori'));
            isEdit = false;
            shwoImgFromUrl($("#logo").data('ori'));
        }


        function toggleEditButton(){
            var eb = $("#editBtn");
            if($(eb).data('isEdit') == "1"){
                isEdit = false;
                saveData();
                $("#cancelBtn").hide();
            }else{
                isEdit = true;
                $(eb).data('isEdit','1');
                $(eb).removeClass('btn-primary');
                $(eb).addClass('btn-success');
                $(eb).html('Save');
                enableFields();
                $("#cancelBtn").show();
            }
        }

        function disableFields(){
            $("#profileBody input").prop("disabled", true);
            $("#profileBody textarea").prop("disabled", true);
            $("#profileBody select").prop("disabled", true);
            $("#profileBody button").prop("disabled", true);
            $selectize_city[0].selectize.disable();
            $selectize_state[0].selectize.disable();
            $selectize_district[0].selectize.disable();
            $selectize_country[0].selectize.disable();

            //$("#passwordhint").hide();
        }

        function enableFields(){
            $("#profileBody input").prop("disabled", false);
            $("#profileBody textarea").prop("disabled", false);
            $("#profileBody select").prop("disabled", false);
            $("#profileBody button").prop("disabled", false);

            $selectize_city[0].selectize.enable();
            $selectize_state[0].selectize.enable();
            $selectize_district[0].selectize.enable();
            $selectize_country[0].selectize.enable();
            //$("#passwordhint").show();
            $("#useremail").prop("disabled",true);
            $("#mobile").prop("disabled",true);
        }

        disableFields();

        function saveData(){
            $("#form").submit();
        }
    });
</script>
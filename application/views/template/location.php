
    var loc_sid = null;
    var loc_did = null;
    var loc_cid = null;

    var xhr_1;

    

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
                        $selectize_city[0].selectize.enable();
                        var res = $.parseJSON(results);
                        callback(res);
                        if(loc_cid != null){
                            var tempselectize_city = $selectize_city[0].selectize;
                            tempselectize_city.addOption([{"id":loc_cid,"text":loc_cid}]);
                            tempselectize_city.refreshItems();
                            tempselectize_city.setValue(loc_cid);	
                            loc_cid = null;
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
                        $selectize_district[0].selectize.enable();
                        var res = $.parseJSON(results);
                        callback(res);
                        if(loc_did != null){
                            var tempselectize_district = $selectize_district[0].selectize;
                            tempselectize_district.addOption([{"id":loc_sid,"text":loc_did}]);
                            tempselectize_district.refreshItems();
                            tempselectize_district.setValue(loc_did);	
                            loc_did = null;
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
                        $selectize_state[0].selectize.enable();
                        var res = $.parseJSON(results);
                        callback(res);
                        if(loc_sid != null){
                            var tempselectize_state = $selectize_state[0].selectize;
                            tempselectize_state.addOption([{"id":loc_sid,"text":loc_sid}]);
                            tempselectize_state.refreshItems();
                            tempselectize_state.setValue(loc_sid);	
                            loc_sid = null;
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


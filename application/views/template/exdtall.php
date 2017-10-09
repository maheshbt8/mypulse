jQuery.fn.DataTable.Api.register( 'buttons.exportData()', function ( options ) {
    if ( this.context.length ) {
        var jsonResult = $.ajax({
            url: "<?php echo $ex_url;?>",
            success: function (result) {
                //Do nothing
            },
            async: false
        });
        var data = jQuery.parseJSON(jsonResult.responseText).data;
        return {body: data, header: $("#<?php echo $tbl;?> thead tr th").map(function() { return this.innerHTML; }).get()};
    }
} );
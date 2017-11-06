var buttons = new $.fn.dataTable.Buttons(dt, {
buttons: [
    {
        text: 'Excel',
        action: function ( e, dt, node, config ) {
            var data = dt.ajax.params();
            var x = JSON.stringify(data, null, 4); 
            var url = dt.ajax.url();
            if(url.indexOf('?') == -1){
                url += '?mpexp=1&mpexpt=xlsx&'+$.param(data);
            }else{
                url += '&mpexp=1&mpexpt=xlsx&'+$.param(data);
            }
            
            window.open(url, 'Export'); 
        }
    },
    {
        text: 'PDF',
        action: function ( e, dt, node, config ) {
            var data = dt.ajax.params();
            var x = JSON.stringify(data, null, 4); 
            var url = dt.ajax.url();
            if(url.indexOf('?') == -1){
                url += '?mpexp=1&mpexpt=pdf&'+$.param(data);
            }else{
                url += '&mpexp=1&mpexpt=pdf&'+$.param(data);
            }
            
            window.open(url, 'Export'); 
        }
    }
]
}).container().appendTo($('#exportBTNList'));
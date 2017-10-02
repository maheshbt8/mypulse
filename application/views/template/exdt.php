var buttons = new $.fn.dataTable.Buttons(dt, {
buttons: [
    'csvHtml5',
    'excelHtml5',
    {
        extend: 'excel',
        text: 'Save All pages',
        exportOptions: {
            columns: ':visible',
                modifier: {
                page: 'all'
            }
        }
    }
]
}).container().appendTo($('#exportBTNList'));
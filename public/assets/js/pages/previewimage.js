$(document).ready(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
        $("#item_image_url").val("");
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var file = this.files[0];
        shwoImg(file,file.name);
    });  

    function shwoImg(file,name){
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      

        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        

        reader.readAsDataURL(file);
    }

    $(document).on('click', '#close-preview', function(){ 
        $('.image-preview').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
            $('.image-preview').popover('show');
            }, 
            function () {
            $('.image-preview').popover('hide');
            }
        );    
    });


    
});

function shwoImgFromUrl(url){
        if(url!=null && url!="" ){
            var indx = url.lastIndexOf("/")+1;
            var name = url.substr(indx)
            var img = $('<img/>', {
                id: 'dynamic',
                src: url,
                width:250,
                height:200
            });      
            
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(name);            
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
            $(document).find("#close-preview").trigger('click');
        }
    }
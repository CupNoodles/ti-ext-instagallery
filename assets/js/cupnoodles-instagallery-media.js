$(document).ready(function(){
    
    $('.instagallery-media-active').on('change', function(){

        console.log($(this).is(':checked'));

        $.ajax({
            url: '/admin/cupnoodles/instagallery/instamedia/save',
            type: 'POST',
            dataType: 'json',
            data: {
              media_id: $(this).data('media-id'),
              active: $(this).is(':checked')
            },
            success: function(data) {
                // do something?
            }
        });


    });

});
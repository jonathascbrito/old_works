jQuery(

    function( $ )
    {
        $('.error-message').each(function(count, message){

            var text = $(message).html();
            var input = $(message).prev();

            $(message).remove();

            $(input).tooltip({
                placement   : 'right',
                trigger     : 'manual',
                title       : '<div class="error-message-text">'+text+'</div>'
            });

            $(input).tooltip('show');
            $(input).parents('.control-group').addClass('error');
        })

        $('.error-message-text').parent().parent().addClass('error-message');

    }

);
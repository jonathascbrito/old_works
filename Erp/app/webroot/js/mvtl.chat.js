var toggle;
var chatlist;

jQuery
(
    function ( $ )
    {
    	toggle = $( $('#chat .chat-list-toggle')[0] );
        chatlist = $( $('#chat .chat-list')[0] );

        chatlist.css('height', 0);

        toggle.click
        (
            function ( event )
            {
                event.preventDefault();

                var size = $(window).outerHeight(true)-50;
                    size = size > 400 ? 400 : size;

                if( toggle.css('bottom') == '0px' ) {
                    toggle.clearQueue();
                    toggle.animate( { bottom: size+2 } );

                    chatlist.clearQueue();
                    chatlist.animate( { height: size } );

                    toggle.children('span')
                            .removeClass('closed')
                            .addClass('opened');
                }else{
                    toggle.clearQueue();
                    toggle.animate( { bottom: 0 } );

                    chatlist.clearQueue();
                    chatlist.animate( { height: 0 } );

                    toggle.children('span')
                            .removeClass('opened')
                            .addClass('closed');
                }
            }
        );
    }
);
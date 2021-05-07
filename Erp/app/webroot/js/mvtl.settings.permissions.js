jQuery(

    function( $ )
    {

        $( '.description-toggle' ).click
        (
            function ( event )
            {
                event.preventDefault();

                $( '.help-block' ).css( 'display',
                    $( '.help-block' ).css( 'display' ) == 'none' ? 'block' : 'none'
                );
            }
        );

    }

);
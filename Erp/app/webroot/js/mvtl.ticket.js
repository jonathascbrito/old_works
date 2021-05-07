jQuery(function($){

    var tipo = $("#TicketStatus").attr('value');

    if (tipo == "Fechado") {

        $(".answer").attr('style','display: none;');
        $(".closing_observation").attr('style','display: block;');

    } else {

        $(".answer").attr('style','display: block;');
        $(".closing_observation").attr('style','display: none;');
    }

    $("#TicketStatus").change(function(event) {
        var tipo = $(this).attr('value');

        if (tipo == "Fechado") {

            $(".answer").attr('style','display: none;');
            $(".closing_observation").attr('style','display: block;');


        } else {

            $(".answer").attr('style','display: block;');
            $(".closing_observation").attr('style','display: none;');

        }

    });
    
});


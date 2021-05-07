jQuery(function($){

    var tipo = $("#ProtocolType").attr('value');

    if (tipo == "Externo") {

        $(".interno").attr('style','display: none;');
        $(".externo").attr('style','display: block;');

    } else if(tipo == "Interno") {
        $(".externo").attr('style','display: none;');
        $(".interno").attr('style','display: block;');
    }

    $("#ProtocolType").change(function(event) {
        var tipo = $(this).attr('value');

        if (tipo == "Externo") {

            $(".interno").attr('style','display: none;');
            $(".externo").attr('style','display: block;');


        } else if(tipo == "Interno") {
            $(".externo").attr('style','display: none;');
            $(".interno").attr('style','display: block;');
            
        }

    });
    var checado = $("#ProtocolCheckbox").attr('checked');

    $("#ProtocolReponseReceivingName").attr('disabled', checado == 'checked'? false : 'disabled');
    $("#ProtocolResponseReceivingId").attr('disabled', checado == 'checked' ? 'disabled' : false);


    var status = $("#ProtocolStatus").attr('value');
    $("#ProtocolReturnDateDay").attr('disabled', status == 'Finalizado' ? false : 'disabled');
    $("#ProtocolReturnDateMonth").attr('disabled', status == 'Finalizado' ? false : 'disabled');
    $("#ProtocolReturnDateYear").attr('disabled', status == 'Finalizado' ? false : 'disabled');

    $("#ProtocolStatus").change(function(event) {

        var valor = $(this).attr('value');
        $("#ProtocolReturnDateDay").attr('disabled', valor == 'Finalizado' ? false : 'disabled');
        $("#ProtocolReturnDateMonth").attr('disabled', valor == 'Finalizado' ? false : 'disabled');
        $("#ProtocolReturnDateYear").attr('disabled', valor == 'Finalizado' ? false : 'disabled');

    });

    $("#ProtocolCheckbox").change(function(event){
        var value = $(this).attr('checked');
        $("#ProtocolReponseReceivingName").attr('disabled', value == 'checked' ? false : 'disabled');
        $("#ProtocolResponseReceivingId").attr('disabled', value == 'checked' ? 'disabled' : false);
    });

    $("#success").keyup(function(event){
        var value = $(this).val();
        var percent = ( value.indexOf("%") > -1 );

        $('.success-base').css('display', percent ? 'block' : 'none');
    });

    $("#add-alert").click(function(event){
        event.preventDefault();

        $(".alerts").append(  '<div class="control-row">'
            + '<div class="input-prepend input-append">'
            + '<input class="add-on" type="text" disabled="disabled" name="alerts[date][]" value="'+$("#alert-date").val()+'"> '
            + '<input type="text"  disabled="disabled" placeholder="DescriÃ§Ã£o" name="alerts[text][]" value="'+$("#alert-text").val()+'"> '
            + '<button class="btn" class="remove-alert">-</button>'
            + '</div>'
            + '</div>' );

        var itens = $(".alerts .btn");
        $(itens[itens.length-1]).click(function(event){
            event.preventDefault();
            $(this).parent().remove();
        });
    });

});

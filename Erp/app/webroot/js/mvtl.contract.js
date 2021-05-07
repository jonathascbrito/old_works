jQuery(

    function( $ )
    {

        function checkContractValuePart ( )
        {
            var exito = ($('#ContractType').val().toString().indexOf('Êxito') != -1);
            $('#ContractValue0Part').attr( 'disabled', exito ? null : 'disabled' );

            if( ! exito )
            {
                $('#ContractValue0Part').tooltip('hide');
                $('#ContractValue0Part').parents('.control-group').removeClass('error');
                $('#ContractValue0Part').val('0%');
            }
        }

        checkContractValuePart( );

        $('#ContractType').change(function(event){
            var gc = $(this).val() == 'Guarda-Chuva';

            $('#ContractValue0Part').attr( 'disabled', gc ? 'disabled' : null );
            $('#ContractValue0Base').attr( 'disabled', gc ? 'disabled' : null );

            if ( gc )
            {
                $('#ContractValue0Part').val('0%');
                $('#ContractValue0Base').val('0,00');
            }

            checkContractValuePart( );
        });

        $('#ContractValue0Base').change(function(event){
            $(this).val(new Number($(this).val().toString().replace('.', '').replace(',', '.')).toMoney(2, ',', '.'));
        });

        $('#ContractValue0Part').change(function(event){
            if($(this).val().toString().indexOf('%') == -1){
                $(this).val(new Number($(this).val().toString().replace('.', '').replace(',', '.')).toMoney(2, ',', '.'));
            }
        });

    }

);
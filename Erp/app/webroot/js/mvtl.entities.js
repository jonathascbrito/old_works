jQuery(

    function( $ )
    {
        $('#EntityType').change(
            function (event)
            {
                checkType();
            }
        );

        $('#EntityOwner, #EntityPartner, #EntityRepresentant, #EntityEmployee').click(
            function (event)
            {
                checkRelations();
            }
        );

        checkType();
        checkRelations();
    }

);

function checkType ( )
{
    if ( $('#EntityType').val() == 'Pessoa Física' ) {
        $('#EntityEntityId').attr('disabled', 'disabled');
        $('#EntityEntityId').val('');
    }else{
        $('#EntityEntityId').attr('disabled', false);
    }
}

function checkRelations ( )
{
    if (    $('#EntityOwner').attr('checked')
         || $('#EntityPartner').attr('checked')
         || $('#EntityRepresentant').attr('checked')
         || $('#EntityEmployee').attr('checked') ) {
        $('#EntityOrganizationalUnitId').attr('disabled', false);
    }else{
        $('#EntityOrganizationalUnitId').attr('disabled', 'disabled');
        $('#EntityOrganizationalUnitId').val('');
    }
}
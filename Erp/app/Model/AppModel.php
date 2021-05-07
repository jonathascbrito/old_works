<?php

App::uses('Model', 'Model');

class AppModel extends Model
{

    function notEmptyIf( $field = array(), $compare_field = null, $value = null )
    {
        $field_name = array_keys( $field );
        $field_name = $field_name[0];

        $condition = $this->data[ $this->name ][ $compare_field ] == $value;


        if( ! $condition )
        {
            return true;
        }

        return ! empty( $field[$field_name] );
    }

}

?>
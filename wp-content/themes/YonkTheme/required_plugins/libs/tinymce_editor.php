<?php defined('ABSPATH') or die('No script kiddies please!');?>
<?php

    function tiny_mce_blockquote_button( $buttons ) {
        foreach ( $buttons as $key => $button ) {
            if ( 'blockquote' === $button ) {
                unset( $buttons[ $key ] );
            }
        }
        
        return $buttons;
    }

    add_filter( 'mce_buttons', 'tiny_mce_blockquote_button' );

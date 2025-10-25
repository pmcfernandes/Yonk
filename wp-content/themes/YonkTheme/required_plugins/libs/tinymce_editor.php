<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    function Yonk_tinymce_add_buttons() {
        add_filter( 'mce_buttons', 'Yonk_tinymce_justify_button', 5 );
    }

    add_action( 'admin_init', 'Yonk_tinymce_add_buttons' );

    function Yonk_tinymce_justify_button( $buttons_array ) {

        foreach ($buttons_array as $key => $button) {
            if ('blockquote' === $key) {
                unset($buttons_array[$key]);
            }
        }

        if ( ! in_array( 'alignjustify', $buttons_array ) && in_array( 'alignright', $buttons_array ) ) {
            $key      = array_search( 'alignright', $buttons_array );
            $inserted = array( 'alignjustify' );
            array_splice( $buttons_array, $key + 1, 0, $inserted );
        }

        if ( ! in_array( 'underline', $buttons_array ) ) {
            $inserted = array( 'underline' );
            array_splice( $buttons_array, 0, 0, $inserted );
        }

        return $buttons_array;
    }

<?php

    if (!defined('ABSPATH')) {
        exit;
    }

    function Yonk_tinymce_blockquote_button($buttons)
    {
        foreach ($buttons as $key => $button) {
            if ('blockquote' === $button) {
                unset($buttons[$key]);
            }
        }

        return $buttons;
    }

    add_filter('mce_buttons', 'Yonk_tinymce_blockquote_button');

    function Yonk_tinymce_restore_justify_button($init)
    {
        // Add 'justify' to the list of text alignment options
        if (isset($init['toolbar1']) && strpos($init['toolbar1'], 'alignleft') !== false) {
            $init['toolbar1'] = str_replace('alignright', 'alignright alignjustify', $init['toolbar1']);
        }

        // Add justify to the list of valid elements if it's not already there
        if (!isset($init['extended_valid_elements']) || strpos($init['extended_valid_elements'], 'justify') === false) {
            $init['extended_valid_elements'] = isset($init['extended_valid_elements'])
                ? $init['extended_valid_elements'] . ',p[style],span[style]'
                : 'p[style],span[style]';
        }

        // Enable the justify button in TinyMCE
        if (!isset($init['align_formats'])) {
            $init['align_formats'] = 'Align left=alignleft;Align center=aligncenter;Align right=alignright;Justify=justifyfull';
        } elseif (strpos($init['align_formats'], 'justifyfull') === false) {
            $init['align_formats'] .= ';Justify=justifyfull';
        }

        return $init;
    }

    add_filter('tiny_mce_before_init', 'Yonk_tinymce_restore_justify_button');

    function Yonk_add_justify_button_to_editor($buttons): mixed
    {
        // Add the justify button if it's not already present
        if (!in_array('alignjustify', $buttons)) {
            $pos = array_search('alignright', $buttons);
            if ($pos !== false) {
                array_splice($buttons, $pos + 1, 0, 'alignjustify');
            } else {
                $buttons[] = 'alignjustify';
            }
        }
        return $buttons;
    }

    add_filter('mce_buttons', 'Yonk_add_justify_button_to_editor');
<?php

if (!defined('ABSPATH')) {
    exit;
}


function Yonk_theme_options()
{
    if (!function_exists('ot_settings_id') || !is_admin())
        return false;

    $saved_settings = get_option('option_tree_settings', array());

    $custom_settings = array(
        'sections' => array(
            array(
                'id' => 'general',
                'title' => __('General', 'blank'),
            ),
        ),
        'settings' => array(
            array(
                'id' => 'google_api_key',
                'label' => __('Google API Key', 'blank'),
                'desc' => '',
                'std' => '',
                'type' => 'text',
                'section' => 'general',
            ),
            array(
                'id' => 'disable_author',
                'label' => __('Disable Author', 'blank'),
                'desc' => '',
                'std' => true,
                'type' => 'radio',
                'section' => 'general',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => true,
                        'label' => 'Yes'
                    ),
                    array(
                        'value' => false,
                        'label' => 'No'
                    )
                )
            ),
            array(
                'id' => 'disable_comments',
                'label' => __('Disable Comments', 'blank'),
                'desc' => '',
                'std' => true,
                'type' => 'radio',
                'section' => 'general',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => true,
                        'label' => 'Yes'
                    ),
                    array(
                        'value' => false,
                        'label' => 'No'
                    )
                )
            ),
            array(
                'id' => 'enable_lazy_load_images',
                'label' => __('Enable Lazy Load Images', 'blank'),
                'desc' => '',
                'std' => false,
                'type' => 'radio',
                'section' => 'general',
                'class' => '',
                'choices' => array(
                    array(
                        'value' => true,
                        'label' => 'Yes'
                    ),
                    array(
                        'value' => false,
                        'label' => 'No'
                    )
                )
            ),
        )
    );

    /* settings are not the same update the DB */
    if ($saved_settings !== $custom_settings) {
        update_option('option_tree_settings', $custom_settings);
    }

    /* Lets OptionTree know the UI Builder is being overridden */
    global $ot_has_custom_theme_options;
    $ot_has_custom_theme_options = true;

}


add_action('init', 'Yonk_theme_options', 1);

/**
 * Add Google Maps api key to Elementor
 *
 * @return void
 */
function Yonk_elementor_google_maps_api_key()
{
    $key = ot_get_option('google_api_key', '');

    if (!empty($key)) {
        update_option('elementor_google_maps_api_key', $key);
    }
}

add_action('init', 'Yonk_elementor_google_maps_api_key');

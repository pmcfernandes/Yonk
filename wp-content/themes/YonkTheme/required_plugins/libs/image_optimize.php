<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php

/**
 * Optimize image on upload using TINYPNG api 
 * 
 * @param mixed $file
 */
function Yonk_optimize_image_on_upload($file)
{
    // Only process images
    if (!preg_match('/(jpg|jpeg|png|gif)$/i', $file['file'])) {
        return $file;
    }

    // Prepare the API request
    $api_url = 'https://api.resmush.it/ws.php';
    $image_url = $file['url'];

    $protocol = isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];

    // Send the request to resmush.it API
    $response = wp_remote_get(add_query_arg('img', $image_url, $api_url), array(
        'header' => array(
            'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3',
            'referer' => $protocol . '://' . $host
        )
    ));

    // Check for errors
    if (is_wp_error($response)) {
        error_log('Resmush.it API Error: ' . $response->get_error_message());
        return $file;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    // Check if optimization was successful
    if (!isset($data['dest'])) {
        error_log('Resmush.it API did not return an optimized image URL');
    } else {}
        $optimized_image_url = $data['dest'];

        // Download the optimized image
        $optimized_image_content = wp_remote_get($optimized_image_url);
        if (is_wp_error($optimized_image_content)) {
            error_log('Failed to download optimized image: ' . $optimized_image_url);
        } else {
            $optimized_image_content = wp_remote_retrieve_body($optimized_image_content);

            if (!file_put_contents($file['file'], $optimized_image_content)) {
                error_log('Failed to save optimized image: ' . $file['file']);
            } else {
                $file['size'] = filesize($file['file']);
                // error_log('Image optimized successfully: ' . $file['file']);
            }
        }
        

    return $file;
}

add_filter('wp_handle_upload', 'Yonk_optimize_image_on_upload');

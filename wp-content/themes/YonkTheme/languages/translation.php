<?php

/**
 * Scan a folder for all PHP files and extract strings used in _e functions.
 * 
 * @param string $folder
 * @return array
 */
function extract_strings_from_folder($folder) {
    $strings = [];
    $files = new RecursiveIteratorIterator(new RecursiveCallbackFilterIterator(
        new RecursiveDirectoryIterator($folder),
        function ($file, $key, $iterator) {
            // Skip directories and files in the required_plugins/acf folder
            
            if ($iterator->hasChildren() && $file->getFilename() === 'acf') {
                return false;
            }

            if ($iterator->hasChildren() && $file->getFilename() === 'vendor') {
                return false;
            }

            if ($file->getFilename() === 'class-tgm-plugin-activation.php') {
                return false;
            }


            return true;
        }
    ));

    foreach ($files as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $content = file_get_contents($file->getRealPath());

            // Extract strings from _e function
            preg_match_all('/_e\(\s*\'(.*?)\'\s*,\s*\'(.*?)\'\s*\)/', $content, $matches_e, PREG_SET_ORDER);
            foreach ($matches_e as $match) {
                $strings[$match[1]] = '';
            }

            // Extract strings from __ function
            preg_match_all('/__\(\s*\'(.*?)\'\s*,\s*\'(.*?)\'\s*\)/', $content, $matches__, PREG_SET_ORDER);
            foreach ($matches__ as $match) {
                $strings[$match[1]] = '';
            }
        }
    }

    return $strings;
}

/**
 * Create a .pot file from extracted strings.
 * 
 * @param array $strings
 * @param string $output_file
 */
function create_pot_file($strings, $output_file) {
    $pot_content = '';

    foreach ($strings as $string => $translation) {
        $pot_content .= "msgid \"$string\"\n";
        $pot_content .= "msgstr \"$translation\"\n\n";
    }

    file_put_contents($output_file, $pot_content);
}

// Define the folder to scan and the output .pot file
$folder_to_scan = dirname(__DIR__, 2); // Change this to the folder you want to scan
$output_pot_file = 'translations.po';

// Extract strings and create the .pot file
$strings = extract_strings_from_folder($folder_to_scan);
create_pot_file($strings, $output_pot_file);

echo "Language file created: $output_pot_file\n";
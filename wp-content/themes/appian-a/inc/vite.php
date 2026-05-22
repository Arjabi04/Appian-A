<?php

function theme_vite_manifest() {

    static $manifest = null;

    if ( $manifest ) {
        return $manifest;
    }

    $manifest_path = get_template_directory() . '/public/.vite/manifest.json';

    if ( ! file_exists( $manifest_path ) ) {
        return [];
    }

    $manifest = json_decode(
        file_get_contents( $manifest_path ),
        true
    );

    return $manifest;
}

/**
 * Add type="module" to scripts loaded by Vite or custom block modules.
 */
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    $module_handles = [
        'vite-client',
        'theme-app',
        'theme-editor',
        'theme-editor-js',
    ];

    if (in_array($handle, $module_handles) || (strlen($handle) > 7 && substr($handle, -7) === '-module')) {
        if (strpos($tag, 'type="module"') === false) {
            $tag = str_replace('<script ', '<script type="module" ', $tag);
        }
    }
    return $tag;
}, 10, 3);

<?php
add_action('acf/init', function() {
    if( function_exists('acf_register_block_type') ) {
        $biolerplateModules = [
            'leadspace'  => 'Leadspace',
        ];

        foreach($biolerplateModules as $key => $mModule) {

            $mName    = $mModule;

            $fileName = str_replace( '_', '-', $key );
            
            acf_register_block_type(array(
                'name'              => $key,
                'fileName'          => $fileName,
                'title'             => __( $mName ),
                'description'       => __('A custom '. $mName.' block.'),
                'render_template'   => 'blocks/'.$fileName.'.php',
                'category'          => 'wp-trainee-biolerplate',
                'icon'              => 'block-default',
                'keywords'          => array( $mModule, 'wp-trainee-biolerplate' ),
                'example'           => array(
                    'attributes' => array(
                        'mode' => 'preview',
                        'data' => []
                    )
                ),
                'enqueue_assets' => function($data){
                    $fileName       = str_replace( '_', '-', $data['fileName'] );

                    $cssFilePathDir = get_template_directory_uri().'/public/styles/modules/'.$fileName.'.css';
                    $jsFilePathDir  = get_template_directory_uri().'/public/scripts/'.$fileName.'.js';

                    $cssFilePath = $_SERVER['DOCUMENT_ROOT'].parse_url($cssFilePathDir,PHP_URL_PATH);
                    $jsFilePath  = $_SERVER['DOCUMENT_ROOT'].parse_url($jsFilePathDir,PHP_URL_PATH);

                    if(!is_admin()){
                        if ( file_exists( $cssFilePath ) ) {
                            wp_enqueue_style($fileName.'.css', $cssFilePathDir);
                        }

                        if ( file_exists( $jsFilePath ) ) {
                            wp_enqueue_script( $fileName.'js', $jsFilePathDir, array('jquery'), '', true );
                        }
                    }
                },
            ));
        }
    }
});

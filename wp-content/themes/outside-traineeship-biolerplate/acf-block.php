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
                    $fileName = str_replace( '_', '-', $data['fileName'] );

                    $cssFilePath = get_template_directory_uri().'/assets/css/modules/'.$fileName.'.css';
                    
                    $jsFilePath  = get_template_directory_uri().'/assets/js/modules/'.$fileName.'.css';

                    if(!is_admin()){
                        if ( file_exists( $cssFilePath ) ) {
                            wp_enqueue_style($fileName.'.css', asset('styles/modules/'.$fileName.'.css')->uri(), true, null);
                        }

                        if ( file_exists( $jsFilePath ) ) {
                            wp_enqueue_script( $fileName.'js', asset('scripts/'.$fileName.'.js')->uri(), array('jquery'), '', true );
                        }
                    }
                },
            ));
        }
    }
});
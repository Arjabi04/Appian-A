<?php
if ( is_admin() ) :
    /* Render screenshot for example */
    $imgUrl = get_stylesheet_directory_uri() . '/assets/images/leadspace.png';
    echo '<img src="' . $imgUrl . '">';
else:
    $content = get_field('leadspace');
    $title   = $content['title'] ?? false;
    if(isset($title)):?>
        <h1><?php echo $title;?></h1>
<?php
    endif;    
endif; 

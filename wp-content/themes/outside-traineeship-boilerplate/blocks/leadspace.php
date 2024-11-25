<?php
if ( is_admin() ) :
    /* Render screenshot for example */
    $imgUrl = get_stylesheet_directory_uri() . '/public/images/preview/leadspace.webp';
    echo '<img src="' . $imgUrl . '">';
else:
    $content = get_field('leadspace');
    $title   = $content['title'] ?? false;
    if(isset($title)):?>
        <h1 class="leadspace"><?php echo $title;?></h1>
<?php
    endif;    
endif; 

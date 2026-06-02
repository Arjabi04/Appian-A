<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Outside_Traineeship_Biolerplate
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php outside_traineeship_biolerplate_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->


</article><!-- #post-<?php the_ID(); ?> -->
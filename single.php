<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Peace 107
 * @since Peace 107 1.0
 */

get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php peace107_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
            <aside class="aside1">
                <?php dynamic_sidebar('Primary'); ?>
            </aside>
            <aside class="aside2">
                <?php dynamic_sidebar('Secondary'); ?>
            </aside>
		</div><!-- #primary .site-content -->
<?php get_footer(); ?>
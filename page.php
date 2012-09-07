<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Peace 107
 * @since Peace 107 1.0
 */

get_header(); ?>

    <div id="primary" class="site-content">
        <div id="content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'page' ); ?>

                <?php comments_template( '', true ); ?>

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
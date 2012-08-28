<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Peace 107
 * @since Peace 107 1.0
 */

get_header(); ?>

<div class="container">
  <article class="content">
    Tha main content. We like semantic HTML ordering.
  </article>
  <aside class="aside1">
    An aside.
  </aside>
  <aside class="aside2">
    Another aside.
  </aside>
  <footer class="footer1">
    A footer.
  </footer>
  <footer class="footer2">
    Another footer.
  </footer>
</div>

<?php get_footer(); ?>
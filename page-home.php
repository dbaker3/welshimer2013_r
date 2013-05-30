<?php
/**
Template Name: Home Page
 */

get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('body-text'); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'welshimer2013' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'welshimer2013' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
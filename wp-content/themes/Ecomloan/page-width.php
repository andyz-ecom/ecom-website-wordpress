<?php
/**
 Template Name: Fullwidth page
 */
 get_header(); 
 ?>

<div class="post">
	<div class="container">
		<div class="post-head col-lg-12"><img src="<?php bloginfo('template_url');?>/img/banner.jpg"/></div>
		<div class="post-content col-lg-12">
			<?php while ( have_posts() ) : the_post(); ?>
		    <h1><?php the_title();?></h1>
		    <div class="post-meta">
			    <span><?php the_author_meta('display_name'); ?>&nbsp;-&nbsp;</span>
			    <span><?php the_time('M j Y'); ?></span>
		    </div>
			<div class="post-article"><?php the_content(); ?></div>
		    <?php endwhile; ?>			
		</div>
	</div>
</div>
 				
<?php get_footer();?>
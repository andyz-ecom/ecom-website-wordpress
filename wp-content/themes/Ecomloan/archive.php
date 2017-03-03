<?php get_header(); ?>

<div class="post">
	<div class="container">
		<div class="post-head col-lg-12"><img src="<?php bloginfo('template_url');?>/img/banner.jpg"/></div>

		<?php get_sidebar();?>
		<div class="post-content col-lg-9">
			<h1><?php single_cat_title(); ?></h1>
			<div class="post-list">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post-info">
					<a href="<?php the_permalink();?>" target="_blank" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</div>
			<?php endwhile; endif; ?>
			</div>
			<?php the_posts_pagination( array(
				'prev_text'  => '<i class="fa fa-chevron-left"></i>',
				'next_text'  => '<i class="fa fa-chevron-right"></i>',
				'before_page_number' => '',
				'after_page_number' => '',
				) ); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>


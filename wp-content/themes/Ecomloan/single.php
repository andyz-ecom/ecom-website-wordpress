<?php get_header(); ?>
<div class="post">
	<div class="container">
<!--		<div class="post-head col-lg-12"><img src="--><?php //bloginfo('template_url');?><!--/img/banner.jpg"/></div>-->
		<?php get_sidebar();?>
		<div class="post-content col-lg-9">
			<?php while ( have_posts() ) : the_post(); ?>
		    <h1><?php the_title();?></h1>
				<div class="post-meta">
					<svg width="1em" height="1em" viewBox="0 0 1024 1024" class="meta-item__icon" style="font-size:14px;color:#999999;margin-right:6px;" data-v-849552ce="">
						<path d="M512 0C229.232 0 0 229.232 0 512s229.232 512 512 512 512-229.232 512-512S794.768 0 512 0zm0 960C264.976 960 64 759.024 64 512S264.976 64 512 64s448 200.976 448 448-200.976 448-448 448zm246.72-346.496L531.888 510.4V225.872c0-17.68-14.336-32-32-32s-32 14.32-32 32v305.12a31.944 31.944 0 0 0 18.768 29.12l245.6 111.632a31.577 31.577 0 0 0 13.216 2.88c12.16 0 23.776-6.976 29.136-18.752 7.312-16.096.208-35.056-15.888-42.368z"></path>
					</svg><span><?php the_date('F j, Y'); ?> at <?php the_time('g:i a'); ?></span>
				</div>
			<div class="post-article"><?php the_content(); ?></div>
		    <?php endwhile; ?>			
		</div>
	</div>
</div>
 				
<?php get_footer();?>
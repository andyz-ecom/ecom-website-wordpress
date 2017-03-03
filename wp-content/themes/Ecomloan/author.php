<?php get_header(); ?>
<div class="author">
	<div class="author-head">
		<div class="container">
			<div class="author-inner">
				<div class="img-wrap"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 88 ); ?></div>
				<div class="author-info">
					<div class="info-inner">
						<p class="name"><?php echo get_the_author(); ?></p>
						<p class="desc"><?php the_author_meta( 'description' ); ?></p>
						<p ga_event="follow_pgc" class="btn-subscribe ">+关注</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="author-content">
		<div class="container">
			<div class="author-post">
				<h2 class="author-title"><span>全部文章</span></h2>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
					endwhile;
					the_pagenavi('<i class="fa fa-angle-double-left"></i>','<i class="fa fa-angle-double-right"></i>'); 
				endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
<div>

<?php get_footer(); ?>

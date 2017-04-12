<div id="post-<?php the_ID(); ?>" class="post-<?php the_ID(); ?> post-list">
	<?php $num = get_post_images_number(); if ( $num != 0 ) : ?>
	<div class="post-img">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
			<img src="<?php echo get_bloginfo("template_url"); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=82&w=126&q=100&zc=1&ct=1&a=t"/>
		</a>
	</div>
	<?php endif; ?>

	<div class="post-content<?php if ( $num != 0 ) echo ' post-inner'; ?>">
		<div class="box">
			<div class="title-box"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></div>
			<div class="meta-box">
				<a class="meta-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_id() ) ); ?>"><?php echo get_avatar( get_the_author_meta('email'), 56 ); ?></a>
				<a class="meta-name" href="<?php echo esc_url( get_author_posts_url( get_the_author_id() ) ); ?>"><?php the_author_meta('nickname'); ?></a>
				<?php comments_popup_link( __( '0评论' ), __( '1评论' ), __( '%评论' ) ); ?>
				<span class="meta-date"><?php echo the_time_since($post->post_date); ?></span>
				<?php edit_post_link( __( '[Edit]' ) ); ?>
			</div>
		</div>
	</div>
</div>

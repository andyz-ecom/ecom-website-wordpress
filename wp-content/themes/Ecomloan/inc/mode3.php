<!--Initialize language-->
<?php
$lang = get_bloginfo('language'); 
if( $lang == "zh-TW" ) {
	$team = "team-tw";
} elseif( $lang == "en-US" ) {
	$team = "team-en";
} else{
	$team = "team";
} ?>
<div class="team">
	<div class="container">
		<div class="team-list">
			<ul class="slides"> 
				<?php $querys = new WP_Query(array('posts_per_page' => 6, 'category_name' => $team));
				if ( $querys->have_posts() ) : while ($querys->have_posts()) : $querys->the_post(); ?>
				<li>
					<div class="team-box">
					<table class="team-head">
						<tr><td colspan="2"><?php the_post_thumbnail(); ?></td></tr>
					</table>
					<div class="team-info">
						<p><?php the_excerpt(); ?></p>
						<span><?php echo get_post_meta(get_the_ID(),'_team_name',true); ?></span>
						<span class="team-contact">Phone:&nbsp;<?php echo get_post_meta(get_the_ID(),'_team_phone',true); ?>&nbsp;NMLS#<?php echo get_post_meta(get_the_ID(),'_team_id',true); ?></span>
					</div></div>
				</li>
				<?php endwhile; endif; wp_reset_query();?>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function() { 
    $(".team-list").flexslider({
	    animation: 'slide',
	    direction: 'horizontal',
	    animationLoop: true,
	    slideshow: true,
	    pauseOnHover: true,
	    directionNav: true,
	    prevText: '<i class="fa fa-angle-left"></i>',
	    nextText: '<i class="fa fa-angle-right"></i>',
	    controlNav: false,
	}); 
}); 
</script>
<!--Initialize language-->
<?php
get_header(); 
$lang = get_bloginfo('language'); 
if( $lang == "zh-TW" ) {
	$video = "video-tw";
	$company = "company-news-tw";
	$industry = "industry-news-tw";
} elseif( $lang == "en-US" ) {
	$video = "video-en";
	$company = "company-news-en";
	$industry = "industry-news-en";
} else{
	$video = "video";
	$company = "company-news";
	$industry = "industry-news";
} 
?>
<!--Mobile Version-->
<div class="mobile-section">
	<div class="container">
		<div class="mobile-slide">
			<ul class="slides"> 
				<li><img src="<?php echo get_option('tt_mobile1_img'); ?>"/></li> 
				<li><img src="<?php echo get_option('tt_mobile2_img'); ?>"/></li> 
				<li><img src="<?php echo get_option('tt_mobile3_img'); ?>"/></li> 
				<li><img src="<?php echo get_option('tt_mobile4_img'); ?>"/></li> 
				<li><img src="<?php echo get_option('tt_mobile5_img'); ?>"/></li> 
			</ul>
</div>
<script type="text/javascript">
$(function() { 
    $(".mobile-slide").flexslider({
	    animation: 'slide',
	    direction: 'horizontal',
	    animationLoop: true,
	    slideshow: true,
	    pauseOnHover: true,
	    directionNav: false,
	    controlNav: true,
	}); 
}); 
</script>
<div class="mobile-news">
<?php 
include('inc/mode2.php'); //资讯
$cat=get_category_by_slug($industry);
$catid= $cat->term_id; ?>
</div>
<div class="mobeli-news col-sm-12">
	<div class="title"><?php echo get_cat_name($catid); ?><a href="<?php echo get_category_link($catid); ?>"><?php if( $lang == "zh-TW" ) {echo "更多新聞";} elseif( $lang == "en-US" ) {echo "More news";} else {echo "更多新闻";} ?></a></div>
	<div class="mobile-news-img"><img src="<?php bloginfo('template_url');?>/img/c.jpg"/></div>
	<ul class="mobile-news-list">
<?php 
$querys = new WP_Query(array('posts_per_page' => 3, 'category_name' => $industry));
if ( $querys->have_posts() ) : while ($querys->have_posts()) : $querys->the_post(); ?>
		<li><a class="news-img" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></li>
		<?php endwhile; endif; wp_reset_query();?>
	</ul>
</div>
<?php $cat=get_category_by_slug($company);
$catid= $cat->term_id; ?>
<div class="mobeli-news col-sm-12">
	<div class="title"><?php echo get_cat_name($catid); ?><a href="<?php echo get_category_link($catid); ?>"><?php if( $lang == "zh-TW" ) {echo "更多新聞";} elseif( $lang == "en-US" ) {echo "More news";} else {echo "更多新闻";} ?></a></div>
	<div class="mobile-news-img"><img src="<?php bloginfo('template_url');?>/img/phone.jpg"/></div>
	<ul class="mobile-news-list">
<?php 
$querys = new WP_Query(array('posts_per_page' => 3, 'category_name' => $company));
if ( $querys->have_posts() ) : while ($querys->have_posts()) : $querys->the_post(); ?>
		<li><a class="news-img" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></li>
		<?php endwhile; endif; wp_reset_query();?>
	</ul>
</div>
<?php $cat=get_category_by_slug($video);
$catid=$cat->term_id; ?>
<div class="mobeli-video col-sm-12">
	<div class="title"><?php echo get_cat_name($catid); ?><a href="<?php echo get_category_link($catid); ?>"><?php if( $lang == "zh-TW" ) {echo "更多視頻";} elseif( $lang == "en-US" ) {echo "More video";} else {echo "更多视频";} ?></a></div>
	<a href=""><img src="<?php bloginfo('template_url');?>/img/video.jpg"/></a>
</div>
<div class="mobeli-video col-sm-12">
	<div class="title"><?php if( $lang == "zh-TW" ) {echo "利率趨勢";} elseif( $lang == "en-US" ) {echo "Market Trends";} else {echo "利率趋势";} ?><a href="#"><?php if( $lang == "zh-TW" ) {echo "查詢利率及收費";} elseif( $lang == "en-US" ) {echo "Check Rates Details";} else {echo "查询利率及收费";} ?></a></div>
	<a href=""><iframe src="http://www.mortgagecalculator.org/rates-widgets/mortgages/widget.php?range=6&amp;width=460&amp;height=225&amp;data=30yr_fr|15yr_fr|5yr_ar" style="border: 0; width: 100%; height: 225px;" scrolling="no"></iframe></a>
</div>
<?php 
$lang = get_bloginfo('language'); 
if( $lang == "zh-TW" ) {
	$team = "team-tw";
} elseif( $lang == "en-US" ) {
	$team = "team-en";
} else{
	$team = "team";
} ?>

<div class="mobile-team col-sm-12">
	<div class="title"><?php if( $lang == "zh-TW" ) {echo "經紀人推薦";} elseif( $lang == "en-US" ) {echo "Broker recommended";} else {echo "经纪人推荐";} ?></div>
	<ul class="slides"> 
		<?php $querys = new WP_Query(array('posts_per_page' => 6, 'category_name' => $team));
		if ( $querys->have_posts() ) : while ($querys->have_posts()) : $querys->the_post(); ?>
		<li>
			<span><?php the_post_thumbnail(); ?></span>
			<strong><?php echo get_post_meta(get_the_ID(),'_team_name',true); ?></strong>
			<strong><?php echo get_post_meta(get_the_ID(),'_team_phone',true); ?></strong>
			<strong><?php echo get_post_meta(get_the_ID(),'_team_id',true); ?></strong>
		</li>
		<?php endwhile; endif; wp_reset_query();?>
	</ul>
</div>
<script type="text/javascript">
$(function() { 
    $(".mobile-team").flexslider({
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
	</div>
</div>

<!--PC Version-->
<?php  // PC
include('inc/mode1.php'); //幻灯
include('inc/mode2.php'); //资讯
include('inc/mode3.php'); //团队
include('inc/mode4.php'); //资料
?>
<div class="related">
	<div class="container">
		<div class="col-lg-4">
			<div class="news-list">
				<?php $cat=get_category_by_slug($video); //获取分类别名为 wordpress 的分类数据  
				$cat_links=get_category_link($cat->term_id); ?>
				<a class="news-img" href="<?php echo $cat_links; ?>"><img src="<?php bloginfo('template_url');?>/img/ads_play.png"/></a>
				<div class="news-info">
					<ul>
						<?php 				
						$querys = new WP_Query(array('posts_per_page' => 4, 'category_name' => $video));
						if ( $querys->have_posts() ) : while ($querys->have_posts()) : $querys->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php endwhile; endif; wp_reset_query();?>
					</ul>
					<a class="more" href="<?php echo $cat_links; ?>">more</a>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<?php 
			$querys = new WP_Query(array('posts_per_page' => 1, 'category_name' => $company));
			if ( $querys->have_posts() ) : while ($querys->have_posts()) : $querys->the_post(); ?>
			<div class="news-list">
				<a class="news-img" href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url');?>/img/news.png"/></a>
				<div class="news-info">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 55,"..."); ?></p>
					<a class="more" href="<?php the_permalink(); ?>">more</a>
				</div>
			</div>
			<?php endwhile; endif; wp_reset_query();?>
		</div>
		<div class="col-lg-4">
			<?php 
			$querys = new WP_Query(array('posts_per_page' => 1, 'category_name' => $industry));
			if ( $querys->have_posts() ) : while ($querys->have_posts()) : $querys->the_post(); ?>
			<div class="news-list">
				<a class="news-img" href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url');?>/img/market.png"/></a>
				<div class="news-info">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 55,"..."); ?></p>
					<a class="more" href="<?php the_permalink(); ?>">more</a>
				</div>
			</div>
			<?php endwhile; endif; wp_reset_query();?>
		</div>
	</div>
</div>
<div class="offer">
	<div class="container">
		<div class="col-lg-5 col-lg-offset-1"><iframe src="http://www.mortgagecalculator.org/rates-widgets/mortgages/widget.php?range=6&amp;width=460&amp;height=225&amp;data=30yr_fr|15yr_fr|5yr_ar" style="border: 0; width: 100%; height: 225px;" scrolling="no"></iframe></div>
	</div>
	<div class="col-lg-5"></div>
</div>

<?php get_footer(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Cache-Control" content="no-transform">
<meta http-equiv="Cache-Control" content="no-siteapp">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php if ( is_home() ) : ?>
<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
<?php elseif ( is_search() ) : ?>
<title><?php echo $_GET['s']; ?>的搜索结果 | <?php bloginfo('name'); ?></title>
<?php elseif ( is_single() ) : ?>
<title><?php echo trim(wp_title('', false)); ?> | <?php bloginfo('name'); ?></title>
<?php elseif ( is_category() ) : ?>
<title><?php single_cat_title(); ?> | <?php bloginfo('name'); ?></title>
<?php elseif ( is_author() ) : ?>
<title><?php the_author_meta( 'nickname' );; ?> | <?php bloginfo('name'); ?></title>
<?php elseif ( is_404() ) : ?>
<title>404 Page Not Found | <?php bloginfo('name'); ?></title>
<?php endif;?>
<?php 
	$keywords = get_option('tt_keywords');
	$description = get_option('tt_description');
if(is_single()) :
	$keywords = strip_tags( get_the_tag_list( '',',','') );
	$post = get_post();
	if ($post->post_excerpt) {
		$post_desc = trim( strip_tags( $post->post_excerpt ) );
		$description = wp_trim_words( $post_desc, 420);
	} else {
		$description = $post->post_title;
	}
elseif(is_category()) :
	$category_info = get_the_category();
	$category_id = $category_info[0]->cat_ID;
	$keywords = get_option('tt_description'.$category_id);
	$cate_desc = category_description();
	$description = $cate_desc ? strip_tags( category_description() ) . ',' . $description : $description;
elseif(is_author()) :
	
elseif (is_404()) :
	$description = "您要找的页面已经不存在";
	$keywords = "404,您要找的页面已经不存在";
?>
<?php endif; ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo trim($description); ?>" />
<?php wp_head(); ?>
</head>
<body>
<div class="header">
	<div class="lang-box"><div class="container"><a class="en" href="#">English</a><a class="zh-cn" href="#">简</a><a class="zh-tw" href="#">繁</a></div></div>
	<div class="nav">
		<div class="container">
			<div class="logo"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_url');?>/img/logo.png"/></a></div>
			<div class="menu">
				<ul><?php echo strip_tags(wp_nav_menu( array( 'container' => false,'items_wrap' => '%3$s','depth' => 1,'theme_location' =>'primary')), '<li><a>' ); ?></ul>
				&nbsp;CALL:800.709.9635&nbsp;<a class="lang" href="javascript:;"><i class="fa fa-reorder"></i></a>

			</div>
			<a class="mobile-menu" href="javascript:;"><i class="fa fa-reorder"></i></a>	
		</div>
	</div>
</div>

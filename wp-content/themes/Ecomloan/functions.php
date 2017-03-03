<?php
define('THEMENAME', 'Ecomloan');

include('inc/options.php');
//include('inc/simple-local-avatars.php');

if ( function_exists( 'add_theme_support' ) )   add_theme_support( 'post-thumbnails' );
function new_excerpt_length($length) {
    return 200;
}
add_filter('excerpt_length', 'new_excerpt_length');
function new_excerpt_more($more) {
    return '......';
}
add_filter('excerpt_more', 'new_excerpt_more');

// 阻止站内文章Pingback 
function tin_noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}
add_action('pre_ping','tin_noself_ping');

// 移除版本号 
function themepark_remove_cssjs_ver( $src ) {
    if( strpos( $src, 'ver='. get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'themepark_remove_cssjs_ver', 999 );
add_filter( 'script_loader_src', 'themepark_remove_cssjs_ver', 999 );

// 去除头部冗余代码 
function remove_open_sans(){
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );

// 取消原有的 jquery 定义
if ( !is_admin() ) { // 后台不禁止
	function my_init_method() {
		wp_deregister_script( 'jquery' ); 
	}
	add_action('init', 'my_init_method');
}
wp_deregister_script( 'l10n' );

// Disable the emoji's
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
// Filter function used to remove the tinymce emoji plugin.
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function disable_embeds_init() {
    /* @var WP $wp */
    global $wp;
    // Remove the embed query var.
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(
        'embed',
    ) );
    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    // Turn off
    add_filter( 'embed_oembed_discover', '__return_false' );
    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
    // Remove all embeds rewrite rules.
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
add_action( 'init', 'disable_embeds_init', 9999 );

// Removes the 'wpembed' TinyMCE plugin.
function disable_embeds_tiny_mce_plugin( $plugins ) {
    return array_diff( $plugins, array( 'wpembed' ) );
}

// Remove all rewrite rules related to embeds.
function disable_embeds_rewrites( $rules ) {
    foreach ( $rules as $rule => $rewrite ) {
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {
            unset( $rules[ $rule ] );
        }
    }
    return $rules;
}

// Remove embeds rewrite rules on plugin activation.
function disable_embeds_remove_rewrite_rules() {
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );

// Flush rewrite rules on plugin deactivation.
function disable_embeds_flush_rewrite_rules() {
    remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );

// 头部优化
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'pre_post_update', 'wp_save_post_revision' );
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link' );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink 
remove_action('wp_head', 'rel_canonical' ); 
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // 上、下篇. 
remove_action('wp_head', 'start_post_rel_link', 10, 0);// 开始篇 
remove_action('wp_head', 'parent_post_rel_link', 10, 0);// 父篇 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre 
remove_action('wp_head', 'feed_links_extra', 3);// 额外的feed,例如category
remove_action('wp_head', 'index_rel_link');//当前文章的索引 
remove_filter('the_content', 'wptexturize');//禁用半角符号自动转换为全角

// 移除 WordPress 加载的JS和CSS链接中的版本号
function remove_cssjs_ver( $src ) {
	if( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 999 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 999 );

//头像服务器替换
function get_theme_avatar($avatar) {
	$avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"secure.gravatar.com",$avatar);
	return $avatar;
}
add_filter( 'get_avatar', 'get_theme_avatar', 10, 3 );

/**
 * 移除菜单的多余CSS选择器
 */
add_filter('nav_menu_css_class', 'remove_menu_class_filter', 100, 1);
add_filter('nav_menu_item_id', 'remove_menu_class_filter', 100, 1);
add_filter('page_css_class', 'remove_menu_class_filter', 100, 1);
function remove_menu_class_filter($var) {
	//return is_array($var) ? array() : '';
	return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
}

/**
 * 脚本或样式wp_enqueue
 */
function theme_enqueue_scripts() { 
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array() );
	wp_enqueue_style( 'awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array() ); 
	wp_enqueue_style( 'style', get_stylesheet_uri() ); 
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', array() ); 
	wp_enqueue_script( 'slider', get_template_directory_uri() . '/js/slider.js',  array('jquery')); 
	wp_enqueue_script( 'functions', get_template_directory_uri() . '/js/functions.js',  array('jquery'));  
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );
function myAdminScripts() {  
    wp_register_style( 'options', get_template_directory_uri() . '/css/options.css',  array());  
    wp_enqueue_style( 'options' );  
}  
add_action( 'admin_enqueue_scripts', 'myAdminScripts' );

/**
 * Register_nav_menus
 */
register_nav_menus(array('primary' => __('导航菜单', 'themes'),'footer' => __('底部菜单', 'themes')));


// 自定义小工具
//require get_template_directory() .'/inc/widget-news.php'; 
//require get_template_directory() . '/inc/widget-comment.php';

// 注册侧栏/注册小工具
add_action( 'widgets_init', 'get_widgets' );  
function get_widgets() {
register_sidebar(array('name' => '文章侧栏-zh', 'id' => 'sidebar-1', 'class' => '', 'description' => __('文章侧栏-zh,所有页面均显示.'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title title">', 'after_title' => '</h3>'));
register_sidebar(array('name' => '页面侧栏-zh', 'id' => 'sidebar-2', 'class' => '', 'description' => __('页面侧栏-zh,所有页面均显示.'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title title">', 'after_title' => '</h3>'));
register_sidebar(array('name' => '分类侧栏-zh', 'id' => 'sidebar-3', 'class' => '', 'description' => __('分类侧栏-zh,所有页面均显示.'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title title">', 'after_title' => '</h3>'));
register_sidebar(array('name' => '文章侧栏-tw', 'id' => 'sidebar-4', 'class' => '', 'description' => __('文章侧栏-tw,所有页面均显示.'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title title">', 'after_title' => '</h3>'));
register_sidebar(array('name' => '页面侧栏-tw', 'id' => 'sidebar-5', 'class' => '', 'description' => __('页面侧栏-tw,所有页面均显示.'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title title">', 'after_title' => '</h3>'));
register_sidebar(array('name' => '分类侧栏-tw', 'id' => 'sidebar-6', 'class' => '', 'description' => __('分类侧栏-tw,所有页面均显示.'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title title">', 'after_title' => '</h3>'));
register_sidebar(array('name' => '文章侧栏-en', 'id' => 'sidebar-7', 'class' => '', 'description' => __('文章侧栏-en,所有页面均显示.'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title title">', 'after_title' => '</h3>'));
register_sidebar(array('name' => '页面侧栏-en', 'id' => 'sidebar-8', 'class' => '', 'description' => __('页面侧栏-en,所有页面均显示.'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title title">', 'after_title' => '</h3>'));
register_sidebar(array('name' => '分类侧栏-en', 'id' => 'sidebar-9', 'class' => '', 'description' => __('分类侧栏-en,所有页面均显示.'), 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title title">', 'after_title' => '</h3>'));
	//register_widget( 'get_widget_news' );
	//register_widget( 'get_widget_comment' );
}


// 判断手机
function is_mobile() {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_browser = Array(
		"mqqbrowser", //手机QQ浏览器
		"opera mobi", //手机opera
		"juc","iuc",//uc浏览器
		"fennec","ios","applewebKit/420","applewebkit/525","applewebkit/532","ipad","iphone","ipaq","ipod",
		"iemobile", "windows ce",//windows phone
		"240x320","480x640","acer","android","anywhereyougo.com","asus","audio","blackberry","blazer","coolpad" ,"dopod", "etouch", "hitachi","htc","huawei", "jbrowser", "lenovo","lg","lg-","lge-","lge", "mobi","moto","nokia","phone","samsung","sony","symbian","tablet","tianyu","wap","xda","xde","zte"
	);
	$is_mobile = false;
	foreach ($mobile_browser as $device) {
		if (stristr($user_agent, $device)) {
			$is_mobile = true;
			break;
		}
	}
	return $is_mobile;
}


// 返分类ID
function get_article_category_ID() {
    $category = get_the_category();
    return $category[0]->cat_ID;
}

// 分类关键词
global $texonomy_slug_keywords;
$texonomy_slug_keywords='category';
add_action($texonomy_slug_keywords.'_add_form_fields','categorykeywords');
function categorykeywords($taxonomy){ 
    echo '<div class="form-field term-slug-wrap"><label for="tag-keywords">分类关键词</label><input type="text" name="tag-keywords" id="tag-keywords" value="" /><br /><span>请在此输入分类关键词。</span> </div>';
}
add_action($texonomy_slug_keywords.'_edit_form_fields','categorykeywordsedit');
function categorykeywordsedit($taxonomy){ 
echo '<tr class="form-field"><th scope="row" valign="top"><label for="tag-keywords">关键词</label></th><td><input type="text" name="tag-keywords" id="tag-keywords" value="'. get_option('_category_keywords'.$taxonomy->term_id) .'"/><br /><span class="description">请在此输入分类关键词。</span></td></tr>'; 
}
add_action('edit_term','categorykeywordssave');
add_action('create_term','categorykeywordssave');
function categorykeywordssave($term_id){
    if(isset($_POST['tag-keywords'])){
        if(isset($_POST['tag-keywords']))
            update_option('_category_keywords'.$term_id,$_POST['tag-keywords'] );
    }
}


/**
 * Get post views
 */
function get_view($post_id) {
	$count_key = 'views';
	$count = get_post_meta ( $post_id, $count_key, true );
	return $count == '' ? "0" : $count;
}
/* set post view */
function set_view($post_id) {
	$count_key = 'views';
	$count = get_post_meta ( $post_id, $count_key, true );
	if ($count == '') {
		delete_post_meta ( $post_id, $count_key );
		add_post_meta ( $post_id, $count_key, '0' );
	}
	$count ++;
	return update_post_meta ( $post_id, $count_key, $count );
}


/**
 * Get breadcrumbs
 * 
 */
function get_breadcrumbs() {
	$str = '<a href="' . home_url () . '">首页</a>&nbsp;/&nbsp;';
	if (is_single ()) {
		global $post;
		$cates = get_the_category ( $post->ID );
		$cate_str = '';
		foreach ( $cates as $cate ) {
			$cate_str .= '<a href="' . get_category_link ( $cate ) . '">' . $cate->name . '</a>, ';
		}
		$cate_str = rtrim ( $cate_str, ', ' );
		$str .= $cate_str . '&nbsp;/&nbsp;<span>正文</span>';
	} elseif (is_page ()) {
		$str .= '<span>正文</span>';
	} elseif (is_search ()) {
		$str .= '<a href="' . home_url ( '?s=' . $_GET ['s'] ) . '">' . $_GET ['s'] . '的搜索结果</a>';
	} elseif (is_category ()) {
		$str .= '<a href="' . get_category_link ( get_query_var ( 'cat' ) ) . '">' . single_cat_title ( '', false ) . '</a>';
	} elseif (is_tag ()) {
		$str .= '<a href="' . get_tag_link ( get_query_var ( 'tag_id' ) ) . '">' . single_tag_title ( '', false ) . '</a>';
	} elseif (is_year ()) {
		$year = get_the_time ( 'Y' );
		$str .= '<a href="' . get_year_link ( $year ) . '">' . get_the_time ( 'Y年' ) . '</a>';
	} elseif (is_month ()) {
		$year = get_the_time ( 'Y' );
		$month = get_the_time ( 'm' );
		$str .= '<a href="' . get_month_link ( $year, $month ) . '">' . get_the_time ( 'Y年n月' ) . '</a>';
	} elseif (is_day ()) {
		$year = get_the_time ( 'Y' );
		$month = get_the_time ( 'm' );
		$day = get_the_time ( 'd' );
		$str .= '<a href="' . get_day_link ( $year, $month, $day ) . '">' . get_the_time ( 'Y年n月j日' ) . '</a>';
	} elseif (is_author ()) {
		$str .= get_the_author_nickname () . ' 发布的所有文章';
	}
	echo $str . '';
}

//添加特色缩略图支持
function post_thumbnail_src() {
    global $post;
    if ($values = get_post_custom_values("thumb")) {
        $values = get_post_custom_values("thumb");
        $post_thumbnail_src = $values[0];
    } elseif (has_post_thumbnail()) {
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
        $post_thumbnail_src = $thumbnail_src[0];
    } else {
        $post_thumbnail_src = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $post_thumbnail_src = $matches[1][0];
        if (empty($post_thumbnail_src)) {
            //return get_bloginfo('template_url') . '/img/default.png';
        }
    }
    return $post_thumbnail_src;
}

/**
 * 在24小时以内发布的显示为几分钟前或几小时前
 */ 
function the_time_since($older_date, $newer_date = false) {
    $chunks = array(
	    array(60 * 60 * 24 * 365 , '年'),
	    array(60 * 60 * 24 * 30 , '月'),
	    array(60 * 60 * 24 * 7, '周'),
	    array(60 * 60 * 24 , '天'),
	    array(60 * 60 , '小时'),
	    array(60 , '分钟'),
    );
    $newer_date = ($newer_date == false) ? (time()+(60*60*get_settings("gmt_offset"))) : $newer_date;
    $since = $newer_date - abs(strtotime($older_date));
    //根据自己的需要调整时间段，下面的24则表示小时，根据需要调整吧
    if($since < 60 * 60 * 24){
	    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
		    $seconds = $chunks[$i][0];
		    $name = $chunks[$i][1];
		    if (($count = floor($since / $seconds)) != 0) {
		    	break;
		    }
	    }
	    $out = ($count == 1) ? '1 '.$name : "$count {$name}";
	    return $out . "前";
    } else {
    	the_time('Y-m-d');
    }
}

//获取文章中的图片个数  
if( !function_exists('get_post_images_number') ){  
    function get_post_images_number(){  
        global $post;  
        $content = $post->post_content;    
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $result, PREG_PATTERN_ORDER);    
        return count($result[1]);    
    }  
}

/** 
 * 页码
 */
function the_pagenavi($before, $after) {
    global $wp_query, $wp_rewrite;
    $pages = '';
    $max = $wp_query->max_num_pages;
    if (!$current = get_query_var('paged')) $current = 1;
    $args['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $args['total'] = $max;
    $args['current'] = $current;
    $total = 1;
    $args['mid_size'] = 3;
    $args['end_size'] = 1;
    $args['prev_text'] = $before;
    $args['next_text'] = $after;
    if ($max > 1) echo '<div class="navigation pagination">';
    echo $pages . paginate_links($args);
    if ($max > 1) echo '</div>';
}

//评论列表模块
function get_theme_comment($comment, $args, $depth){
    $avatar = get_avatar($comment->comment_author_email, 36);
    echo '<li ';
    comment_class();
    echo ' id="comment-' . get_comment_ID() . '">';
    //头像
    echo '<div class="cl-avatar">';
	echo $avatar;
    echo '</div>';
    //评论主体
    echo '<div class="cl-main" id="div-comment-' . get_comment_ID() . '">';
    //信息
    echo '<div class="cl-meta">';
    if ($comment->comment_type == '') {
        $author_link = empty($comment->comment_author_url) ? null : ' href="' . $comment->comment_author_url . '"';
        $author = $comment->comment_author;
        echo '<span class="cl-author"><a title="'.$author.'" rel="external nofollow" target="_blank" class="cl-author-url" '.$author_link.'>'.$author.'</a></span>';
    }
    echo '<span>'; time_ago(); echo '</span>';
    if ($comment->comment_approved !== '0') {
        echo edit_comment_link(__('[编辑]'), ' - ', '');
    }
    echo '</div>';
    //内容
    echo '<div class="cl-content" >';
    echo convert_smilies(get_comment_text());
    if ($comment->comment_approved == '0') {
        echo '<span class="cl-approved">（您的评论需要审核后才能显示！）</span><br />';
    }
    echo '</div>';
    echo '<div class="c-actions">';
    if ($comment->comment_approved !== '0') {
        echo comment_reply_link(array_merge( $args, array('reply_text' => '回复', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])));
    }
    echo '<a class="c-digg" href="javascript:;">0 <i class="fa fa-thumbs-o-up"></i></a>';
    echo '</div>';
    echo '</div>';
}

//评论时间
function time_ago( $type = 'commennt', $day = 30 ) {
	$d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
	$timediff = time() - $d('U');
	if ($timediff <= 60*60*24*$day){
		echo human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前';
	}
	if ($timediff > 60*60*24*$day){
		echo date('Y/m/d',get_comment_date('U'));
	};
}

/* 定义自定义Meta模块 */
/*在文章和页面编辑界面的主栏中添加一个模块 */
function myplugin_add_custom_box() {
	add_meta_box(	'myplugin_sectionid', __( '员工信自输入', 'myplugin_textdomain' ), 'myplugin_inner_custom_box', 'post' );
}
/* 输出模块内容 */
function myplugin_inner_custom_box( $post ) {
  // 使用随机数进行核查
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
  // 用于数据输入的实际字段
  // 使用 get_post_meta 从数据库中检索现有的值，并应用到表单中
  $value = get_post_meta( $post->ID, '_team_name', true );
  echo '<label for="team_name">';  _e("员工名字：", 'myplugin_textdomain' ); echo '</label> ';
  echo '<input type="text" id="team_name" name="team_name" value="'.esc_attr($value).'" size="25" />';
  $value = get_post_meta( $post->ID, '_team_id', true );
  echo '<label for="team_id">员工工号：</label> ';
  echo '<input type="text" id="team_id" name="team_id" value="'.esc_attr($value).'" size="25" />';
  $value = get_post_meta( $post->ID, '_team_phone', true );
  echo '<label for="team_phone">员工电话：</label> ';
  echo '<input type="text" id="team_phone" name="team_phone" value="'.esc_attr($value).'" size="25" />';
}
/* 文章保存时，保存我们的自定义数据*/
function myplugin_save_postdata( $post_id ) {
   // 首先，我们需要检查当前用户是否被授权做这个动作。 
    if ( ! current_user_can( 'edit_post', $post_id ) )
        return;
   // 其次，我们需要检查，是否用户想改变这个值。
  if ( ! isset( $_POST['myplugin_noncename'] ) || !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )
      return;
   // 第三，我们可以保存值到数据库中
   //如果保存在自定义的表，获取文章ID
  $post_ID = $_POST['post_ID'];
  $mydata = sanitize_text_field( $_POST['team_name'] ); //过滤用户输入
  add_post_meta($post_ID, '_team_name', $mydata, true) or update_post_meta($post_ID, '_team_name', $mydata);
  $mydata = sanitize_text_field( $_POST['team_id'] ); //过滤用户输入
  add_post_meta($post_ID, '_team_id', $mydata, true) or update_post_meta($post_ID, '_team_id', $mydata);
  $mydata = sanitize_text_field( $_POST['team_phone'] ); //过滤用户输入
  add_post_meta($post_ID, '_team_phone', $mydata, true) or update_post_meta($post_ID, '_team_phone', $mydata);
}
add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );
add_action( 'save_post', 'myplugin_save_postdata' );
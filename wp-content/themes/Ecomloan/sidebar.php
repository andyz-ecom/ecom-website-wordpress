<?php
$lang = get_bloginfo('language');
if( $lang == "zh-TW" ) {
    $video = "video-tw";
} elseif( $lang == "en-US" ) {
    $video = "video-en";
} else{
    $video = "video";
}
?>

<div class="sidebar col-lg-3">
<div class="sidebar_context">
    <span class="sidebar-title">其他新闻</span>
    <div class="sep-line2"></div>
    <ul class="sidebar-list">
        <?php
        $querys = new WP_Query(array('posts_per_page' => 5, 'category_name' => $video));
        if ( $querys->have_posts() ) : while ($querys->have_posts()) : $querys->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; endif; wp_reset_query();?>
    </ul>
</div>

</div>
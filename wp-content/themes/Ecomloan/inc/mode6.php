<?php $lang = get_bloginfo('language'); ?>


<div class="related">
    <div class="container">
        <div class="col-lg-4">
            <?php
            $querys = new WP_Query(array('posts_per_page' => 1, 'category_name' => $company));
            if ( $querys->have_posts() ) : while ($querys->have_posts()) : $querys->the_post(); ?>
                <div class="news-list">
                    <a class="news-img" href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url');?>/img/news.png"/></a>
                    <div class="news-info">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 55,"..."); ?></p>
                        <a class="more" href="<?php the_permalink(); ?>">更多新闻</a>
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
                        <a class="more" href="<?php the_permalink(); ?>">更多新闻</a>
                    </div>
                </div>
            <?php endwhile; endif; wp_reset_query();?>
        </div>
        <div class="col-lg-4">
            <div class="news-list">
                <?php $cat=get_category_by_slug($video); //获取分类别名为 wordpress 的分类数据
                $cat_links=get_category_link($cat->term_id); ?>
                <a class="news-img" href="<?php echo $cat_links; ?>"><img src="<?php bloginfo('template_url');?>/img/ads_play.png"/></a>
                <div class="news-info">
                    <ul>
                        <?php
                        $querys = new WP_Query(array('posts_per_page' => 3, 'category_name' => $video));
                        if ( $querys->have_posts() ) : while ($querys->have_posts()) : $querys->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; endif; wp_reset_query();?>
                    </ul>
                    <a class="more" href="<?php echo $cat_links; ?>">更多视频</a>
                </div>
            </div>
        </div>
    </div>
</div>

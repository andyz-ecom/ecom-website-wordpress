<div id="comment">
	<div class="c-header"><em><?php echo get_comments_number(); ?>&nbsp;</em>条评论</div>
    <?php
        if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
            die ('请不要直接加载该页面，谢谢！');        
        }
    ?>
	<?php if ( comments_open() ) : ?>
	
    <div id="respond" class="respond">
	    <div class="cavatar"></div>    	
    	<form method="post" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" id="comment-form">
			<div class="cheader">
            <?php if ( is_user_logged_in() ) : ?>
	    		<p><?php _e('登录身份：'); ?><?php printf(__('<a href="%1$s">%2$s</a>，'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account'); ?>"><?php _e('退出  &raquo;'); ?></a></p>			
	            <?php else: ?>
	    		<p>
	                <label for="author" class="required"><?php _e('昵称'); ?></label>
	    			<input type="text" name="author" id="author" class="text" placeholder="name" value="<?php echo $comment_author; ?>" required/>
	    		</p>
	    		<p>
	                <label for="mail" class="required"><?php _e('邮箱'); ?></label>
	    			<input type="email" name="email" id="mail" class="text" placeholder="name@example.com" value="<?php echo $comment_author_email; ?>" required/>
	    		</p>
            <?php endif; ?>
			</div>			
			<div class="cbody cedit">
                <textarea rows="8" cols="50" name="comment" class="textarea" required></textarea>
                <div class="caction">
					<div class="comt-bq">
						<a class="comt-addsmilies fl" href="javascript:;"></a>
						<div class="comt-smilies"></div>
					</div>
					<button type="submit" name="submit" class="submit"><?php _e('发表'); ?></button>
				</div>
			</div>
			<div class="clear"></div>
            <?php comment_id_fields(); ?> 
            <?php do_action('comment_form', $post->ID); ?>            
    	</form>
    </div>
    <?php endif; ?>
	
    <?php if ( have_comments() ) : ?>	
        <ol class="comment-list">		
            <?php wp_list_comments('type=comment&callback=get_theme_comment'); ?>			
        </ol>
    <div class="pagenav">
		<?php paginate_comments_links('prev_next=0');?>
	</div>
    <?php else : ?>
        <?php if ('open' != $post->comment_status) : ?>
            <div class="close-comt"><p>噢！评论已关闭。</p></div>
        <?php endif; ?>       
    <?php endif; ?>
</div>
<script>
$(document).ready(function(){
	$("#comment-form").click(function(){
		$(".cheader").show();
		$(".cbody").addClass("focus");
	});
});
</script>
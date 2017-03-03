<?php $lang = get_bloginfo('language'); ?>
<div class="banner">
	<div class="container">
		<div class="focus">
			<ul class="slides"> 
				<li><img src="<?php echo get_option('tt_slide1_img'); ?>"/></li> 
				<li><img src="<?php echo get_option('tt_slide2_img'); ?>"/></li> 
				<li><img src="<?php echo get_option('tt_slide3_img'); ?>"/></li> 
				<li><img src="<?php echo get_option('tt_slide4_img'); ?>"/></li> 
				<li><img src="<?php echo get_option('tt_slide5_img'); ?>"/></li> 
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function() { 
    $(".focus").flexslider({
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
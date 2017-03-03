<div class="sidebar col-lg-3">
	<?php
$lang = get_bloginfo('language'); 
if( $lang == "zh-TW" ) {
	if (is_active_sidebar('sidebar-4') && is_single()) {
	    dynamic_sidebar('sidebar-4');
	} elseif(is_active_sidebar('sidebar-5') && is_page()){
		dynamic_sidebar('sidebar-5');
	} else {
		dynamic_sidebar('sidebar-6');
	}
} elseif( $lang == "en-US" ) {
	if (is_active_sidebar('sidebar-7') && is_single()) {
	    dynamic_sidebar('sidebar-7');
	} elseif(is_active_sidebar('sidebar-8') && is_page()){
		dynamic_sidebar('sidebar-8');
	} else {
		dynamic_sidebar('sidebar-9');
	}
} else{	
	if (is_active_sidebar('sidebar-1') && is_single()) {
	    dynamic_sidebar('sidebar-1');
	} elseif(is_active_sidebar('sidebar-2') && is_page()){
		dynamic_sidebar('sidebar-2');
	} else {
		dynamic_sidebar('sidebar-3');
	}
}
	?>
</div>
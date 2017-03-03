<?php
$themename = THEMENAME;
$shortname = "tt";

// Pull all the categories into an array
$options_categories = array();
$options_categories_obj = get_categories();
foreach ($options_categories_obj as $category) {
	$options_categories[$category->cat_ID] = $category->cat_name;
}

// Pull all the pages into an array
$options_pages = array();
$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
$options_pages[''] = 'Select a page:';
foreach ($options_pages_obj as $page) {
	$options_pages[$page->ID] = $page->post_title;
}

$options = array ();
$options[] = array( "name" => $themename." Options",
	"type" => "title"); 

// 布局设置
$options[] = array( "title" => "基本设置", "type" => "start");
$options[] = array( "name" => "SEO设置", "type" => "section");
$options[] = array( "name" => "关键词（keywords）",
        "desc" => "",
        "id" => $shortname."_keywords",
        "type" => "textarea",
        "std" => "关键词");
$options[] = array(	"name" => "描述（description）",
		"desc" => "",
		"id" => $shortname."_description",
		"type" => "textarea",
        "std" => "描述");
$options[] = array( "name" => "幻灯-1设置", "type" => "section");
$options[] = array("name" => "图片地址",
        "desc" => "",
        "id" => $shortname."_slide1_img",
        "type" => "text",
        "std" => "");
$options[] = array( "name" => "幻灯-2设置", "type" => "section");
$options[] = array("name" => "图片地址",
        "desc" => "",
        "id" => $shortname."_slide2_img",
        "type" => "text",
        "std" => "");
$options[] = array( "name" => "幻灯-3设置", "type" => "section");
$options[] = array("name" => "图片地址",
        "desc" => "",
        "id" => $shortname."_slide3_img",
        "type" => "text",
        "std" => "");
$options[] = array( "name" => "幻灯-4设置", "type" => "section");
$options[] = array("name" => "图片地址",
        "desc" => "",
        "id" => $shortname."_slide4_img",
        "type" => "text",
        "std" => "");
$options[] = array( "name" => "幻灯-5设置", "type" => "section");
$options[] = array("name" => "图片地址",
        "desc" => "",
        "id" => $shortname."_slide5_img",
        "type" => "text",
        "std" => "");
$options[] = array( "type" => "end");

// 移动设置
$options[] = array( "title" => "移动设置", "type" => "start");	
$options[] = array("name" => "幻灯-1图片地址",
        "desc" => "",
        "id" => $shortname."_mobile1_img",
        "type" => "text",
        "std" => "");
$options[] = array("name" => "幻灯-2图片地址",
        "desc" => "",
        "id" => $shortname."_mobile2_img",
        "type" => "text",
        "std" => "");
$options[] = array("name" => "幻灯-3图片地址",
        "desc" => "",
        "id" => $shortname."_mobile3_img",
        "type" => "text",
        "std" => "");
$options[] = array("name" => "幻灯-4图片地址",
        "desc" => "",
        "id" => $shortname."_mobile4_img",
        "type" => "text",
        "std" => "");
$options[] = array("name" => "幻灯-5图片地址",
        "desc" => "",
        "id" => $shortname."_mobile5_img",
        "type" => "text",
        "std" => "");
$options[] = array( "type" => "end");


function mytheme_add_admin() {
	global $themename, $shortname, $options;
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
			update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
		foreach ($options as $value) {
			if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
			header("Location: admin.php?page=options.php&saved=true");
		die;
		} else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				delete_option( $value['id'] ); }
			header("Location: admin.php?page=options.php&reset=true"); //这里的 options.php 就是这个文件的名称
			die;
		}
	} 
	add_theme_page($themename." Options", "主题设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() { 
global $themename, $shortname, $options;
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题已重新设置</strong></p></div>'; 
?>
<div class="wrap mo-options">
	<h2></h2>
	<div class="mo-options-meta">
		<div class="mo-options-title">我的主题设置：<?php echo $themename; ?></div>
		<p>现在正使用 <a href="http://www.mokezhan.com" title="魔客主题下载站" target="_blank"><?php echo $themename;?></a> 主题设置，寻找更多WordPress主题尽在 <a href="http://www.mokezhan.com" title="魔客主题下载站" target="_blank">http://www.mokezhan.com/</a>，主题选项使用说明请看魔客主题网官网！</p>
		<div class="mo-options-logo"><a href="http://www.mokezhan.com" title="魔客主题网"><img src="<?php bloginfo('template_url'); ?>/img/login.png"/></a></div>
	</div>
	<div class="mo-options-box">
		<form method="post">
		<?php 
		echo '<div class="mo-options-tab">';
		$i = 0;
		foreach ($options as $value) {
			if ( $value['type'] == 'start' ) echo '<a href="javascript:;" class="' . ( $i == 1 ?  'active' : '' ) . '">' . $value['title'] . '</a>';
    		$i++;
		}
		echo '</div><div class="mo-options-section">';
		$i = 0;
		foreach ($options as $value) {
		switch ( $value['type'] ) { 
		case "start" : 
		echo '<div class="mo-options-panel"' . ( $i == 0 ?  ' style="display: block;"' : '' ) . '>'; $i++; ?> 
		<?php break; case 'section' : ?>
		<div class="mo-options-section">
			<span><?php echo $value['name']; ?></span>
		</div>
		<?php break; case 'text' : ?>
		<div class="mo-input mo-text">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
		 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
			<small><?php echo $value['desc']; ?></small><div class="clearfix"></div> 
		</div>
		<?php break; case 'category' : ?>
		<div class="mo-input mo-text">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
			<select class="of-input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach ($value['options'] as $key => $option ) {
					echo '<option'. selected( $val, $key, false ) .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
				} ?>
			</select>
			<small><?php echo $value['desc']; ?></small>
		</div>
		<?php break; case 'pages' : ?>
		<div class="mo-input mo-text">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
			<select class="of-input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach ($value['options'] as $key => $option ) {
					echo '<option'. selected( $val, $key, false ) .' value="' . esc_attr( $key ) . '">' . esc_html( $option ) . '</option>';
				} ?>
			</select>
			<small><?php echo $value['desc']; ?></small>
		</div>
		<?php break; case 'textarea' : ?>
		<div class="mo-input mo-textarea">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
			<textarea name="<?php echo $value['id']; ?>" type="<?php echo ['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
			<small><?php echo $value['desc']; ?></small>
			<div class="clearfix"></div> 
		</div>  
		<?php break; case 'select' : ?>
		<div class="mo-input mo-select">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>	
			<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach ($value['options'] as $option) { ?>
			<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
			</select>
			<small><?php echo $value['desc']; ?></small>
			<div class="clearfix"></div>
		</div>
		<?php break; case "checkbox" : ?>
		<div class="mo-input mo-checkbox">
			<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>	
			<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
			<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
			<small><?php echo $value['desc']; ?></small>
			<div class="clearfix"></div>
		</div>
		<?php break; case 'end' : ?>  
		</div>
		<?php 
				break; 
			} //'end'switch!
		} //'end'foreach! ?> 
		</div>
		<p class="submit">
			<input name="save" class="button-primary" type="submit" value="保存" />
			<input type="hidden" name="action" value="save" />
		</p>
	</form>
	<form method="post">
		<p class="submit">
			<input name="reset" class="button" type="submit" value="重置" onclick="return confirm('重置之后您的全部设置将被清空，你确定要重置选项吗?');" />
			<input type="hidden" name="action" value="reset" />
		</p>
	</form>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.mo-options-tab a').click(function(){
		jQuery(this).addClass('active').siblings().removeClass('active');
		var index = jQuery('.mo-options-tab a').index(this);
		jQuery('.mo-options-section > div').eq(index).show().siblings().hide();
	});	
});
jQuery.noConflict();
</script>
<?php
} //'end'function!
add_action('admin_menu', 'mytheme_add_admin');